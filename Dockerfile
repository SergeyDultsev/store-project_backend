FROM php:8.2-fpm

# Установим системные зависимости и необходимые PHP-расширения
RUN apt-get update && apt-get install -y \
    unzip \
    git \
    curl \
    libzip-dev \
    default-libmysqlclient-dev \
    libexif-dev && \
    docker-php-ext-configure zip && \
    docker-php-ext-install pdo pdo_mysql zip exif && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www

COPY . /var/www

RUN chown -R www-data:www-data /var/www && chmod -R 755 /var/www

RUN composer install --no-interaction --optimize-autoloader

EXPOSE 9000

CMD ["php-fpm"]
