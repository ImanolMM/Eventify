FROM php:7.2.2-apache
RUN docker-php-ext-install mysqli

RUN chown -R www-data:www-data ./app

RUN chmod 755 ./app



