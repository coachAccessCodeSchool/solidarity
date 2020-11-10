FROM phpdockerio/php74-fpm:latest

RUN apt-get update \
    && apt-get -y --no-install-recommends install libzip-dev g++ gnupg php-gnupg mcrypt php7.4-mysql php-redis php7.4-bcmath php7.4-gd php-imagick php7.4-intl php-yaml \
    && apt-get clean; rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*

# Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer