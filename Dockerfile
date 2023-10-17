# Usa una imagen base con PHP y Apache
FROM php:8.0-apache

# Establece el directorio de trabajo
WORKDIR /var/www/html

# Instala dependencias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libzip-dev

RUN docker-php-ext-install zip

# Clona el repositorio de GitHub
RUN git clone https://github.com/JeffersonDavid/enterpriseweb-backend.git .

# Instala las dependencias de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

# Copia el archivo de configuración de Apache
COPY apache-config.conf /etc/apache2/sites-available/000-default.conf

# Habilita el módulo de reescritura de Apache para Laravel
RUN a2enmod rewrite

#damos los permisos necesarios a la carpeta de la aplicación
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 775 /var/www/html



# Expone el puerto en el que se ejecutará la aplicación (por defecto es 80)
EXPOSE 80

# Comando para iniciar la aplicación
CMD ["apache2-foreground"]
# Actualiza las dependencias de Composer
RUN composer update



