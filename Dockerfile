# Usamos la versión oficial de PHP con FPM
FROM php:8.3-fpm

# Definir el directorio de trabajo
WORKDIR /var/www

# Instalar dependencias del sistema, extensiones de PHP Y NGINX
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libzip-dev \
    libonig-dev \
    nginx  # <--- AGREGAMOS NGINX AQUÍ

# Instalar extensiones de PHP
RUN docker-php-ext-install pdo_mysql mbstring zip exif pcntl
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar el código del proyecto
COPY . /var/www

# Instalar dependencias de composer (importante para producción)
RUN composer install --no-dev --optimize-autoloader

# Dar permisos a las carpetas de Laravel
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Instalar Node.js (necesario para Vite)
RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - \
    && apt-get install -y nodejs

# Después de tu COPY . . y antes de los permisos, ejecuta:
RUN npm install && npm run build

COPY default.conf /etc/nginx/sites-available/default
# Copiar un archivo de configuración de Nginx (opcional, pero Railway lo agradecerá)
# Si no tienes uno, Railway intentará usar el puerto 80 por defecto.
EXPOSE 80
RUN sed -i 's/listen = \/run\/php\/php8.3-fpm.sock/listen = 9000/' /usr/local/etc/php-fpm.d/www.conf || \
    sed -i 's/listen = 127.0.0.1:9000/listen = 9000/' /usr/local/etc/php-fpm.d/www.conf
# COMANDO FINAL: Ejecuta migraciones, crea el link de imágenes y arranca Nginx + PHP

RUN chmod -R 775 /var/www/storage /var/www/public

CMD sh -c "php artisan storage:link && service nginx start && php-fpm"
