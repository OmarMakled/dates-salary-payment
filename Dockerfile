FROM php:8.1.0-fpm

ENV TIMEZONE=UTC

RUN apt-get update && apt-get install -y \
    curl \
    zip \
    unzip \
    libicu-dev \
    && rm -r /var/lib/apt/lists/*

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-configure intl

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug

# Set timezone
RUN ln -snf /usr/share/zoneinfo/${TIMEZONE} /etc/localtime && echo ${TIMEZONE} > /etc/timezone \
    && printf '[PHP]\ndate.timezone = "%s"\n' ${TIMEZONE} > /usr/local/etc/php/conf.d/tzone.ini

WORKDIR /var/www
COPY ./composer.* ./