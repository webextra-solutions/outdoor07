FROM php:7.1-apache
MAINTAINER commit42 <contact@commit42.fr>

RUN requirements="libmcrypt-dev g++ libicu-dev" \
    && apt-get update && apt-get install -y $requirements && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install mcrypt \
    && docker-php-ext-install mbstring \
    && docker-php-ext-install intl \
    && requirementsToRemove="g++" \
    && apt-get purge --auto-remove -y $requirementsToRemove

RUN sed -i "s/\/var\/www\/html/\/var\/www/g" /etc/apache2/sites-enabled/000-default.conf

RUN a2enmod rewrite

ENV DEBUG=1

WORKDIR /var/www
