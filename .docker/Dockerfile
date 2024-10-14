# Use the official PHP 8.0 image with Apache
FROM php:8.0-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libzip-dev \
    && docker-php-ext-install mysqli zip \
    && a2enmod rewrite \
    && rm -rf /var/lib/apt/lists/*

# Enable Apache mod_rewrite (if needed)
RUN a2enmod rewrite

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Parsedown using Composer
WORKDIR /var/www/html
RUN composer require erusev/parsedown

# Start Apache in the foreground
CMD ["apache2-foreground"]
