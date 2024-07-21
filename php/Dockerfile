FROM php:8.2-fpm

# Install PHP extensions.
RUN apt update && apt install -y g++ zip unzip openssl git zlib1g-dev libssl-dev libicu-dev libzip-dev \
    libfreetype6-dev libpng-dev libjpeg-dev \
    libonig-dev libxslt1-dev libmcrypt-dev acl \
    && docker-php-ext-install pdo pdo_mysql mysqli exif mbstring \
    && pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip gd intl xsl opcache \
    && docker-php-ext-configure gd \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo 'alias sf="php bin/console"' >> ~/.bashrc

RUN docker-php-ext-configure gd --with-jpeg --with-freetype

WORKDIR /var/www/app_symfony6

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN curl -sS https://get.symfony.com/cli/installer | bash

RUN mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

RUN git config --global user.email "balakarthikeyan.anandakumar.eqs.com" \ 
    && git config --global user.name "Balakarthikeyan"