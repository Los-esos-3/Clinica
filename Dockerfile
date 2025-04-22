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

# Compilar assets dentro del contenedor
RUN npm run build

# Verificar que los archivos generados existan
RUN ls -la /var/www/public/build/ || echo "El directorio build no existe"
RUN ls -la /var/www/public/build/assets/ || echo "El directorio assets no existe"
RUN cat /var/www/public/build/manifest.json || echo "El manifiesto no existe"

# Generar manifiesto manual si no existe
RUN if [ ! -f /var/www/public/build/manifest.json ]; then \
    mkdir -p /var/www/public/build; \
    echo '{"resources/css/app.css":{"file":"assets/app.css"},"resources/js/app.js":{"file":"assets/app.js"}}' > /var/www/public/build/manifest.json; \
    fi

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