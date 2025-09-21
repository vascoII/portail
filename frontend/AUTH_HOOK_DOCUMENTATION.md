# Documentation du Hook useAuth

## 🚨 **Problème Résolu**

L'erreur `Property 'loading' does not exist on type` a été corrigée.

## 🔧 **Propriétés du Hook useAuth**

### **Interface AuthState**

```typescript
interface AuthState {
  user: User | null; // Utilisateur connecté
  token: string | null; // Token d'authentification
  isAuthenticated: boolean; // État de connexion
  isLoading: boolean; // État de chargement
  error: AuthError | null; // Erreur d'authentification
}
```

### **Méthodes Disponibles**

```typescript
interface AuthMethods {
  login: (credentials: LoginFormData) => Promise<void>;
  logout: () => Promise<void>;
  refreshToken: () => Promise<boolean>;
  mutate: KeyedMutator<User | null>;
}
```

## ✅ **Utilisation Correcte**

### **1. Destructuration des Propriétés**

```typescript
// ✅ Correct
const { user, isLoading, error, isAuthenticated, login, logout } = useAuth();

// ❌ Incorrect
const { user, loading, error, isAuthenticated, login, logout } = useAuth();
```

### **2. Gestion des États de Chargement**

```typescript
const LoginPage = () => {
  const { login, isLoading, error, isAuthenticated } = useAuth();

  if (isLoading) {
    return <LoadingSpinner />;
  }

  return (
    <LoginForm
      onSubmit={login}
      loading={isLoading} // ✅ Utilise isLoading
      error={error?.message}
    />
  );
};
```

### **3. Vérification d'Authentification**

```typescript
const ProtectedPage = () => {
  const { user, isAuthenticated, isLoading } = useAuth();

  if (isLoading) {
    return <LoadingSpinner />;
  }

  if (!isAuthenticated) {
    return <LoginRedirect />;
  }

  return <UserContent user={user} />;
};
```

## 🔄 **Corrections Appliquées**

### **Fichiers Corrigés**

- ✅ `app/pages/login/page.tsx`
- ✅ `app/pages/profile/page.tsx`
- ✅ `app/pages/occupant/account/page.tsx`

### **Changements Effectués**

```typescript
// Avant
const { user, loading, error } = useAuth();
if (loading) { ... }

// Après
const { user, isLoading, error } = useAuth();
if (isLoading) { ... }
```

## 🛠️ **Script de Correction**

### **Correction Automatique**

```bash
./scripts/fix-auth-properties.sh
```

**Fonctionnalités :**

- ✅ Détecte les utilisations de `loading` avec `useAuth`
- ✅ Remplace `loading` par `isLoading`
- ✅ Corrige la destructuration et les utilisations
- ✅ Rapport détaillé des corrections

## 📊 **Types TypeScript**

### **AuthState Interface**

```typescript
export interface AuthState {
  user: User | null;
  token: string | null;
  isAuthenticated: boolean;
  isLoading: boolean; // ← Propriété correcte
  error: AuthError | null;
}
```

### **User Interface**

```typescript
export interface User {
  id: string;
  email: string;
  username?: string;
  firstName?: string;
  lastName?: string;
  role: UserRole;
  isActive: boolean;
  createdAt: string;
  lastLoginAt?: string;
  avatar?: string;
}
```

### **AuthError Interface**

```typescript
export interface AuthError {
  message: string;
  code: string;
  field?: string;
}
```

## ⚠️ **Points d'Attention**

### **1. Propriétés de Chargement**

```typescript
// ✅ Correct - utilise isLoading
const { isLoading } = useAuth();

// ❌ Incorrect - loading n'existe pas
const { loading } = useAuth();
```

### **2. Gestion des Erreurs**

```typescript
// ✅ Correct
const { error } = useAuth();
if (error) {
  console.error(error.message);
}

// ❌ Incorrect
const { error } = useAuth();
if (error) {
  console.error(error); // error est un objet AuthError
}
```

### **3. Vérification d'Authentification**

```typescript
// ✅ Correct
const { isAuthenticated, user } = useAuth();
if (isAuthenticated && user) {
  // Utilisateur connecté
}

// ❌ Incorrect
const { isAuthenticated, user } = useAuth();
if (isAuthenticated) {
  // user pourrait être null
}
```

## 🎯 **Bonnes Pratiques**

### **1. Destructuration Complète**

```typescript
const { user, isAuthenticated, isLoading, error, login, logout, refreshToken } =
  useAuth();
```

### **2. Gestion des États**

```typescript
const MyComponent = () => {
  const { user, isLoading, error, isAuthenticated } = useAuth();

  // État de chargement
  if (isLoading) {
    return <LoadingSpinner />;
  }

  // Erreur d'authentification
  if (error) {
    return <ErrorMessage error={error} />;
  }

  // Non authentifié
  if (!isAuthenticated) {
    return <LoginForm />;
  }

  // Authentifié
  return <UserDashboard user={user} />;
};
```

### **3. Gestion des Erreurs**

```typescript
const handleLogin = async (credentials: LoginFormData) => {
  try {
    await login(credentials);
    // Succès
  } catch (error) {
    // L'erreur est déjà gérée par useAuth
    console.error("Login failed:", error);
  }
};
```

## 🔍 **Dépannage**

### **Erreur : Property 'loading' does not exist**

```bash
# Vérifier les utilisations incorrectes
grep -r "loading.*useAuth" app/ --include="*.tsx" --include="*.ts"

# Corriger automatiquement
./scripts/fix-auth-properties.sh
```

### **Erreur : Property 'error' does not exist**

```typescript
// Vérifier que error est destructuré
const { error } = useAuth();

// Vérifier le type
if (error && error.message) {
  console.error(error.message);
}
```

### **Vérification Complète**

```bash
# Exécuter tous les scripts de vérification
./scripts/verify-imports.sh
./scripts/fix-auth-properties.sh
```

## ✅ **Résultat**

- ✅ **Erreurs TypeScript résolues** : Plus d'erreurs de propriétés
- ✅ **Code cohérent** : Tous les composants utilisent `isLoading`
- ✅ **Types corrects** : Interface `AuthState` respectée
- ✅ **Scripts automatisés** : Correction et vérification automatiques

Le hook `useAuth` est maintenant **parfaitement typé et fonctionnel** ! 🎉
