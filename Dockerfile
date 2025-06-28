# Use the official Render PHP base image
FROM render/php:8.2-fpm-alpine

# Set working directory
WORKDIR /var/www/html

# Install PHP extensions required by Laravel
RUN docker-php-ext-install pdo pdo_mysql

# Copy existing application directory contents
COPY . .

# Copy composer.lock and composer.json
COPY composer.lock composer.json ./

# Install composer dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Expose port 8000 for the Laravel server
EXPOSE 8000

# The command to run when the container starts
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]