#!/bin/bash

# Forzar HTTPS en Railway
if [ "$RAILWAY_ENVIRONMENT" = "production" ]; then
    export APP_URL=https://expemed2.up.railway.app
fi

# Esperar a que la base de datos esté lista
echo "Esperando a que la base de datos esté disponible..."
until nc -z -v -w30 $DB_HOST $DB_PORT; do
  echo "Esperando conexión a la base de datos..."
  sleep 5
done

# Verificar si hay migraciones pendientes
echo "Verificando migraciones pendientes..."
MIGRATIONS_PENDING=$(php artisan migrate:status | grep "No" | wc -l)

if [ "$MIGRATIONS_PENDING" -gt 0 ]; then
    # Ejecutar migraciones solo si hay pendientes
    echo "Ejecutando migraciones pendientes..."
    php artisan migrate --force
    
    # Verificar si hay errores en las migraciones
    if [ $? -ne 0 ]; then
        echo "Error al ejecutar migraciones. Abortando."
        exit 1
    fi
    
    # Ejecutar seeders solo si se aplicaron migraciones
    echo "Ejecutando seeders..."
    php artisan db:seed --class=Permissions --force
    php artisan db:seed --class=PermissionsAssignate --force
    
    # Verificar si hay errores en los seeders
    if [ $? -ne 0 ]; then
        echo "Error al ejecutar seeders. Abortando."
        exit 1
    fi
else
    echo "No hay migraciones pendientes. Saltando ejecución."
fi

# Iniciar el servidor Laravel
echo "Iniciando servidor Laravel..."
php artisan serve --host=0.0.0.0 --port=8000