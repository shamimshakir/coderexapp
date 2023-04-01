FROM php:8.2-fpm
# Install Dependencies

RUN apt-get update && apt-get install -y git curl libpng-dev libonig-dev libxml2-dev zip unzip libxslt-dev libgcrypt-dev telnet
RUN apt-get install -y wget dpkg fontconfig libfreetype6 libjpeg62-turbo libxrender1 xfonts-75dpi xfonts-base mariadb-client

#install some base extensions
RUN apt-get install -y \
        libzip-dev \
        zip \
        zlib1g-dev\
  && docker-php-ext-install zip \
  && docker-php-ext-install xsl \
  && docker-php-ext-install gd

# Clear Cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo pdo_mysql intl mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /app