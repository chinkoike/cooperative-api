FROM php:8.2-cli

# ติดตั้ง Extensions
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    zip \
    curl \
    && docker-php-ext-install pdo pdo_pgsql zip

# ติดตั้ง Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy โปรเจกต์
WORKDIR /app
COPY . .

# ติดตั้ง Dependencies
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# ตั้งค่า Permission
RUN chmod -R 775 storage bootstrap/cache

EXPOSE 8000

CMD php artisan serve --host=0.0.0.0 --port=${PORT:-8000}