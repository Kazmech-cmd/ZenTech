FROM php:8.3-fpm-alpine

# Установка системных зависимостей, Node.js и инструментов сборки
RUN apk add --no-cache \
    nginx \
    nodejs \
    npm \
    libpng-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    oniguruma-dev

# Установка PHP расширений
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Установка Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# Копируем файлы проекта
COPY . .

# Установка PHP и JS зависимостей + сборка фронтенда
RUN composer install --no-dev --optimize-autoloader --no-interaction
RUN npm install && npm run build

# Настройка Nginx
RUN mkdir -p /run/nginx
COPY docker/nginx.conf /etc/nginx/nginx.conf

# Настройка прав для Laravel
RUN chown -r www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 80

CMD nginx && php-fpm