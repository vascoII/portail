# Structure des Pages - Next.js

## 📁 **Organisation des Dossiers**

La structure des pages est organisée par domaine fonctionnel pour une meilleure maintenabilité et lisibilité :

```
frontend/app/pages/
├── auth/                    # 🔐 Authentification & Sécurité
│   ├── login.tsx
│   ├── reset-password.tsx
│   ├── update-password.tsx
│   └── index.ts
├── legal/                   # ⚖️ Pages légales
│   ├── legal-notices.tsx
│   ├── cgu.tsx
│   ├── personal-datas.tsx
│   └── index.ts
├── dashboard/               # 📊 Tableau de bord
│   ├── index.tsx
│   └── index.ts
├── immeubles/              # 🏢 Gestion des immeubles
│   ├── index.tsx
│   ├── [id].tsx
│   └── index.ts
├── logements/              # 🏠 Gestion des logements
│   ├── index.tsx
│   ├── [id].tsx
│   └── index.ts
├── interventions/          # 🔧 Gestion des interventions
│   ├── index.tsx
│   ├── [id].tsx
│   └── index.ts
├── factures/               # 💰 Gestion des factures
│   ├── index.tsx
│   ├── [id].tsx
│   └── index.ts
├── search/                 # 🔍 Recherche
│   ├── index.tsx
│   └── index.ts
└── index.ts                # 📤 Export principal
```

## 🎯 **Avantages de cette Structure**

### **1. Organisation Logique**

- **Groupement par domaine** : Chaque dossier correspond à un domaine métier
- **Séparation claire** : Authentification, légal, fonctionnel
- **Évolutivité** : Facile d'ajouter de nouvelles pages dans le bon dossier

### **2. Maintenabilité**

- **Navigation intuitive** : Les développeurs savent où chercher
- **Réduction de la complexité** : Moins de fichiers à la racine
- **Gestion des imports** : Chaque dossier a son propre index.ts

### **3. Scalabilité**

- **Ajout facile** : Nouveaux domaines = nouveaux dossiers
- **Réutilisation** : Composants partagés entre pages du même domaine
- **Tests** : Organisation des tests par domaine

## 📄 **Types de Pages par Dossier**

### **🔐 auth/** - Authentification & Sécurité

- **login.tsx** - Page de connexion
- **reset-password.tsx** - Réinitialisation mot de passe
- **update-password.tsx** - Modification mot de passe

### **⚖️ legal/** - Pages légales

- **legal-notices.tsx** - Mentions légales
- **cgu.tsx** - Conditions générales d'utilisation
- **personal-datas.tsx** - Données personnelles (RGPD)

### **📊 dashboard/** - Tableau de bord

- **index.tsx** - Page d'accueil principale

### **🏢 immeubles/** - Gestion des immeubles

- **index.tsx** - Liste des immeubles
- **[id].tsx** - Détail d'un immeuble

### **🏠 logements/** - Gestion des logements

- **index.tsx** - Liste des logements
- **[id].tsx** - Détail d'un logement

### **🔧 interventions/** - Gestion des interventions

- **index.tsx** - Liste des interventions
- **[id].tsx** - Détail d'une intervention

### **💰 factures/** - Gestion des factures

- **index.tsx** - Liste des factures
- **[id].tsx** - Détail d'une facture

### **🔍 search/** - Recherche

- **index.tsx** - Page de recherche

## 🚀 **Utilisation**

### **Import des Pages**

```typescript
// Import spécifique par domaine
import { LoginPage, ResetPasswordPage } from "../pages/auth";
import { LegalNoticesPage, CGUPage } from "../pages/legal";
import { DashboardPage } from "../pages/dashboard";

// Import global (toutes les pages)
import { LoginPage, DashboardPage, ImmeublesListPage } from "../pages";
```

### **Routing Next.js**

```typescript
// Les routes sont automatiquement générées par Next.js
// /auth/login -> auth/login.tsx
// /auth/reset-password -> auth/reset-password.tsx
// /legal/legal-notices -> legal/legal-notices.tsx
// /immeubles -> immeubles/index.tsx
// /immeubles/123 -> immeubles/[id].tsx
```

### **Navigation**

```typescript
import Link from 'next/link';

// Navigation vers les pages
<Link href="/auth/login">Connexion</Link>
<Link href="/legal/cgu">CGU</Link>
<Link href="/immeubles">Immeubles</Link>
<Link href="/immeubles/123">Immeuble 123</Link>
```

## 🔧 **Conventions**

### **Nommage des Fichiers**

- **Pages principales** : `index.tsx`
- **Pages de détail** : `[id].tsx`
- **Pages spécifiques** : `nom-de-page.tsx`

### **Nommage des Composants**

- **Pages de liste** : `NomListPage`
- **Pages de détail** : `NomDetailPage`
- **Pages spécifiques** : `NomPage`

### **Structure des Exports**

```typescript
// Dans chaque index.ts
export { default as NomPage } from "./nom-page";
export { default as AutrePage } from "./autre-page";
```

## 📈 **Évolutions Futures**

### **Nouveaux Domaines**

- **account/** - Gestion du compte utilisateur
- **reports/** - Rapports et statistiques
- **settings/** - Paramètres de l'application
- **notifications/** - Notifications et alertes

### **Sous-domaines**

- **immeubles/analytics/** - Analytics des immeubles
- **interventions/calendar/** - Calendrier des interventions
- **factures/export/** - Export des factures

## 🎨 **Styles et Layouts**

### **Layouts par Type**

- **AuthLayout** - Pages d'authentification
- **BaseLayout** - Pages principales
- **LegalLayout** - Pages légales (optionnel)

### **Styles CSS**

- **auth.css** - Styles pour l'authentification
- **pages.css** - Styles généraux des pages
- **components.css** - Styles des composants

Cette structure permet une migration progressive et organisée de Symfony/Twig vers Next.js/React, en conservant une architecture claire et maintenable.
