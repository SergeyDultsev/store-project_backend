FROM php:8.2-fpm

RUN apt-get update && \
    apt-get install -y libzip-dev unzip default-libmysqlclient-dev

RUN curl -sSLf \
        -o /usr/local/bin/install-php-extensions \
        https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions && \
    chmod +x /usr/local/bin/install-php-extensions && \
    install-php-extensions ftp gd redis ldap soap bcmath exif iconv mbstring mysqli pdo_mysql intl zip xml simplexml xmlreader pcntl sodium sockets

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

COPY . /var/www

RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-interaction --optimize-autoloader && \
    composer require filament/filament:"^3.2" -W spatie/laravel-medialibrary --no-interaction --optimize-autoloader

EXPOSE 9000

CMD ["php-fpm"]
