FROM php:7.4.8-fpm-alpine
# 更新源为阿里镜像
COPY ./repositories /etc/apk/repositories
# install base rely on
# search by https://pkgs.alpinelinux.org/packages
# alpine not include gcc g++ make
RUN apk --update add --no-cache gcc g++ make \
    autoconf \
    bzip2 \
    bzip2-dev \
    binutils \
    cyrus-sasl-dev \
    freetype-dev \
    icu-dev \
    libc-dev \
    icu-dev \
    libpcre32 \
    libbz2 \
    imagemagick-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libmcrypt-dev \
    libmemcached-dev \
    openldap-dev \
    rabbitmq-c \
    rabbitmq-c-dev \
    libevent-dev \
    libzip-dev

# install core extensions
RUN docker-php-ext-configure gd --with-freetype=/usr/include/ --with-jpeg=/usr/include/ \
    && docker-php-ext-install gd \
    && docker-php-ext-install mysqli \
    && docker-php-ext-install bz2 \
    && docker-php-ext-install zip \
    && docker-php-ext-install pdo_mysql \
    && docker-php-ext-install opcache \
    && docker-php-ext-install ldap \
    && docker-php-ext-install sockets \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install sysvmsg \
    && docker-php-ext-install sysvsem \
    && docker-php-ext-install sysvshm \
    && docker-php-ext-install pcntl \
	# install redis
    && pecl install redis 5.3.1 \
    && docker-php-ext-enable redis \
#    # install imagick
#    && pecl install imagick 3.4.3 \
#    && docker-php-ext-enable imagick \
#    # install swoole
#    && pecl install swoole 4.5.2 \
#    && docker-php-ext-enable swoole \
#    # install mongodb
#    && pecl install mongodb 1.7.4 \
#    && docker-php-ext-enable mongodb \
#    # install event after sockets
#    && pecl install event 2.4.3 \
#    && docker-php-ext-enable event \
#    && mv /usr/local/etc/php/conf.d/docker-php-ext-event.ini /usr/local/etc/php/conf.d/docker-php-ext-zz-event.ini \
    && pecl update-channels \
    && rm -rf /var/cache/apk/* \
    && rm -rf /tmp/pear

#
# build image
# new image
#
FROM php:7.4.8-fpm-alpine

# 更新源为阿里镜像
COPY ./repositories /etc/apk/repositories

RUN apk --update add --no-cache \
    bzip2 \
    bzip2-dev \
    binutils \
    cyrus-sasl-dev \
    freetype-dev \
    icu-dev \
    libc-dev \
    icu-dev \
    libpcre32 \
    libbz2 \
#    imagemagick-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libmcrypt-dev \
    libmemcached-dev \

    openldap-dev \
    libevent-dev \
    libzip-dev \
    && rm -rf /var/cache/apk/* \
    && rm -rf /tmp/pear

COPY --from=0 /usr/local/lib/php/extensions/no-debug-non-zts-20190902/* /usr/local/lib/php/extensions/no-debug-non-zts-20190902/
COPY --from=0 /usr/local/etc/php/conf.d/* /usr/local/etc/php/conf.d/

COPY conf/php.ini /usr/local/etc/php/
COPY conf/php-fpm.conf /usr/local/etc/php/php-fpm.conf

# install composer
# RUN php -r "readfile('http://install.phpcomposer.com/installer');" | php -- --install-dir=/bin/ --filename=composer
# RUN composer config -g repo.packagist composer https://packagist.phpcomposer.com

ENTRYPOINT ["docker-php-entrypoint"]

EXPOSE 9000

CMD ["php-fpm"]
