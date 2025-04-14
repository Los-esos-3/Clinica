#!/bin/bash

# Esperar a que la base de datos esté lista
echo "Esperando a que la base de datos esté disponible..."
until nc -z -v -w30 $DB_HOST $DB_PORT; do
  echo "Esperando conexión a la base de datos..."
  sleep 5
done

# Ejecutar migraciones
echo "Ejecutando migraciones..."
php artisan migrate --force

# Verificar si hay errores en las migraciones
if [ $? -ne 0 ]; then
  echo "Error al ejecutar migraciones. Abortando."
  exit 1
fi

# Ejecutar seeders con la bandera --force
echo "Ejecutando seeders..."
php artisan db:seed --class=Permissions --force
php artisan db:seed --class=PermissionsAssignate --force

# Verificar si hay errores en los seeders
if [ $? -ne 0 ]; then
  echo "Error al ejecutar seeders. Abortando."
  exit 1
fi

# Iniciar el servidor Laravel
echo "Iniciando servidor Laravel..."
php artisan serve --host=0.0.0.0 --port=8000