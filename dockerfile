FROM --platform=linux/amd64 php:8.2-apache

# Instalar extensiones de PHP
RUN docker-php-ext-install pdo pdo_mysql

# Habilitar mod_rewrite
RUN a2enmod rewrite

# Copiar los archivos de la aplicación al contenedor
COPY . /var/www/html

# Copiar el archivo de configuración de Apache y habilitarlo
COPY laravel.conf /etc/apache2/sites-available/laravel.conf
RUN a2ensite laravel.conf
RUN a2dissite 000-default.conf

# Establecer permisos adecuados
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage \
    && chmod -R 755 /var/www/html/bootstrap/cache

# Exponer el puerto 80
EXPOSE 80
