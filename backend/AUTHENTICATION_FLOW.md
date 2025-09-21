# Flux d'authentification JWT + Redis

## Diagramme de séquence

```
Frontend          Backend           SOAP WS           Redis
   |                 |                 |                |
   |-- POST /login-->|                 |                |
   |                 |-- SOAP call --->|                |
   |                 |<-- User data ---|                |
   |                 |                 |                |
   |                 |-- Store user -->|                |
   |                 |                 |                |-- Store session
   |                 |-- Generate JWT  |                |
   |<-- JWT token ---|                 |                |
   |                 |                 |                |
   |-- GET /me ----->|                 |                |
   |   (JWT token)   |-- Validate JWT  |                |
   |                 |-- Get session ->|                |
   |                 |<-- User data ---|                |
   |<-- User data ---|                 |                |
   |                 |                 |                |
   |-- POST /logout->|                 |                |
   |   (JWT token)   |-- Delete session|                |
   |<-- Success -----|                 |                |-- Delete session
```

## Flux détaillé

### 1. Connexion (Login)

1. **Frontend** envoie `username` et `password` à `/api/security/login`
2. **Backend** appelle le service SOAP pour authentifier l'utilisateur
3. **SOAP WS** retourne les données utilisateur et le `sessionId`
4. **Backend** stocke les données utilisateur dans Redis avec le `sessionId` comme clé
5. **Backend** génère un JWT token contenant le `sessionId` et les infos essentielles
6. **Backend** retourne le JWT token et le `userName` au frontend
7. **Frontend** stocke le JWT token dans localStorage

### 2. Requêtes authentifiées

1. **Frontend** envoie le JWT token dans l'header `Authorization: Bearer <token>`
2. **Middleware JWT** valide le token et extrait le `sessionId`
3. **Backend** récupère les données utilisateur depuis Redis avec le `sessionId`
4. **Backend** ajoute les données utilisateur aux attributs de la requête
5. **Controller** utilise les données utilisateur pour traiter la requête

### 3. Déconnexion (Logout)

1. **Frontend** envoie une requête POST à `/api/security/logout` avec le JWT token
2. **Backend** extrait le `sessionId` du JWT token
3. **Backend** supprime la session de Redis
4. **Backend** retourne une confirmation de déconnexion
5. **Frontend** supprime le JWT token du localStorage

## Avantages de cette approche

### Sécurité

- ✅ `sessionId` et `pkUser` ne sont jamais exposés au frontend
- ✅ JWT token contient uniquement les informations nécessaires
- ✅ Validation côté serveur à chaque requête
- ✅ Sessions stockées de manière sécurisée dans Redis

### Performance

- ✅ Validation JWT rapide (pas de base de données)
- ✅ Données utilisateur mises en cache dans Redis
- ✅ Pas de requêtes SOAP à chaque appel API

### Scalabilité

- ✅ Redis permet la distribution des sessions
- ✅ JWT tokens stateless
- ✅ Possibilité de load balancing

### Simplicité

- ✅ Un seul token à gérer côté frontend
- ✅ Pas de gestion de refresh token
- ✅ API claire et cohérente

## Structure des données

### JWT Payload

```json
{
  "iss": "techem-portail",
  "aud": "techem-client",
  "iat": 1640995200,
  "exp": 1640998800,
  "sub": "1043",
  "data": {
    "sessionId": "128b6158-f027-44cf-89e1-51391c54e99b",
    "userName": "Demo",
    "loginId": "DEMOCLIENT",
    "userType": "C",
    "clientId": "C00892",
    "fkClient": 38227,
    "userRole": "MAISON MERE"
  }
}
```

### Redis Session Data

```json
{
  "loginId": "DEMOCLIENT",
  "userName": "Demo",
  "email": "noreply@techem.fr",
  "userType": "C",
  "pkUser": 1043,
  "address": "",
  "postalCode": "",
  "city": "",
  "fk": 38227,
  "phoneNumber": "",
  "firstName": "Client",
  "userRole": "MAISON MERE",
  "clientName": "",
  "clientId": "C00892",
  "expirationDate": "0001-01-01T00:00:00",
  "passwordExpirationDate": "2025-11-18T14:53:44",
  "cgu": "O",
  "fkClient": 38227,
  "fkClientTop": 38227,
  "nbImmeubles": -1,
  "seuilConsoEf": -1,
  "seuilConsoEc": -1,
  "seuilConsoRepart": -1,
  "seuilConsoCet": -1,
  "seuilConsoActif": true,
  "seuilConsoEmail": "",
  "showImmeublesArc": false,
  "showFactures": true,
  "showChgtOccupant": true,
  "showChantiers": true
}
```

## Configuration requise

### Variables d'environnement

```env
JWT_SECRET=your-super-secret-jwt-key-change-this-in-production
JWT_EXPIRATION=3600
REDIS_URL=redis://localhost:6379
```

### Dépendances PHP

```json
{
  "firebase/php-jwt": "^6.0",
  "predis/predis": "^2.0"
}
```

### Services Symfony

- `App\Domain\Service\Jwt\JwtServiceInterface`
- `App\Domain\Service\Redis\RedisServiceInterface`
- `App\Domain\Service\Auth\AuthServiceInterface`
- `App\Http\Middleware\JwtAuthMiddleware`
