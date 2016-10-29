FROM php:5.6-fpm

MAINTAINER tuslo

ENV PATH $PATH:/root/.composer/vendor/bin

# PHP extensions come first, as they are less likely to change between Yii releases
RUN apt-get update \
    && apt-get clean metadata \
    && apt-get -y install \
            git \
            npm \
        --no-install-recommends \

    # Install PHP extensions
    && apt-get autoremove -y \
    && rm -r /var/lib/apt/lists/* \

    # Don't clear our valuable environment vars in PHP
    && echo "\nclear_env = no" >> /usr/local/etc/php-fpm.conf \

    # Fix write permissions with shared folders
    && usermod -u 1000 www-data

# Next composer and global composer package, as their versions may change from time to time
RUN curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer.phar

# Composer wrapper
COPY composer /usr/local/bin/composer

WORKDIR /var/www/html

# Setup the Xdebug version to install
ENV XDEBUG_VERSION 2.3.3
#ENV XDEBUG_MD5 71a6b75885207e79762e1e7aaf5c3993

# Install Xdebug
RUN set -x \
	&& curl -SL "http://www.xdebug.org/files/xdebug-$XDEBUG_VERSION.tgz" -o xdebug.tgz \
#	&& echo $XDEBUG_MD5 xdebug.tgz | md5sum -c - \
	&& mkdir -p /usr/src/xdebug \
	&& tar -xf xdebug.tgz -C /usr/src/xdebug --strip-components=1 \
	&& rm xdebug.* \
	&& cd /usr/src/xdebug \
	&& phpize \
	&& ./configure \
	&& make -j"$(nproc)" \
	&& make install \
	&& make clean

# Add xbegug config file
ADD xdebug.ini /usr/local/etc/php/conf.d/

WORKDIR /tmp

RUN apt-get update && \
    apt-get -y install vim

WORKDIR /var/www/html