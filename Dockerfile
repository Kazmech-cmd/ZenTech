FROM php:8.3-fpm-alpine

# 1. Установка системных зависимостей, библиотек для картинок (jpeg, freetype, webp), Node.js и инструментов сборки
RUN apk add --no-cache \
    nginx \
    nodejs \
    npm \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libwebp-dev \
    libxml2-dev \
    zip \
    unzip \
    git \
    curl \
    oniguruma-dev

# 2. Предварительная настройка расширения gd
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp

# 3. Установка PHP расширений (теперь gd соберется без ошибок)
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

# Автоматически создаем директорию и пустой файл базы данных SQLite внутри контейнера
RUN mkdir -p /var/www/database && touch /var/www/database/database.sqlite

# Настройка прав для Laravel (включая права для папки с базой данных)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache /var/www/database

EXPOSE 80

# Корректный запуск Nginx на переднем плане + PHP-FPM
CMD sh -c "php-fpm -D && nginx -g 'daemon off;'"