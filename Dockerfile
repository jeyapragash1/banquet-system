# Use the official Render PHP 8.2 base image
FROM render/php:8.2-fpm

# Set working directory
WORKDIR /var/www/html

# Install PHP extensions required by Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Copy existing application directory contents
COPY . .

# Copy composer.lock and composer.json
COPY composer.lock composer.json ./

# Install composer dependencies
# The --ignore-platform-reqs flag is needed for the new image
RUN composer install --no-interaction --optimize-autoloader --no-dev --ignore-platform-reqs

# Generate the application key during the build
RUN php artisan key:generate

# Link the storage folder
RUN php artisan storage:link

# Expose port 8000 for the Laravel server
EXPOSE 8000

# The command to run when the container starts
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]