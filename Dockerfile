FROM php:8.4-apache

# Устанавливаем необходимые расширения для PHP
RUN apt-get update && apt-get install -y libpng-dev libjpeg-dev libfreetype6-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Включаем модуль Apache для работы с .htaccess и mod_rewrite
RUN a2enmod rewrite

# Копируем весь проект в веб-директорию контейнера
COPY . /var/www/html/

# Назначаем владельца и права (чтобы Apache мог читать)
RUN chown -R www-data:www-data /var/www/html \
    && find /var/www/html -type d -exec chmod 755 {} \; \
    && find /var/www/html -type f -exec chmod 644 {} \;

# Настраиваем Apache: AllowOverride All и Require all granted
RUN sed -i 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf \
    && echo '<Directory /var/www/html>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
    </Directory>' > /etc/apache2/conf-available/allow-override.conf \
    && a2enconf allow-override

# Устанавливаем рабочую директорию
WORKDIR /var/www/html

# Открываем порт 80
EXPOSE 80
