# Etapa de construcción
FROM php:8.2-fpm-bullseye AS builder

# Instalar dependencias necesarias del sistema
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Node.js y Yarn
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs \
    && npm install -g yarn

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Dependencias PHP
COPY composer.json composer.lock ./
RUN composer install --optimize-autoloader --no-dev --no-scripts

# Dependencias JS
COPY package.json yarn.lock ./
RUN yarn install

# Copiar código completo
COPY . .

# Antes del npm run build
ENV VITE_APP_ENV=production

# Compilar assets dentro del contenedor
RUN npm install && npm run build

# Verificar que los archivos generados existan
RUN ls -la /var/www/public/build/assets/

# Etapa final de producción
FROM php:8.2-fpm-bullseye

# Copiar app desde builder
COPY --from=builder /var/www /var/www

WORKDIR /var/www

# Reinstalar extensiones necesarias (usa bullseye)
RUN apt-get update && apt-get install -y \
    zip unzip libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Instalar netcat para verificar la disponibilidad de la base de datos
RUN apt-get update && apt-get install -y netcat

# Permisos
RUN chown -R www-data:www-data storage bootstrap/cache public

# Copiar script de inicialización
COPY init.sh /var/www/init.sh
RUN chmod +x /var/www/init.sh

EXPOSE 8000

# Usar el script de inicialización
CMD ["/var/www/init.sh"]