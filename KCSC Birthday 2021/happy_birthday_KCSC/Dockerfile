# Origin image
FROM php:apache

RUN apt-get update

#RUN apt install mysqli
RUN docker-php-ext-install mysqli

# Entry point
ENTRYPOINT service apache2 start && /bin/bash
