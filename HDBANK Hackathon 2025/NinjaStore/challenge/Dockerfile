FROM php:7.4-apache

RUN apt-get update
RUN docker-php-ext-install mysqli
RUN a2enmod rewrite
RUN a2enmod headers

WORKDIR /var/www/html

ADD ./src/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html

COPY php.ini /usr/local/etc/php/php.ini-development

VOLUME /var/www/html

ENTRYPOINT service apache2 start && /bin/bash