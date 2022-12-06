FROM im2x3m4u/laravel-php:1.0

COPY ./docker/custom.ini /usr/local/etc/php/conf.d/custom.ini

WORKDIR /app
COPY ./src /app

RUN set -ex && \
	composer install --no-dev --no-scripts && \
	chown -R www-data:www-data /app/storage /app/bootstrap/cache
