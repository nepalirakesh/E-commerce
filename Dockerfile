FROM php:8.1-apache

WORKDIR /var/www/html

# Install necessary packages
RUN apt-get update && \
    apt-get install \
    wget \
    git \
    unzip \
    -y --no-install-recommends


# install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    rm composer-setup.php

# Install PHP Extensions
RUN docker-php-ext-install mysqli pdo pdo_mysql

# copy project files inside image
COPY . .

# install project dependencies
RUN composer install

EXPOSE 8000

# Start Apache in foreground
CMD ["apache2-foreground"]
