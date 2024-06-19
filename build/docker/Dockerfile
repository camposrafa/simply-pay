FROM php:8.2-fpm

ENV HOME=/var/www
ENV USER=www-data
ARG UID=1000
ARG php_opc_timestamps
ENV php_opc_timestamps=${php_opc_timestamps}

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev libzip-dev zip unzip tzdata default-mysql-client \
    && docker-php-ext-install zip pdo_mysql mbstring exif pcntl bcmath gd sockets opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

COPY ./build/php/*.ini /usr/local/etc/php/conf.d/
COPY ./build/php/*.conf /usr/local/etc/php-fpm.d/

RUN usermod -u $UID $USER

# Get 2 Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

RUN chown -R $USER:$USER $HOME

WORKDIR $HOME

USER $USER

COPY database/ database/

COPY --chown=$USER:$USER composer.* ./

RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --ignore-platform-reqs \
    --no-interaction \
    # --no-plugins \
    --prefer-dist

COPY --chown=$USER:$USER . .

RUN composer dump-autoload --optimize && \
    php artisan event:cache && \
    php artisan route:cache && \
    php artisan view:cache
