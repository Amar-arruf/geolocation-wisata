# escape=`

# images
FROM php:8.1-apache


ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# install dependencies
RUN docker-php-ext-install mysqli
RUN apt-get update && `
    apt-get install -y libicu-dev && `
    docker-php-ext-install intl && `
    docker-php-ext-enable intl

# pindahkan kode project ke direktori kerja Apache
COPY . /var/www/html

# konfigurasi Apache
RUN a2enmod rewrite

# Mengubah kepemilikan file
RUN chown -R www-data:www-data /var/www/html/

# expose


