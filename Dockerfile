FROM php:8.4-fpm

# Dependency sistem untuk build ekstensi PHP + Node/NPM (masih dipertahankan
# untuk jaga-jaga kalau ada asset yang perlu di-build via Vite)
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libcurl4-openssl-dev \
    libicu-dev \
    ca-certificates \
    gnupg \
    && curl -fsSL https://deb.nodesource.com/setup_22.x | bash - \
    && apt-get install -y nodejs \
    && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-install \
    pdo_mysql \
    mbstring \
    curl \
    fileinfo \
    xml \
    zip \
    intl \
    pcntl \
    opcache

RUN pecl install redis && docker-php-ext-enable redis

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copy manifest dulu supaya layer composer/npm bisa di-cache
# (rebuild jadi jauh lebih cepat kalau cuma source code yang berubah)
COPY composer.json composer.lock ./
RUN if [ -f composer.json ]; then composer install --no-interaction --prefer-dist --no-scripts --no-autoloader; fi

COPY package.json package-lock.json* ./
RUN if [ -f package.json ]; then npm ci; fi

# Baru copy seluruh source code project API
COPY . .

RUN if [ -f composer.json ]; then composer dump-autoload --optimize; fi
RUN if [ -f package.json ]; then npm run build || true; fi

EXPOSE 9000

CMD ["php-fpm"]
