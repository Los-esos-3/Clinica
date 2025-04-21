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

# Configurar entorno para producción
ENV VITE_APP_ENV=production

# Compilar assets
RUN npm install && npm run build

# Verificar que los archivos generados existan
RUN ls -la /var/www/public/build/assets/

# Etapa final de producción
FROM nginx:alpine

# Copiar configuración de Nginx
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Copiar app desde builder
COPY --from=builder /var/www/public /usr/share/nginx/html

RUN ls -la /usr/share/nginx/html/build/assets/

# Exponer el puerto
EXPOSE 8000

# Iniciar Nginx
CMD ["nginx", "-g", "daemon off;"]