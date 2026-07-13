FROM serversideup/php:8.2-fpm-nginx-alpine

# Set working directory
WORKDIR /var/www/html

# Switch to root to install Node.js, build assets, and copy entrypoint script
USER root
RUN apk add --no-cache nodejs npm

# Copy the migration script to s6-overlay entrypoint directory
COPY docker-bootstrap.sh /etc/entrypoint.d/run-migrations.sh
RUN chmod +x /etc/entrypoint.d/run-migrations.sh

# Switch back to webuser to copy files and run composer
USER webuser

# Copy application files with correct ownership
COPY --chown=webuser:webgroup . .

# Install PHP dependencies
RUN composer install --no-dev --optimize-autoloader

# Install JS dependencies and compile assets
RUN npm install && npm run build
