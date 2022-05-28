FROM php:7-apache

MAINTAINER nhienit

RUN apt-get update

RUN a2enmod rewrite
RUN a2enmod headers

WORKDIR /var/www/html

ADD ./chall/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html

VOLUME /var/www/html

CMD apache2-foreground