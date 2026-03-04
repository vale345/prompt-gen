FROM php:8.2-cli

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git unzip libsqlite3-dev \
    && docker-php-ext-install pdo pdo_sqlite

# Setear directorio de trabajo
WORKDIR /opt/render/project/src

# Copiar proyecto
COPY . .

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar dependencias PHP
RUN composer install --no-dev --optimize-autoloader

# Crear archivo sqlite si no existe
RUN touch database/database.sqlite

# Exponer puerto
EXPOSE 10000

# Comando de inicio
CMD php artisan key:generate --force \
 && php artisan config:clear \
 && php artisan migrate --force \
 && php artisan serve --host 0.0.0.0 --port 10000