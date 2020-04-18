FROM php:7.4-cli

MAINTAINER Denis Negometyanov <denis.negometyanov@gmail.com>

RUN apt-get update
RUN apt-get install -y curl libfreetype6-dev libmcrypt-dev libzip-dev git

RUN pecl install mcrypt-1.0.3
RUN docker-php-ext-enable mcrypt

RUN docker-php-ext-install iconv
RUN docker-php-ext-install zip
RUN docker-php-ext-install opcache

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer --version

RUN composer global require "phpunit/phpunit"
ENV PATH /root/.composer/vendor/bin:$PATH
RUN ln -s /root/.composer/vendor/bin/phpunit /usr/bin/phpunit

RUN ls -la /usr/local

WORKDIR /code

CMD ["tail", "-f", "/dev/null"]