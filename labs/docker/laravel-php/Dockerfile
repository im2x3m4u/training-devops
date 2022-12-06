FROM php:7.4-fpm-alpine3.14

# Add Repositories
RUN rm -f /etc/apk/repositories &&\
    echo "http://dl-cdn.alpinelinux.org/alpine/v3.14/main" >> /etc/apk/repositories && \
    echo "http://dl-cdn.alpinelinux.org/alpine/v3.14/community" >> /etc/apk/repositories

# Libraries
RUN apk add --no-cache --virtual .build-deps \
    imagemagick \
    imagemagick-dev \
    graphicsmagick \
    ghostscript \
    libldap \
    libxslt \
    zlib \
    libpng \
    libjpeg-turbo-dev \
    freetype-dev \
    bzip2-dev \
    icu-dev \
    libxml2-dev \
    libxslt-dev \
    zlib-dev \
    libpng-dev \
    libzip-dev

# Add Build Dependencies
RUN apk add --update --no-cache \
    python3 \
    py3-pip \
    jpegoptim \
    pngquant \
    optipng \
    git \
    unzip \
    vim \
    zip \
    bash \
    mysql-client \
    shared-mime-info \
    curl



RUN docker-php-ext-configure intl

# RUN CFLAGS="$PHP_CFLAGS" CPPFLAGS="$PHP_CPPFLAGS" LDFLAGS="$PHP_LDFLAGS" \
#     pecl install mcrypt-1.0.3 \
#     docker-php-ext-enable mcrypt

RUN CFLAGS="$PHP_CFLAGS" CPPFLAGS="$PHP_CPPFLAGS" LDFLAGS="$PHP_LDFLAGS" \
    pecl install imagick-3.4.3 \
    && docker-php-ext-enable imagick

RUN CFLAGS="$PHP_CFLAGS" CPPFLAGS="$PHP_CPPFLAGS" LDFLAGS="$PHP_LDFLAGS" \
    docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg

RUN CFLAGS="$PHP_CFLAGS" CPPFLAGS="$PHP_CPPFLAGS" LDFLAGS="$PHP_LDFLAGS" \
    docker-php-ext-install \
    bcmath \
    bz2 \
    gd \
    intl \
    mysqli \
    pcntl \
    pdo_mysql \
    sockets \
    zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV PATH="./vendor/bin:$PATH"

# RUN composer global require hirak/prestissimo

# Remove Build Dependencies
RUN apk del -f .build-deps
# Setup Working Dir
WORKDIR /app
