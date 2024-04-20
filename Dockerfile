FROM php:8.2-apache

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf \
    && echo "LimitRequestBody 0" >> /etc/apache2/apache2.conf \
    && apt-get update && apt-get install -y zlib1g-dev zip libzip-dev nano npm

RUN docker-php-ext-install pdo pdo_mysql zip

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www
COPY . .
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf
COPY .env.example /var/www/.env

RUN composer install && npm install && npm run build && \
    chmod 775 -R /var/www/storage/ && \
    chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite

EXPOSE 80
