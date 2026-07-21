# Stage 1: Build assets
FROM docker.io/library/node:20-alpine AS build
WORKDIR /app
COPY package*.json ./
RUN npm install
COPY . .
RUN npm run build

# Stage 2: Composer (explicit stage so Podman can resolve it)
FROM docker.io/library/composer:latest AS composer

# Stage 3: PHP application
FROM docker.io/library/php:8.2-fpm-alpine
WORKDIR /var/www/html

# Install system dependencies
RUN apk add --no-cache \
    curl \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    oniguruma-dev \
    libzip-dev \
    icu-dev

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd intl zip

# Install Composer (copy from explicit composer stage)
COPY --from=composer /usr/bin/composer /usr/bin/composer

# Copy application code
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Copy built assets from Stage 1
COPY --from=build /app/public/build ./public/build

# Copy entrypoint script
COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Set permissions
RUN chown -R www-data:www-data storage bootstrap/cache

# Expose port and start
ENTRYPOINT ["entrypoint.sh"]
EXPOSE 9000
CMD ["php-fpm"]
