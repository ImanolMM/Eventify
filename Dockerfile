FROM php:7.2.2-apache
RUN docker-php-ext-install mysqli

WORKDIR /var/www/html
RUN chown -R www-data:www-data /var/www

RUN chmod 755 /var/www



