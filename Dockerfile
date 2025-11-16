FROM php:8.3-fpm

# Dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libxml2-dev \
    unzip \
    git \
    && docker-php-ext-install pdo pdo_pgsql xml dom

# Instalar Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .

RUN composer install --no-interaction --prefer-dist

RUN chown -R www-data:www-data storage bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]
