#!/bin/sh

echo "Running database migrations..."
php /var/www/html/artisan migrate --force

echo "Running database seeders..."
php /var/www/html/artisan db:seed --force

echo "Adjusting storage permissions..."
chown -R webuser:webgroup /var/www/html/storage
