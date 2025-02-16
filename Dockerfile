# Use an official PHP image with Apache
FROM php:8.1-apache

# Install necessary PHP extensions for MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy project files to the container
COPY . /var/www/html/

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
