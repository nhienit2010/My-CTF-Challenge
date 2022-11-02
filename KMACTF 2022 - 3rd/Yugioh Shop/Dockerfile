FROM php:7.4-apache

MAINTAINER nhienit

RUN apt-get update
RUN docker-php-ext-install mysqli
RUN a2enmod rewrite
RUN a2enmod headers

WORKDIR /var/www/html

ADD ./src/ /var/www/html/

RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html
RUN chmod -R 777 /var/www/html/uploads

RUN echo "KMACTF{fr0m_XXE_t0_ph4r_uNs3ri4l1ze}" > /n1c3_fl4444g_f0r_r3al_h4ck3r

COPY php.ini /usr/local/etc/php/php.ini-development

VOLUME /var/www/html

ENTRYPOINT service apache2 start && /bin/bash