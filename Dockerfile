FROM php:8.2-fpm

RUN apt-get update && \
    apt-get install -y libzip-dev unzip default-libmysqlclient-dev libexif-dev && \
    docker-php-ext-configure exif && \
    docker-php-ext-install pdo pdo_mysql zip exif

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

COPY . /var/www

RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

RUN composer install --no-interaction --optimize-autoloader

EXPOSE 9000

CMD ["php-fpm"]
