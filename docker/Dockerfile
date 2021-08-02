FROM php:7.2-apache

RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"

ENV APACHE_DOCUMENT_ROOT /var/www

RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN apt-get update
RUN apt-get install -y libssl-dev
RUN apt-get install -y libfreetype6-dev
RUN apt-get install -y libjpeg62-turbo-dev
RUN apt-get install -y libpng-dev
RUN apt-get install -y libmcrypt-dev
RUN apt-get install -y vim
RUN apt-get install -y iputils-ping
RUN curl -sL https://deb.nodesource.com/setup_8.x | bash - \
      && apt-get install -y nodejs

# update npm to last version
RUN apt-get install -y npm

RUN apt-get install -y git

RUN docker-php-ext-install -j$(nproc) iconv zip json


RUN apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql pgsql
RUN pecl install xdebug-2.9.8 && docker-php-ext-enable xdebug
RUN docker-php-ext-install gd

RUN apt-get install unzip -y
RUN apt-get install ghostscript -y
RUN apt-get clean
RUN curl -sS https://getcomposer.org/installer | php -- --filename=composer --install-dir=/usr/local/bin

RUN a2enmod ssl && a2enmod rewrite
RUN a2enmod headers expires

WORKDIR /var/www

EXPOSE 80 443
