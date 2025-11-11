FROM php:8.2.0-apache

RUN apt-get update && apt-get install -y \
    libmagickwand-dev \
    libmagickcore-dev \
    --no-install-recommends \
    && pecl install imagick \
    && docker-php-ext-enable imagick \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite
RUN a2enmod headers

WORKDIR /var/www/html
ADD ./src/ /var/www/html/
COPY ./php.ini /usr/local/etc/php/php.ini-development
COPY flag /flag
COPY readflag /readflag

RUN chown -R root:root /var/www/html \
    && chmod -R 755 /var/www/html \
    && chmod 400 /flag \
    && chmod 111 /readflag \
    && chmod u+s /readflag

ENTRYPOINT service apache2 start && /bin/bash