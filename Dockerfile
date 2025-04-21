# Etapa de construcción
FROM php:8.2-fpm-bullseye AS builder

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    build-essential python3 \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar Node.js 18.x
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g yarn

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Instalar dependencias PHP
COPY composer.json composer.lock ./
RUN composer install --optimize-autoloader --no-dev --no-scripts

# Instalar dependencias JS
COPY package.json yarn.lock ./
RUN yarn install --frozen-lockfile

# Copiar código fuente
COPY . .

# Variables de entorno para producción
ENV VITE_APP_ENV=production
ENV VITE_APP_URL=${APP_URL}

# Por esto:
    RUN echo "Instalando dependencias npm..." && npm install
    RUN echo "Ejecutando build..." && npm run build 2>&1
    RUN echo "Verificando archivos generados..." && ls -la /var/www/public/build
    RUN [ -f /var/www/public/build/manifest.json ] || (echo "ERROR: Manifest no generado" && ls -la /var/www/public/ && exit 1)

# Etapa final de producción
FROM php:8.2-fpm-bullseye

# Instalar dependencias mínimas
RUN apt-get update && apt-get install -y \
    libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Copiar solo lo necesario desde builder
COPY --from=builder /var/www/public/build /var/www/public/build
COPY --from=builder /var/www/vendor /var/www/vendor
COPY --from=builder /var/www/bootstrap/cache /var/www/bootstrap/cache
COPY --from=builder /var/www/storage /var/www/storage

WORKDIR /var/www

# Configurar permisos
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/public/build

# Script de inicio
COPY init.sh /usr/local/bin/start
RUN chmod +x /usr/local/bin/start

EXPOSE 8000

CMD ["/usr/local/bin/start"] 