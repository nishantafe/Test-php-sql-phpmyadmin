FROM php:8.3-apache

# Serve the site from /workspace/src
ENV APACHE_DOCUMENT_ROOT=/workspace/src
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
 && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

RUN docker-php-ext-install mysqli pdo pdo_mysql \
 && mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
