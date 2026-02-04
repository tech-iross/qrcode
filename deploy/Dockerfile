# Troque fpm por apache (já vem com servidor web pronto)
FROM php:8.2-apache 

RUN apt-get update && apt-get install -y \
    curl \
    zip \
    unzip \
    git \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-configure gd --with-jpeg --with-freetype \
    && docker-php-ext-install pdo pdo_mysql zip gd

# Habilitar o mod_rewrite do Apache (essencial para rotas do Laravel)
RUN a2enmod rewrite

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# No Apache, o diretório padrão é /var/www/html
WORKDIR /var/www/html

COPY . .
COPY .env.dev .env

# Ajuste para apontar o Apache para a pasta /public do Laravel
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

RUN composer install --no-dev --optimize-autoloader

RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 storage bootstrap/cache

EXPOSE 80