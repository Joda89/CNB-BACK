FROM php:7.0-apache

RUN a2enmod rewrite

COPY . /var/www/html/
RUN chmod -R 777 /var/www/html/storage