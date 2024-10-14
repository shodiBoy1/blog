# Use the official PHP 8.0 image with Apache
FROM php:8.0-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Enable the mod_rewrite module in Apache (optional but recommended for clean URLs)
RUN a2enmod rewrite

# Copy application files
COPY . /var/www/html/

# Start Apache in the foreground
CMD ["apache2-foreground"]
