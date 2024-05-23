# Use the official PHP-FPM image for ARM64
FROM php:8.1-fpm

# Install necessary packages and extensions
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev \
    nano \
    && docker-php-ext-install zip pdo pdo_mysql

## Install Xdebug
#RUN pecl install xdebug && docker-php-ext-enable xdebug

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=develop,debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host = host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini;

# Set the working directory
WORKDIR /var/www/html

# Copy the project files into the container
COPY . .

# Create storage and bootstrap/cache directories
RUN mkdir -p storage bootstrap/cache

# Install Composer dependencies
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set permissions on storage and bootstrap/cache directories
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Open ports
EXPOSE 9000

# Start PHP-FPM
CMD ["php-fpm"]
