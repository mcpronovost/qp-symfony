FROM php:8-fpm

RUN apt-get update && apt-get install -y libpq-dev libicu-dev \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_pgsql

# Copy existing app directory
COPY . /var/www
WORKDIR /var/www


# Configure non-root user.
ARG PUID=1000
ENV PUID ${PUID}
ARG PGID=1000
ENV PGID ${PGID}

RUN groupmod -o -g ${PGID} www-data && \
    usermod -o -u ${PUID} -g www-data www-data

RUN chown -R www-data:www-data /var/www

# Copy and run composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
RUN composer install --no-interaction

EXPOSE 8080

CMD ["php-fpm"]