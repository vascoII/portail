# Configuration API - Frontend/Backend ✅

## 🚨 **Problème Résolu**

Configuration centralisée de l'API backend pour le frontend Next.js avec gestion des environnements et des URLs dynamiques.

## 🔧 **Architecture Mise en Place**

### **1. Fichier .env.local**

```bash
# Configuration de l'API Backend
NEXT_PUBLIC_API_BASE_URL=http://localhost:8000
NEXT_PUBLIC_API_VERSION=v1

# Configuration de l'environnement
NODE_ENV=development

# URLs des endpoints
NEXT_PUBLIC_LOGIN_ENDPOINT=/api/auth/login
NEXT_PUBLIC_LOGOUT_ENDPOINT=/api/auth/logout
NEXT_PUBLIC_REFRESH_ENDPOINT=/api/auth/refresh
NEXT_PUBLIC_RESET_PASSWORD_ENDPOINT=/api/auth/reset-password
NEXT_PUBLIC_UPDATE_PASSWORD_ENDPOINT=/api/auth/update-password
```

### **2. Configuration Centralisée (app/config/api.ts)**

```typescript
// Configuration de base
const API_BASE_URL =
  process.env.NEXT_PUBLIC_API_BASE_URL || "http://localhost:8000";
const API_VERSION = process.env.NEXT_PUBLIC_API_VERSION || "v1";

// Construction de l'URL de base de l'API
export const API_URL = `${API_BASE_URL}/api/${API_VERSION}`;

// Endpoints d'authentification
export const AUTH_ENDPOINTS = {
  LOGIN: `${API_URL}/auth/login`,
  LOGOUT: `${API_URL}/auth/logout`,
  REFRESH: `${API_URL}/auth/refresh`,
  RESET_PASSWORD: `${API_URL}/auth/reset-password`,
  UPDATE_PASSWORD: `${API_URL}/auth/update-password`,
  PROFILE: `${API_URL}/auth/profile`,
} as const;
```

## 🎯 **Bonnes Pratiques Implémentées**

### **1. Variables d'Environnement**

- ✅ **NEXT*PUBLIC*\*** : Variables accessibles côté client
- ✅ **Fallback values** : Valeurs par défaut si variables manquantes
- ✅ **Séparation** : Configuration par environnement (.env.local, .env.production)

### **2. Configuration Centralisée**

- ✅ **Single source of truth** : Toutes les URLs dans un seul fichier
- ✅ **Type safety** : Types TypeScript pour tous les endpoints
- ✅ **Maintenance** : Facile à modifier et maintenir

### **3. Gestion d'Erreurs**

```typescript
export const handleApiError = (error: any): ApiError => {
  if (error.response) {
    // Erreur de réponse du serveur
    return {
      message: error.response.data?.message || "Erreur du serveur",
      code: error.response.data?.code,
      details: error.response.data?.details,
      status: error.response.status,
    };
  } else if (error.request) {
    // Erreur de réseau
    return {
      message: "Erreur de connexion au serveur",
      code: "NETWORK_ERROR",
      status: 0,
    };
  } else {
    // Autre erreur
    return {
      message: error.message || "Erreur inconnue",
      code: "UNKNOWN_ERROR",
      status: 0,
    };
  }
};
```

### **4. Headers Standardisés**

```typescript
export const DEFAULT_HEADERS = {
  "Content-Type": "application/json",
  Accept: "application/json",
} as const;
```

## 🔄 **Migration des Hooks**

### **1. useAuth.ts - Avant**

```typescript
const response = await fetch("/api/auth/login", {
  method: "POST",
  headers: {
    "Content-Type": "application/json",
  },
  body: JSON.stringify(credentials),
});
```

### **2. useAuth.ts - Après**

```typescript
const response = await fetch(AUTH_ENDPOINTS.LOGIN, {
  method: "POST",
  headers: DEFAULT_HEADERS,
  body: JSON.stringify(credentials),
});
```

## 📊 **Endpoints Configurés**

### **1. Authentification**

| Endpoint          | URL                                                 | Description                   |
| ----------------- | --------------------------------------------------- | ----------------------------- |
| `LOGIN`           | `http://localhost:8000/api/v1/auth/login`           | Connexion utilisateur         |
| `LOGOUT`          | `http://localhost:8000/api/v1/auth/logout`          | Déconnexion utilisateur       |
| `REFRESH`         | `http://localhost:8000/api/v1/auth/refresh`         | Renouvellement token          |
| `RESET_PASSWORD`  | `http://localhost:8000/api/v1/auth/reset-password`  | Réinitialisation mot de passe |
| `UPDATE_PASSWORD` | `http://localhost:8000/api/v1/auth/update-password` | Modification mot de passe     |
| `PROFILE`         | `http://localhost:8000/api/v1/auth/profile`         | Profil utilisateur            |

### **2. Immeubles**

| Endpoint    | URL                                                     | Description             |
| ----------- | ------------------------------------------------------- | ----------------------- |
| `LIST`      | `http://localhost:8000/api/v1/buildings`                | Liste des immeubles     |
| `DETAIL`    | `http://localhost:8000/api/v1/buildings/{id}`           | Détail d'un immeuble    |
| `ANOMALIES` | `http://localhost:8000/api/v1/buildings/{id}/anomalies` | Anomalies de l'immeuble |

### **3. Logements**

| Endpoint | URL                                               | Description           |
| -------- | ------------------------------------------------- | --------------------- |
| `LIST`   | `http://localhost:8000/api/v1/housings`           | Liste des logements   |
| `DETAIL` | `http://localhost:8000/api/v1/housings/{id}`      | Détail d'un logement  |
| `EDIT`   | `http://localhost:8000/api/v1/housings/{id}/edit` | Édition d'un logement |

## 🧪 **Tests de Validation**

### **Script de Test Automatique**

```bash
./scripts/test-api-config.sh
```

**Résultats :**

- ✅ Fichier .env.local trouvé
- ✅ Variables d'environnement configurées
- ✅ Fichier de configuration API trouvé
- ✅ Endpoints d'authentification configurés
- ✅ useAuth utilise la configuration
- ✅ reset-password utilise la configuration
- ✅ URL du backend configurée correctement
- ✅ Headers par défaut configurés
- ✅ Gestion d'erreurs configurée
- ✅ Types TypeScript configurés

## 🔧 **Configuration par Environnement**

### **1. Développement (.env.local)**

```bash
NEXT_PUBLIC_API_BASE_URL=http://localhost:8000
NODE_ENV=development
```

### **2. Production (.env.production)**

```bash
NEXT_PUBLIC_API_BASE_URL=https://api.techem.fr
NODE_ENV=production
```

### **3. Staging (.env.staging)**

```bash
NEXT_PUBLIC_API_BASE_URL=https://staging-api.techem.fr
NODE_ENV=staging
```

## 🚀 **Avantages de cette Configuration**

### **1. Flexibilité**

- ✅ **Environnements multiples** : Dev, Staging, Production
- ✅ **URLs dynamiques** : Configuration par environnement
- ✅ **Maintenance facile** : Un seul endroit pour modifier les URLs

### **2. Sécurité**

- ✅ **Variables d'environnement** : Pas de hardcoding des URLs
- ✅ **Séparation des environnements** : Configuration isolée
- ✅ **Types TypeScript** : Validation à la compilation

### **3. Performance**

- ✅ **Configuration centralisée** : Pas de duplication
- ✅ **Cache des endpoints** : URLs calculées une seule fois
- ✅ **Gestion d'erreurs optimisée** : Erreurs standardisées

### **4. Maintenabilité**

- ✅ **Single source of truth** : Toutes les URLs au même endroit
- ✅ **Documentation intégrée** : Types et commentaires
- ✅ **Tests automatisés** : Validation de la configuration

## 📝 **Utilisation dans les Composants**

### **1. Import de la Configuration**

```typescript
import { AUTH_ENDPOINTS, DEFAULT_HEADERS, handleApiError } from "../config/api";
```

### **2. Utilisation des Endpoints**

```typescript
const response = await fetch(AUTH_ENDPOINTS.LOGIN, {
  method: "POST",
  headers: DEFAULT_HEADERS,
  body: JSON.stringify(credentials),
});
```

### **3. Gestion des Erreurs**

```typescript
try {
  // Appel API
} catch (error) {
  const apiError = handleApiError(error);
  setError(apiError.message);
}
```

## 🎉 **Résultat Final**

- ✅ **Configuration centralisée** : Toutes les URLs dans un seul fichier
- ✅ **Variables d'environnement** : Configuration par environnement
- ✅ **Types TypeScript** : Validation à la compilation
- ✅ **Gestion d'erreurs** : Erreurs standardisées
- ✅ **Headers standardisés** : Configuration cohérente
- ✅ **Tests automatisés** : Validation de la configuration
- ✅ **Documentation** : Configuration documentée

La configuration API est maintenant **parfaitement configurée** pour gérer les appels entre le frontend (port 3000) et le backend (port 8000) ! 🚀
