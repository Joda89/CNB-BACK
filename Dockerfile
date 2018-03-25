FROM php:7.0-apache

RUN apt-get update && apt-get install -y php7.0-mysql && rm -rf /var/lib/apt/lists/*

RUN a2enmod rewrite

COPY . /var/www/html/
RUN chmod -R 777 /var/www/html/storage