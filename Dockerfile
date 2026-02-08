# Stage 1: Build dependencies
FROM composer:latest as vendor
COPY composer.json composer.lock ./
RUN composer install --ignore-platform-reqs --no-interaction --no-plugins --no-scripts --prefer-dist --no-dev

# Stage 2: Production image
FROM php:8.1-apache

# Install system dependencies
RUN apt-get update && apt-get install -y \
    libmariadb-dev \
    unzip \
    zip \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mysqli

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set environment variables for production
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
ENV APP_ENV=production

# Configure Apache
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Set working directory
WORKDIR /var/www/html

# Copy application files
COPY . .

# Copy vendor from Stage 1
COPY --from=vendor /app/vendor/ ./vendor/

# Ensure scripts are executable
RUN chmod +x scripts/prod-entrypoint.sh

# Set correct permissions for storage/uploads if any (example)
RUN chown -R www-data:www-data /var/www/html/public/upload

# Expose port 80
EXPOSE 80

# Use production entrypoint
ENTRYPOINT ["scripts/prod-entrypoint.sh"]
