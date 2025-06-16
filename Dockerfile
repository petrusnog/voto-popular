FROM php:7.4-apache
RUN apt-get update
# Installing development packages.
RUN apt-get install -y \
    git \
    curl \
    zip \
    sudo \
    unzip \
    libicu-dev \
    libbz2-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libreadline-dev \
    libfreetype6-dev \
    libonig-dev \
    libzip-dev \
    g++

# By default, php-apache's image uses the /var/www/html directory, we're changing that here to Laravel's pattern.
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Enabling site's host.
RUN a2enmod rewrite headers

# Configuring php.ini
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
RUN docker-php-ext-install \
    bz2 \
    intl \
    iconv \
    bcmath \
    opcache \
    calendar \
    mbstring \
    pdo_mysql \
    zip

# Installing composer from docker image.
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Solves permission issues in Laravel files.
ARG uid
RUN useradd -G www-data,root -u $uid -d /home/devuser devuser
RUN mkdir -p /home/devuser/.composer && chown -R devuser:devuser /home/devuser/

