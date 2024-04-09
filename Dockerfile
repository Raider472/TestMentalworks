FROM php:8.3-fpm-alpine

RUN apk --update add msmtp && apk add --no-cache bash

COPY --from=composer /usr/bin/composer /usr/bin/composer