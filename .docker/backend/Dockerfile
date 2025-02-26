FROM php:8.3-fpm-alpine

ARG UID=1000
ARG GID=1000

ENV UID=${UID} \
    GID=${GID} \
    PHP_OPCACHE_VALIDATE_TIMESTAMPS=0 \
    PHP_OPCACHE_MAX_ACCELERATED_FILES=20000 \
    PHP_OPCACHE_MEMORY_CONSUMPTION=256 \
    PHP_OPCACHE_INTERNED_STRINGS_BUFFER=16 \
    PHP_OPCACHE_PRELOAD=/var/www/html/preload.php

RUN apk add --no-cache \
        freetype-dev \
        libjpeg-turbo-dev \
        libpng-dev \
        libwebp-dev \
        libxpm-dev \
        zip \
        libzip-dev \
        postgresql-dev \
        postgresql-client \
        bash \
        shadow \
        su-exec \
        tzdata \
        git \
        vim \
        curl \
        unzip \
        supervisor \
        openssh-client \
        autoconf \
        build-base \
        linux-headers \
    && docker-php-ext-configure gd \
        --with-freetype=/usr/include/ \
        --with-jpeg=/usr/include/ \
        --with-webp=/usr/include/ \
    && docker-php-ext-install -j$(nproc) \
        gd \
        zip \
        pdo \
        pdo_pgsql \
        pdo_mysql \
        opcache

RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    &&  echo "xdebug.mode=debug" > /usr/local/etc/php/conf.d/00-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/00-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/00-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/00-xdebug.ini \
    && echo "xdebug.log_level=0" >> /usr/local/etc/php/conf.d/00-xdebug.ini

RUN apk del --no-cache autoconf build-base linux-headers

RUN addgroup -g ${GID} --system laravel \
    && adduser -u ${UID} -G laravel --system -D -s /bin/sh laravel

WORKDIR /var/www/html

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN mkdir -p storage/framework/views storage/logs bootstrap/cache \
    && chown -R laravel:laravel storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

RUN sed -i "s/user = www-data/user = laravel/g" /usr/local/etc/php-fpm.d/www.conf \
    && sed -i "s/group = www-data/group = laravel/g" /usr/local/etc/php-fpm.d/www.conf \
    && echo "php_admin_flag[log_errors] = on" >> /usr/local/etc/php-fpm.d/www.conf \
    && echo "php_admin_value[error_log] = /var/log/php_errors.log" >> /usr/local/etc/php-fpm.d/www.conf

COPY ./.docker/docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

RUN touch /var/www/html/preload.php \
    && chown laravel:laravel /var/www/html/preload.php

USER laravel

ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
