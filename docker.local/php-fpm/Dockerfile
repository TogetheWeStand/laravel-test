FROM php:8.2.6-fpm-alpine3.17

RUN addgroup -g 1000 developer \
    && adduser -u 1000 -D -h /home/developer -G developer -s /bin/sh developer

RUN apk --update add autoconf \
curl \
g++ \
gcc \
git \
libtool \
make \
pkgconfig \
zlib-dev \
libpng-dev \
postgresql-dev \
linux-headers \
libffi-dev \
gettext-dev \
tar

RUN pecl install memcache \
&& docker-php-ext-enable memcache \
&& docker-php-ext-install -j$(nproc) opcache \
&& docker-php-ext-install -j$(nproc) pdo_pgsql \
&& docker-php-ext-install -j$(nproc) pgsql \
&& docker-php-ext-install -j$(nproc) calendar \
&& docker-php-ext-install -j$(nproc) exif \
&& docker-php-ext-install -j$(nproc) ffi \
&& docker-php-ext-install -j$(nproc) gettext \
&& docker-php-ext-install -j$(nproc) shmop \
&& docker-php-ext-install -j$(nproc) sockets \
&& docker-php-ext-install -j$(nproc) sysvmsg \
&& docker-php-ext-install -j$(nproc) sysvsem \
&& docker-php-ext-install -j$(nproc) sysvshm

RUN pecl install xdebug \
&& docker-php-ext-enable xdebug


ENV PHP_IDE_CONFIG 'serverName=test-app.loc'
RUN echo "xdebug.mode=develop,trace,debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.start_with_request = yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.client_port=9001" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.log=/var/log/xdebug.log" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini
RUN echo "xdebug.idekey = PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

USER developer

WORKDIR /var/www/application
