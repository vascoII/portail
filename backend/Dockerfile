# Dockerfile Backend Symfony + API Platform (POC minimal)

# 1️⃣ Base PHP
FROM php:8.2-fpm

# 2️⃣ Installer dépendances système et extensions PHP
RUN apt-get update && apt-get install -y \
  git unzip libpq-dev libicu-dev libonig-dev libzip-dev curl \
  && docker-php-ext-install pdo pdo_pgsql intl opcache zip

# 3️⃣ Installer Composer directement dans le container
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# 4️⃣ Créer le répertoire de travail
WORKDIR /var/www/backend

# 5️⃣ Copier le code source
COPY ./backend /var/www/backend

# 6️⃣ Installer les dépendances PHP via Composer
RUN composer install --no-interaction --optimize-autoloader

# 7️⃣ Exposer le port de l'API
EXPOSE 8000

# 8️⃣ Commande de lancement pour le POC
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]

