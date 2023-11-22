FROM php:7.2.2-apache
RUN docker-php-ext-install mysqli

RUN a2enmod headers
RUN service apache2 restart

RUN usermod -u 1000 www-data
RUN groupmod -g 1000 www-data
