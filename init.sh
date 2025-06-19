#!/bin/bash

# Forzar HTTPS en Railway
# Verifica y actualiza esta línea
if [ "$RAILWAY_ENVIRONMENT" = "production" ]; then
    # Asegúrate de que este dominio es exactamente el correcto
    export APP_URL=https://Expedined.up.railway.app
fi

# Esperar a que la base de datos esté lista
echo "Esperando a que la base de datos esté disponible..."
until nc -z -v -w30 $DB_HOST $DB_PORT; do
  echo "Esperando conexión a la base de datos..."
  sleep 5
done

    echo "Iniciando migraciones:"
    php artisan migrate --force

    echo "Ejecutando seeders:"
    php artisan db:seed --class=Permissions --force
    php artisan db:seed --class=PermissionsAssignate --force
    


Iniciar el servidor Laravel
echo "Iniciando servidor Laravel..."
php artisan serve --host=0.0.0.0 --port=8000