FROM mlocati/php-extension-installer:2.4 AS php-extension-installer
FROM composer:2.8 AS composer



FROM php:8.4-fpm-alpine3.20 AS php

RUN apk add --no-cache bash && \
    curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash && \
    apk add symfony-cli && \
    symfony server:ca:install

COPY --from=php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN set -eux; \
    install-php-extensions  \
      pgsql \
      pdo_pgsql \
      opcache;

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

CMD ["symfony", "serve", "--allow-all-ip"]