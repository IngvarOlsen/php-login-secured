FROM php:8.3.7-apache

RUN docker-php-ext-install pdo_mysql
RUN a2enmod rewrite
RUN mkdir /var/www/html/php-login

ADD ./src /var/www/html/php-login
EXPOSE 80

RUN chown -R www-data:www-data /var/www