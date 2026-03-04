FROM php:8.2-cli

# Dependencias del sistema
RUN apt-get update && apt-get install -y \
    git unzip libsqlite3-dev curl \
    && docker-php-ext-install pdo pdo_sqlite

# 👉 Instalar Node 20 (NO 18)
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

WORKDIR /opt/render/project/src

# Copiar proyecto
COPY . .

# Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Frontend (Vite)
RUN npm install
RUN npm run build

# Crear SQLite
RUN touch database/database.sqlite

EXPOSE 10000

# CMD php artisan key:generate --force \
#  && php artisan config:clear \
#  && php artisan migrate --force \
#  && php artisan serve --host 0.0.0.0 --port 10000
CMD php artisan migrate --force \
 && php artisan serve --host 0.0.0.0 --port 10000