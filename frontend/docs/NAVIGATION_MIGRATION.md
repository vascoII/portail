# Migration next/router vers next/navigation

## 🚨 **Problème Résolu**

L'erreur `You have a Server Component that imports next/router. Use next/navigation instead.` a été corrigée.

## 🔄 **Changements Effectués**

### **1. Remplacement des Imports**

```typescript
// ❌ Ancien (Pages Router)
import { useRouter } from "next/router";

// ✅ Nouveau (App Router)
import { useRouter } from "next/navigation";
```

### **2. Ajout de la Directive "use client"**

```typescript
// ✅ Obligatoire pour les composants utilisant useRouter
"use client";

import { useRouter } from "next/navigation";
```

## 📊 **Fichiers Corrigés**

**Total : 25+ fichiers** ont été mis à jour :

### **Composants**

- `app/components/Forms/AdvancedSearch.tsx`
- `app/components/Forms/SearchForm.tsx`
- `app/components/Layout/LanguageSelector.tsx`
- `app/components/Navigation/NavLink.tsx`
- `app/components/Navigation/BreadcrumbNav.tsx`

### **Hooks**

- `app/hooks/useNavigation.ts`

### **Pages**

- `app/pages/tickets/[id]/page.tsx`
- `app/pages/operators/[id]/edit/page.tsx`
- `app/pages/operators/[id]/view/page.tsx`
- `app/pages/occupant/logement/[id]/page.tsx`
- `app/pages/logements/[id]/intervention/[interventionId]/page.tsx`
- `app/pages/logements/[id]/anomalies/page.tsx`
- `app/pages/logements/[id]/edit/page.tsx`
- `app/pages/logements/[id]/dysfunctions/page.tsx`
- `app/pages/logements/[id]/leaks/page.tsx`
- `app/pages/logements/[id]/page.tsx`
- `app/pages/logements/[id]/interventions/page.tsx`
- `app/pages/update-password/page.tsx`
- `app/pages/factures/[id]/page.tsx`
- `app/pages/reset-password/page.tsx`
- `app/pages/immeubles/[id]/anomalies/page.tsx`
- `app/pages/immeubles/[id]/dysfunctions/page.tsx`
- `app/pages/immeubles/[id]/leaks/page.tsx`
- `app/pages/immeubles/[id]/page.tsx`
- `app/pages/immeubles/[id]/interventions/page.tsx`
- `app/pages/interventions/[id]/page.tsx`

## 🔧 **Script de Correction**

Un script automatique a été créé : `scripts/fix-router-imports.sh`

```bash
# Exécuter le script
./scripts/fix-router-imports.sh
```

## 📚 **Différences Principales**

### **next/router (Pages Router)**

```typescript
import { useRouter } from "next/router";

const router = useRouter();
router.push("/dashboard");
router.replace("/login");
router.back();
router.query.id; // Accès aux paramètres
```

### **next/navigation (App Router)**

```typescript
import { useRouter } from "next/navigation";

const router = useRouter();
router.push("/dashboard");
router.replace("/login");
router.back();
// Les paramètres sont gérés différemment
```

## ⚠️ **Points d'Attention**

### **1. Client Components Obligatoires**

Tous les composants utilisant `useRouter` doivent être des Client Components :

```typescript
"use client"; // ✅ Obligatoire

import { useRouter } from "next/navigation";
```

### **2. Gestion des Paramètres**

```typescript
// ❌ Ancien (Pages Router)
const { id } = router.query;

// ✅ Nouveau (App Router)
import { useParams } from "next/navigation";
const params = useParams();
const id = params.id;
```

### **3. Gestion des Query Parameters**

```typescript
// ❌ Ancien (Pages Router)
const { search } = router.query;

// ✅ Nouveau (App Router)
import { useSearchParams } from "next/navigation";
const searchParams = useSearchParams();
const search = searchParams.get("search");
```

## 🎯 **Bonnes Pratiques**

### **1. Structure des Imports**

```typescript
"use client";

import React from "react";
import { useRouter, useParams, useSearchParams } from "next/navigation";
```

### **2. Gestion des Erreurs**

```typescript
const router = useRouter();

const handleNavigation = () => {
  try {
    router.push("/dashboard");
  } catch (error) {
    console.error("Navigation error:", error);
  }
};
```

### **3. Types TypeScript**

```typescript
import { useParams } from "next/navigation";

interface PageParams {
  id: string;
}

const MyComponent = () => {
  const params = useParams<PageParams>();
  const id = params.id; // Typé comme string
};
```

## ✅ **Vérification**

Pour vérifier qu'il n'y a plus d'imports `next/router` :

```bash
grep -r "next/router" app/ --include="*.tsx" --include="*.ts"
```

**Résultat attendu :** Aucune ligne trouvée.

## 🚀 **Résultat**

- ✅ **Erreur résolue** : Plus d'erreur Server Component
- ✅ **Compatibilité** : App Router Next.js 13+
- ✅ **Performance** : Navigation optimisée
- ✅ **Maintenabilité** : Code moderne et à jour

La migration est maintenant **complète et fonctionnelle** ! 🎉
