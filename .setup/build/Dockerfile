FROM php:8.2-apache

COPY . /var/www/html

# Defina o diretório de trabalho
WORKDIR /var/www/html

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
        libonig-dev \
        libzip-dev \
        zip \
        unzip && \
    docker-php-ext-install pdo_mysql zip && \
    a2enmod rewrite

COPY .setup/build/apache-vhost.conf /etc/apache2/sites-available/000-default.conf

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN a2enmod rewrite

EXPOSE 80

ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
ENV APP_ENV=local
ENV APP_KEY=
ENV APP_DEBUG=true

RUN composer install --dev --optimize-autoloader && \
    php artisan key:generate

RUN php artisan migrate
RUN php artisan db:seed

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

CMD ["apache2-foreground"]