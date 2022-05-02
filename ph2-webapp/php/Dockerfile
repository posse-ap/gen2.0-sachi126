FROM php:7.2-fpm
WORKDIR /var/www/html
COPY php.ini /usr/local/etc/php/
RUN apt-get update \
  && docker-php-ext-install pdo_mysql && \
  docker-php-ext-install pdo_mysql
COPY php.ini /usr/local/etc/php/
# RUN docker-p/hp-ext-install pdo_mysql