# Dockerfile Frontend Next.js + React

# 1️⃣ Base image Node.js
FROM node:20

# 1️⃣.1️⃣ Installer ca-certificates si pas déja présent
RUN apt-get update && apt-get install -y ca-certificates

# 1️⃣.2️⃣ Copier le certificat Zscaler dans le container
COPY root.crt /usr/local/share/ca-certificates/root.crt

# 1️⃣.3️⃣ Mettre à jour les certificates
RUN update-ca-certificates

# 2️⃣ Créer le répertoire de travail
WORKDIR /var/www/frontend

# 3️⃣ Copier package.json et yarn.lock (ou package-lock.json)
COPY ./frontend/package.json ./frontend/yarn.lock* ./

# 4️⃣ Installer les dépendances
RUN yarn install --frozen-lockfile

# 5️⃣ Copier tout le code source
COPY ./frontend /var/www/frontend

# 6️⃣ Exposer le port du dev server Next.js
EXPOSE 3000

# 7️⃣ Commande de lancement pour le dev server
CMD ["yarn", "dev"]
