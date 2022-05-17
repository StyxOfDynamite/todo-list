FROM php:7.4-cli
COPY . /opt/project
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer
# Install unzip utility and libs needed by zip PHP extension 
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip
RUN docker-php-ext-install zip
WORKDIR /opt/project
CMD [ "php"]