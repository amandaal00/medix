# Gunakan image PHP + Apache
FROM php:8.2-apache

# Install ekstensi yang dibutuhkan Laravel
RUN apt-get update && apt-get install -y \
    libzip-dev unzip git curl libpng-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql zip mbstring exif pcntl bcmath

# Aktifkan mod_rewrite Apache
RUN a2enmod rewrite

# Salin semua file Laravel ke folder Apache
COPY . /var/www/html

# Set folder kerja
WORKDIR /var/www/html

# Install Composer (dari image composer)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install dependensi Laravel
RUN composer install --no-dev --optimize-autoloader

# Atur permission untuk Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 80
