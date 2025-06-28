# Step 1: Use the official PHP 8.2 image as a base
FROM php:8.2-fpm

# Step 2: Set the working directory
WORKDIR /var/www/html

# Step 3: Install system dependencies needed for Laravel
# (git, curl, libpng, libonig, libxml, zip, unzip)
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Step 4: Install the required PHP extensions for Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Step 5: Install Composer (PHP package manager)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Step 6: Copy the application code into the container
COPY . .

# Step 7: Install composer dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Step 8: Set correct permissions for storage and bootstrap/cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Step 9: Expose port 8000 for the Laravel server
EXPOSE 8000

# Step 10: The command to run when the container starts
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]