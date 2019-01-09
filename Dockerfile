FROM php:7.3.0-apache-stretch
COPY src/ /var/www
EXPOSE 80