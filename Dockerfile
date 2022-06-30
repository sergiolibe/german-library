FROM php:8.1-fpm-alpine
# Install modules
WORKDIR /usr/src/app

RUN apk --no-cache add pcre-dev ${PHPIZE_DEPS} \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug \
  && apk del pcre-dev ${PHPIZE_DEPS}

RUN docker-php-ext-install opcache pdo_mysql