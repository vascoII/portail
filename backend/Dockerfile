# 1️⃣ Base PHP
FROM php:8.2-fpm

# 1️⃣.1️⃣ Installer utilitaires et ca-certificates
RUN apt-get update && apt-get install -y \
    libxml2-dev \
    libpq-dev libicu-dev libonig-dev libzip-dev \
    && docker-php-ext-install pdo pdo_pgsql intl opcache zip soap \
    && rm -rf /var/lib/apt/lists/*


# 1️⃣.2️⃣ Copier le certificat Zscaler
#COPY root.crt /usr/local/share/ca-certificates/root.crt
#RUN update-ca-certificates

# 2️⃣ Installer extensions PHP nécessaires
RUN docker-php-ext-install pdo pdo_pgsql intl opcache zip soap

# 3️⃣ Créer le répertoire de travail
WORKDIR /var/www/backend

# 4️⃣ Copier le code source (le dossier vendor sera monté via volume)
COPY ./backend /var/www/backend

# 5️⃣ Exposer le port de l'API
EXPOSE 8000

# 6️⃣ Commande de lancement pour le POC
CMD ["php", "-S", "0.0.0.0:8000", "-t", "public"]