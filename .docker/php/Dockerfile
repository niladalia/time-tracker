FROM php:8.3-fpm-alpine

RUN apk --update upgrade \
    && apk add --no-cache autoconf automake make gcc g++ git bash icu-dev libzip-dev linux-headers zip unzip vim --force-missing-repositories

COPY .docker/php/php.ini /usr/local/etc/php/conf.d/docker-php-config.ini

COPY .docker/xdebug-config.ini /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN docker-php-ext-install \
    pdo pdo_mysql

RUN pecl install apcu-5.1.23 &&  pecl install xdebug-3.3.0

RUN docker-php-ext-enable apcu xdebug


RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

WORKDIR /var/www/time_tracker

COPY . .
