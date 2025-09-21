# Architecture des Pages - Next.js 13+ App Router

## 📁 **Structure des Dossiers**

```
frontend/app/
├── page.tsx                           # Page d'accueil (redirige vers /pages/dashboard)
├── layout.tsx                         # Layout principal
├── globals.css                        # Styles globaux
├── favicon.ico                        # Icône du site
├── pages/                            # 📁 Dossier principal des pages
│   ├── page.tsx                      # Index des pages (redirige vers dashboard)
│   ├── login/page.tsx                # /pages/login
│   ├── reset-password/page.tsx       # /pages/reset-password
│   ├── update-password/page.tsx      # /pages/update-password
│   ├── dashboard/page.tsx            # /pages/dashboard
│   ├── search/page.tsx               # /pages/search
│   ├── profile/page.tsx              # /pages/profile
│   ├── legal/
│   │   ├── legal-notices/page.tsx    # /pages/legal/legal-notices
│   │   ├── cgu/page.tsx              # /pages/legal/cgu
│   │   └── personal-datas/page.tsx   # /pages/legal/personal-datas
│   ├── immeubles/
│   │   ├── page.tsx                  # /pages/immeubles
│   │   └── [id]/
│   │       ├── page.tsx              # /pages/immeubles/[id]
│   │       ├── anomalies/page.tsx    # /pages/immeubles/[id]/anomalies
│   │       ├── dysfunctions/page.tsx # /pages/immeubles/[id]/dysfunctions
│   │       ├── interventions/page.tsx # /pages/immeubles/[id]/interventions
│   │       └── leaks/page.tsx        # /pages/immeubles/[id]/leaks
│   ├── logements/
│   │   ├── page.tsx                  # /pages/logements
│   │   └── [id]/
│   │       ├── page.tsx              # /pages/logements/[id]
│   │       ├── edit/page.tsx         # /pages/logements/[id]/edit
│   │       ├── anomalies/page.tsx    # /pages/logements/[id]/anomalies
│   │       ├── dysfunctions/page.tsx # /pages/logements/[id]/dysfunctions
│   │       ├── interventions/page.tsx # /pages/logements/[id]/interventions
│   │       ├── leaks/page.tsx        # /pages/logements/[id]/leaks
│   │       └── intervention/
│   │           └── [interventionId]/
│   │               └── page.tsx      # /pages/logements/[id]/intervention/[interventionId]
│   ├── occupant/
│   │   ├── dashboard/page.tsx        # /pages/occupant/dashboard
│   │   ├── logement/[id]/page.tsx    # /pages/occupant/logement/[id]
│   │   ├── alertes/page.tsx          # /pages/occupant/alertes
│   │   ├── simulateur/page.tsx       # /pages/occupant/simulateur
│   │   └── account/page.tsx          # /pages/occupant/account
│   ├── operators/
│   │   ├── page.tsx                  # /pages/operators
│   │   ├── create/page.tsx           # /pages/operators/create
│   │   ├── stats/page.tsx            # /pages/operators/stats
│   │   └── [id]/
│   │       ├── edit/page.tsx         # /pages/operators/[id]/edit
│   │       └── view/page.tsx         # /pages/operators/[id]/view
│   ├── factures/
│   │   ├── page.tsx                  # /pages/factures
│   │   └── [id]/page.tsx             # /pages/factures/[id]
│   ├── tickets/
│   │   ├── page.tsx                  # /pages/tickets
│   │   ├── create/page.tsx           # /pages/tickets/create
│   │   └── [id]/page.tsx             # /pages/tickets/[id]
│   └── interventions/
│       ├── page.tsx                  # /pages/interventions
│       └── [id]/page.tsx             # /pages/interventions/[id]
├── components/                       # Composants réutilisables
├── hooks/                           # Hooks personnalisés
├── types/                           # Types TypeScript
└── config/                          # Configuration
    └── routes.ts                    # Configuration des routes
```

## 🎯 **Avantages de cette Architecture**

### **1. Organisation Claire**

- ✅ Toutes les pages dans un seul dossier `pages/`
- ✅ Structure hiérarchique logique
- ✅ Séparation claire entre pages et composants

### **2. URLs Prévisibles**

- ✅ Toutes les URLs commencent par `/pages/`
- ✅ Structure cohérente et prévisible
- ✅ Facile à mémoriser et à naviguer

### **3. Maintenabilité**

- ✅ Facile de trouver une page spécifique
- ✅ Structure modulaire et extensible
- ✅ Séparation des responsabilités

### **4. Évolutivité**

- ✅ Facile d'ajouter de nouvelles pages
- ✅ Structure claire pour les nouveaux développeurs
- ✅ Compatible avec Next.js 13+ App Router

## 🚀 **Utilisation**

### **Navigation**

```typescript
import { ROUTES } from '../config/routes';

// Navigation statique
<Link href={ROUTES.LOGIN}>Se connecter</Link>

// Navigation dynamique
<Link href={ROUTES.IMMEUBLE_DETAIL('123')}>Immeuble 123</Link>

// Navigation programmatique
import { navigateTo } from '../config/routes';
navigateTo(ROUTES.DASHBOARD);
```

### **Imports de Pages**

```typescript
// Import d'une page spécifique
import LoginPage from "../pages/login/page";

// Import avec alias
import { LoginPage } from "../pages";
```

## 📊 **Statistiques**

- **Total des pages** : 41 pages
- **Domaines fonctionnels** : 8 domaines
- **Pages dynamiques** : 15 pages avec paramètres
- **Pages statiques** : 26 pages

## 🔧 **Configuration**

### **Routes Principales**

- `/` → Redirige vers `/pages/dashboard`
- `/pages` → Redirige vers `/pages/dashboard`
- `/pages/login` → Page de connexion
- `/pages/dashboard` → Tableau de bord

### **Routes Dynamiques**

- `/pages/immeubles/[id]` → Détail d'un immeuble
- `/pages/logements/[id]` → Détail d'un logement
- `/pages/operators/[id]/edit` → Édition d'un opérateur

Cette architecture offre une base solide et évolutive pour l'application Next.js ! 🎉
