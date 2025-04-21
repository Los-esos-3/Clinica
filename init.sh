#!/bin/bash

# Configurar entorno de producción
export APP_ENV=production
export APP_DEBUG=True

# Esperar a la base de datos (opcional)
# while ! nc -z $DB_HOST $DB_PORT; do
#   sleep 1
# done

# # Ejecutar migraciones pendientes
# php artisan migrate --force

# Limpiar cachés
php artisan config:clear
php artisan view:clear
php artisan cache:clear

# Iniciar servidor
php artisan serve --host=0.0.0.0 --port=8000