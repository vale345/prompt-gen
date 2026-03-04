FROM php:8.2-cli

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git unzip libsqlite3-dev curl \
    && docker-php-ext-install pdo pdo_sqlite

# Instalar Node.js (para Vite)
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

WORKDIR /opt/render/project/src

# Copiar proyecto
COPY . .

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Instalar dependencias JS y compilar assets
RUN npm install && npm run build

# Crear archivo sqlite si no existe
RUN touch database/database.sqlite

EXPOSE 10000

CMD php artisan key:generate --force \
 && php artisan config:clear \
 && php artisan migrate --force \
 && php artisan serve --host 0.0.0.0 --port 10000