# Configuration JWT + Redis pour l'authentification

## Vue d'ensemble

Cette implémentation remplace l'utilisation de `sessionId` et `pkUser` par un système JWT + Redis plus sécurisé.

## Architecture

### Backend

- **JWT Service** : Génère et valide les tokens JWT
- **Redis Service** : Stocke les données utilisateur et sessions
- **Auth Middleware** : Valide les tokens JWT et récupère les données utilisateur
- **Login UseCase** : Intègre JWT et Redis dans le processus de connexion

### Frontend

- **useAuth Hook** : Gère l'authentification avec JWT
- **API Configuration** : Endpoints mis à jour pour utiliser JWT

## Installation

### Prérequis

- PHP 8.2+
- Redis Server
- Composer

### 1. Installation des dépendances

```bash
cd backend
composer install
```

### 2. Configuration des variables d'environnement

Créez un fichier `.env.local` dans le dossier `backend` :

```env
# JWT Configuration
JWT_SECRET=your-super-secret-jwt-key-change-this-in-production
JWT_EXPIRATION=3600

# Redis Configuration
REDIS_URL=redis://localhost:6379
```

### 3. Démarrage de Redis

```bash
# Sur macOS avec Homebrew
brew services start redis

# Sur Ubuntu/Debian
sudo systemctl start redis

# Ou avec Docker
docker run -d -p 6379:6379 redis:alpine
```

## Utilisation

### Endpoints API

#### POST /api/security/login

```json
{
  "username": "DEMOCLIENT",
  "password": "Techem92"
}
```

**Réponse :**

```json
{
  "success": true,
  "jwt": "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9...",
  "userName": "Demo"
}
```

#### GET /api/security/me

**Headers :**

```
Authorization: Bearer <jwt_token>
```

**Réponse :**

```json
{
  "success": true,
  "user": {
    "loginId": "DEMOCLIENT",
    "userName": "Demo",
    "email": "noreply@techem.fr",
    "userType": "C",
    "firstName": "Client",
    "userRole": "MAISON MERE",
    "clientId": "C00892",
    "clientName": "",
    "showImmeublesArc": false,
    "showFactures": true,
    "showChgtOccupant": true,
    "showChantiers": true
  }
}
```

#### POST /api/security/logout

**Headers :**

```
Authorization: Bearer <jwt_token>
```

**Réponse :**

```json
{
  "success": true,
  "message": "Logged out successfully"
}
```

### Frontend

Le hook `useAuth` a été mis à jour pour utiliser JWT :

```typescript
import { useAuth } from "../hooks/useAuth";

const { user, isAuthenticated, login, logout } = useAuth();

// Login
await login({ username: "DEMOCLIENT", password: "Techem92" });

// Logout
await logout();
```

## Sécurité

### JWT Token

- Contient les informations essentielles de l'utilisateur
- Signé avec une clé secrète
- Expiration configurable (par défaut 1 heure)
- Stateless - pas de stockage côté serveur

### Redis

- Stocke les données complètes de l'utilisateur
- Session ID lié au JWT
- TTL configurable
- Nettoyage automatique des sessions expirées

### Avantages

1. **Sécurité** : Pas d'exposition de `sessionId` et `pkUser` au frontend
2. **Performance** : Validation rapide des tokens JWT
3. **Scalabilité** : Redis permet la distribution des sessions
4. **Simplicité** : Un seul token à gérer côté frontend

## Migration

### Ancien système

- Frontend envoie `sessionId` et `pkUser` à chaque requête
- Données utilisateur stockées côté frontend

### Nouveau système

- Frontend envoie uniquement le JWT token
- Données utilisateur récupérées depuis Redis via le JWT
- Session ID et données sensibles cachés du frontend

## Développement

### Structure des fichiers

```
backend/src/
├── Application/Dto/Output/Security/
│   ├── LoginOutputDto.php
│   └── UserDto.php
├── Domain/Service/
│   ├── Jwt/JwtServiceInterface.php
│   ├── Redis/RedisServiceInterface.php
│   └── Auth/AuthServiceInterface.php
├── Infrastructure/Service/
│   ├── Jwt/JwtService.php
│   ├── Redis/RedisService.php
│   └── Auth/AuthService.php
└── Http/
    ├── Action/Security/
    │   ├── LoginAction.php
    │   ├── MeAction.php
    │   └── LogoutAction.php
    └── Middleware/JwtAuthMiddleware.php
```

### Tests

Pour tester l'implémentation :

1. Démarrer Redis
2. Configurer les variables d'environnement
3. Installer les dépendances
4. Tester les endpoints avec Postman ou curl

### Exemple de test avec curl

```bash
# Login
curl -X POST http://localhost:8000/api/security/login \
  -H "Content-Type: application/json" \
  -d '{"username": "DEMOCLIENT", "password": "Techem92"}'

# Récupérer les infos utilisateur
curl -X GET http://localhost:8000/api/security/me \
  -H "Authorization: Bearer <jwt_token>"
```

## Notes importantes

1. **Clé JWT** : Changez la clé secrète en production
2. **Expiration** : Ajustez la durée de vie des tokens selon vos besoins
3. **Redis** : Configurez la persistance Redis selon vos besoins
4. **HTTPS** : Utilisez HTTPS en production pour sécuriser les tokens
5. **Monitoring** : Surveillez l'utilisation de Redis et les performances JWT
