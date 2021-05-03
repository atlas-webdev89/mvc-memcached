FROM php:8.0.2-apache

MAINTAINER atlas <web.dev89@yandex.by>

RUN apt-get update && apt-get -y upgrade \
    && apt-get install -y libmemcached-dev zlib1g-dev net-tools iputils-ping fping git dnsutils\
    && pecl install memcached \
    && docker-php-ext-enable memcached

RUN a2enmod rewrite
