# Use an official PHP runtime as a parent image
FROM php:8.3-fpm

# Install system dependencies and PHP extensions
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl \
    nginx \
    supervisor

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql gd

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

RUN mkdir -p /var/log/nginx /var/log/php-fpm
RUN chown -R www-data:www-data /var/log/nginx /var/log/php-fpm

COPY . /var/www

RUN composer install --no-interaction --prefer-dist --optimize-autoloader
RUN ls -la /var/www/vendor

RUN composer --version

COPY ./nginx/nginx.conf /etc/nginx/sites-enabled/default
COPY ./supervisor/supervisord.conf /etc/supervisor/supervisord.conf
RUN chown -R www-data:www-data /var/www # Change the owner of the project to www-data


EXPOSE 80

CMD ["supervisord", "-c", "/etc/supervisor/supervisord.conf"]
