# Structure des Imports - Next.js App Router

## 🚨 **Problème Résolu**

L'erreur `Module not found: Can't resolve '../components/UI/Alert'` a été corrigée.

## 📁 **Structure des Dossiers**

```
frontend/app/
├── components/          # Composants réutilisables
│   ├── UI/             # Composants d'interface
│   ├── Layout/         # Composants de mise en page
│   ├── Forms/          # Composants de formulaires
│   └── ...
├── hooks/              # Hooks personnalisés
├── pages/              # Pages de l'application
│   ├── login/          # Page de connexion
│   │   └── page.tsx    # Composant de page
│   ├── dashboard/      # Tableau de bord
│   │   └── page.tsx
│   └── ...
└── ...
```

## 🔧 **Règles d'Import**

### **1. Pages Directes** (`app/pages/*/page.tsx`)

```typescript
// ✅ Correct
import Component from "../../components/UI/Component";
import { useHook } from "../../hooks/useHook";

// ❌ Incorrect
import Component from "../components/UI/Component";
import { useHook } from "../hooks/useHook";
```

### **2. Pages dans des Sous-dossiers** (`app/pages/*/subfolder/page.tsx`)

```typescript
// ✅ Correct
import Component from "../../../components/UI/Component";
import { useHook } from "../../../hooks/useHook";

// ❌ Incorrect
import Component from "../components/UI/Component";
import { useHook } from "../hooks/useHook";
```

### **3. Pages dans des Sous-sous-dossiers** (`app/pages/*/subfolder/subsubfolder/page.tsx`)

```typescript
// ✅ Correct
import Component from "../../../../components/UI/Component";
import { useHook } from "../../../../hooks/useHook";

// ❌ Incorrect
import Component from "../components/UI/Component";
import { useHook } from "../hooks/useHook";
```

## 🛠️ **Scripts de Correction**

### **1. Correction Automatique des Chemins**

```bash
./scripts/fix-import-paths.sh
```

**Fonctionnalités :**

- ✅ Détecte automatiquement la profondeur des pages
- ✅ Corrige les chemins `../components` → `../../components`
- ✅ Corrige les chemins `../hooks` → `../../hooks`
- ✅ Ajoute `"use client"` si nécessaire

### **2. Vérification des Imports**

```bash
./scripts/verify-imports.sh
```

**Fonctionnalités :**

- ✅ Vérifie tous les fichiers `.tsx` et `.ts`
- ✅ Détecte les imports incorrects
- ✅ Vérifie la présence de `"use client"`
- ✅ Rapport détaillé des erreurs

## 📊 **Fichiers Corrigés**

**Pages Directes :**

- `app/pages/dashboard/page.tsx`
- `app/pages/profile/page.tsx`
- `app/pages/update-password/page.tsx`
- `app/pages/reset-password/page.tsx`

**Pages dans des Sous-dossiers :**

- `app/pages/legal/cgu/page.tsx`
- `app/pages/legal/legal-notices/page.tsx`
- `app/pages/legal/personal-datas/page.tsx`

## ⚠️ **Points d'Attention**

### **1. Directive "use client"**

Tous les composants utilisant des hooks React doivent avoir `"use client"` :

```typescript
"use client"; // ✅ Obligatoire

import { useState, useEffect } from "react";
import { useRouter } from "next/navigation";
```

### **2. Imports Relatifs vs Absolus**

```typescript
// ✅ Relatifs (recommandé)
import Component from "../../components/UI/Component";

// ✅ Absolus (si configuré)
import Component from "@/components/UI/Component";
```

### **3. Types d'Imports**

```typescript
// Composants par défaut
import Component from "../../components/UI/Component";

// Hooks nommés
import { useAuth, useNavigation } from "../../hooks/useAuth";

// Types
import type { User, AuthState } from "../../types/auth";
```

## 🎯 **Bonnes Pratiques**

### **1. Structure des Imports**

```typescript
"use client";

// React
import React, { useState, useEffect } from "react";

// Next.js
import { useRouter } from "next/navigation";
import Link from "next/link";

// Composants locaux
import BaseLayout from "../../components/Layout/BaseLayout";
import Alert from "../../components/UI/Alert";

// Hooks
import { useAuth } from "../../hooks/useAuth";

// Types
import type { User } from "../../types/auth";
```

### **2. Gestion des Erreurs d'Import**

```typescript
// Vérifier que le composant existe
import Component from "../../components/UI/Component";

// Utiliser des imports conditionnels si nécessaire
const DynamicComponent = dynamic(() => import("../../components/UI/Component"));
```

### **3. Optimisation des Imports**

```typescript
// ✅ Imports spécifiques
import { Button } from "../../components/UI/Button";

// ❌ Import de tout le module
import * as UI from "../../components/UI";
```

## 🔍 **Dépannage**

### **Erreur : Module not found**

```bash
# Vérifier que le fichier existe
ls -la app/components/UI/Alert.tsx

# Vérifier le chemin d'import
grep -n "Alert" app/pages/*/page.tsx
```

### **Erreur : Server Component**

```bash
# Ajouter "use client" au début du fichier
echo '"use client";' | cat - app/pages/page.tsx > temp && mv temp app/pages/page.tsx
```

### **Vérification Complète**

```bash
# Exécuter tous les scripts de vérification
./scripts/verify-imports.sh
./scripts/fix-router-imports.sh
./scripts/fix-import-paths.sh
```

## ✅ **Résultat**

- ✅ **Erreurs résolues** : Plus d'erreurs "Module not found"
- ✅ **Structure cohérente** : Tous les imports corrects
- ✅ **Scripts automatisés** : Correction et vérification automatiques
- ✅ **Documentation complète** : Guide de référence

La structure des imports est maintenant **parfaitement organisée** ! 🎉
