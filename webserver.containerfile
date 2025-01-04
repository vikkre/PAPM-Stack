FROM docker.io/library/php:8.2.15-apache

RUN docker-php-ext-install pdo pdo_mysql
