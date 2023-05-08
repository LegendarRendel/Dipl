FROM php:7.4-fpm-alpine

RUN apk update \
    && apk upgrade \
    && apk add nginx libzip-dev postgresql-libs libpq-dev icu-dev shadow

RUN docker-php-ext-install zip pgsql opcache pdo_pgsql intl

# install composer according https://getcomposer.org/download/
COPY --from=composer:2.4 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/shop

COPY ./composer.json ./composer.lock ./

RUN composer install --prefer-dist --no-progress --no-interaction --no-scripts

RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

COPY --chown=www-data:www-data . /var/www/shop/

COPY ./docker/config/local/php/www.conf /usr/local/etc/php-fpm.d/www.conf
COPY ./docker/config/local/nginx/nginx.conf /etc/nginx/nginx.conf
COPY ./docker/config/local/nginx/default /etc/nginx/sites-enabled/default

COPY docker/entrypoint.sh /entrypoint.sh
RUN chmod +x /entrypoint.sh;
EXPOSE 80
ENTRYPOINT ["/entrypoint.sh"]