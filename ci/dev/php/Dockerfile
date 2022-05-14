FROM php:7.2-fpm

ENV REFRESHED_AT 2017-04-03


RUN apt-get update && apt-get install -y \
    curl \
    wget \
    git \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libxslt-dev \
    libicu-dev \
    libmcrypt-dev \
#    libpng12-dev \
    libxml2-dev


#install GD
RUN docker-php-ext-configure gd \
    --with-freetype-dir=/usr/include/freetype2 \
    --with-png-dir=/usr/include \
    --with-jpeg-dir=/usr/include \
    && docker-php-ext-install gd

#install Imagemagick & PHP Imagick ext
RUN apt-get update && apt-get install -y \
        libmagickwand-dev --no-install-recommends

RUN pecl install imagick && docker-php-ext-enable imagick

#install mcrypt
RUN pecl install mcrypt-1.0.1 \
    && docker-php-ext-enable mcrypt

#RUN docker-php-ext-configure mcrypt && docker-php-ext-install -j$(nproc) mcrypt

#install other
RUN docker-php-ext-install -j$(nproc) iconv
RUN docker-php-ext-install -j$(nproc) mbstring
RUN docker-php-ext-install -j$(nproc) mysqli pdo_mysql
RUN docker-php-ext-install -j$(nproc) zip
RUN docker-php-ext-install -j$(nproc) bcmath
RUN docker-php-ext-install -j$(nproc) pcntl

RUN docker-php-ext-configure pdo && docker-php-ext-install pdo

RUN apt-get install -y libpq-dev \
    && docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pgsql pdo_pgsql

RUN apt-get update -y \
    && apt-get install -y libgmp-dev re2c libmhash-dev libmcrypt-dev file \
    && ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/local/include/ \
    && docker-php-ext-configure gmp \
    && docker-php-ext-install gmp

RUN docker-php-ext-configure intl && docker-php-ext-install intl
RUN docker-php-ext-install xsl xml soap
RUN docker-php-ext-enable xml

# install additional soft
RUN export DEBIAN_FRONTEND=noninteractive && \
    apt-get -qq update && \
    apt-get -y install zip unzip git zlib1g-dev libmemcached-dev && \
    rm -rf /var/lib/apt/lists/*

# build redis.so
#RUN git clone -b php7 https://github.com/phpredis/phpredis.git /opt/phpredis \
#    && ( \
#        cd /opt/phpredis \
#        && phpize \
#        && ./configure \
#        && make -j$(nproc) \
#        && make install \
#    ) \
#    && rm -r /opt/phpredis \
#    && docker-php-ext-enable redis.so

# build memcached.so
RUN git clone -b php7 https://github.com/php-memcached-dev/php-memcached /opt/phpmemcached \
    && ( \
        cd /opt/phpmemcached \
        && phpize \
        && ./configure \
        && make -j$(nproc) \
        && make install \
    ) \
    && rm -r /opt/phpmemcached \
    && docker-php-ext-enable memcached.so

RUN git clone https://github.com/edenhill/librdkafka \
    && ( \
        cd librdkafka \
        && ./configure \
        && make \
        && make install \
    )

# build rdkafka.so
RUN pecl install rdkafka \
    && docker-php-ext-enable rdkafka.so
#RUN git clone https://github.com/arnaud-lb/php-rdkafka.git \
#    && ( \
#        cd php-rdkafka \
#        && phpize \
#        && ./configure \
#        && make all -j $(nproc) \
#        && make install \
#    ) \
#    && docker-php-ext-enable rdkafka.so

# build xdebug.so
#RUN git clone -b xdebug_2_5 https://github.com/xdebug/xdebug.git /opt/phpxdebug \
#    && ( \
#        cd /opt/phpxdebug \
#        && phpize \
#        && ./configure \
#        && make -j$(nproc) \
#        && make install \
#    ) \
#    && rm -r /opt/phpxdebug \
#    && docker-php-ext-enable xdebug.so

#RUN echo "\
#    xdebug.idekey=PHPSTORM\n\
#    xdebug.max_nesting_level=300\n\
#    xdebug.remote_enable=1\n\
#    xdebug.remote_connect_back=1\n\
#    xdebug.remote_autostart=1\
#    " >> /usr/local/etc/php/conf.d/xdebug.ini

# build mongodb
#RUN apt-get update && apt-get install -y libssl-dev
#RUN cd /tmp/ && \
#    curl -O https://pecl.php.net/get/mongodb-1.2.8.tgz && \
#    tar zxvf mongodb-1.2.8.tgz && \
#    mkdir -p /usr/src/php/ext && \
#    mv mongodb-1.2.8 /usr/src/php/ext/mongodb

#RUN docker-php-ext-install mongodb

# install extensions
RUN docker-php-ext-install pdo_mysql

# install composer
#ENV COMPOSER_HOME=/tmp/.composer RUN curl -XGET https://getcomposer.org/installer > composer-setup.php && \
#    php composer-setup.php --install-dir=/bin --filename=composer --version=1.3.0 && \
#    rm composer-setup.php

#RUN usermod -u 1000 www-data && \
#    mkdir -p /var/www && \
#    chown -R www-data:www-data /var/www && \
#    chown -R www-data:www-data /tmp/.composer



RUN pecl install mongodb
RUN apt-get update \
    && apt-get install -y \
        librabbitmq-dev \
        libssh-dev \
    && pecl install amqp \
    && docker-php-ext-enable amqp
RUN pecl install redis-3.1.4
RUN pecl install apcu-5.1.12
RUN pecl install memcached-3.0.4
RUN pecl install xdebug
#RUN pecl install memcache-3.0.8
#RUN pecl install memcache
#RUN pecl install mongo
#RUN pecl install amqp-1.9.3
#RUN pecl install mongo


COPY ./config/php.ini /usr/local/etc/php/php.ini

EXPOSE 9000
EXPOSE 18999


RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/local/bin/composer

USER www-data


WORKDIR /var/www

CMD ["php-fpm"]
