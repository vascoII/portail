# Structure des Composants React - Migration Symfony/Twig vers Next.js

## 📁 Structure des Dossiers

```
frontend/app/
├── components/
│   ├── Layout/           # Composants de mise en page
│   ├── Forms/            # Composants de formulaires
│   ├── Cards/            # Composants de cartes
│   ├── Panels/           # Composants de panneaux
│   ├── Lists/            # Composants de listes
│   ├── Energy/           # Composants spécifiques à la gestion énergétique
│   └── UI/               # Composants d'interface utilisateur
├── hooks/                # Hooks personnalisés
├── types/                # Types TypeScript
├── pages/                # Pages Next.js
└── index.ts              # Exports principaux
```

## 🧩 Composants Créés

### Layout Components

- **BaseLayout** - Layout principal avec header, sidebar et footer
- **Header** - En-tête avec navigation, recherche et menu utilisateur
- **Sidebar** - Menu latéral
- **Footer** - Pied de page
- **Breadcrumb** - Fil d'Ariane
- **UserMenu** - Menu utilisateur avec options de compte
- **LanguageSelector** - Sélecteur de langue

### Form Components

- **SearchForm** - Formulaire de recherche simple et avancée
- **LoginForm** - Formulaire de connexion
- **PasswordForm** - Formulaire de modification de mot de passe
- **AdvancedSearch** - Recherche avancée avec filtres

### Card Components

- **ImmeubleCard** - Carte d'affichage d'un immeuble
- **LogementCard** - Carte d'affichage d'un logement
- **InterventionCard** - Carte d'affichage d'une intervention

### Panel Components

- **StatusPanel** - Panneau de statut avec jauge
- **ConsumptionPanel** - Panneau de consommation avec graphiques

### List Components

- **ImmeublesList** - Liste des immeubles
- **LogementsList** - Liste des logements
- **InterventionsList** - Liste des interventions avec filtres
- **AnomaliesList** - Liste des anomalies avec filtres

### Energy Components

- **WaterPanel** - Panneau de gestion de l'eau (froide/chaude)
- **HeatingPanel** - Panneau de gestion du chauffage
- **ElectricityPanel** - Panneau de gestion de l'électricité
- **GasPanel** - Panneau de gestion du gaz
- **TemperaturePanel** - Panneau de température/humidité
- **RepartitionPanel** - Panneau de répartition

### UI Components

- **LoadingSpinner** - Indicateur de chargement
- **Alert** - Composant d'alerte
- **Button** - Bouton personnalisé
- **Input** - Input personnalisé
- **Select** - Select personnalisé

## 🎣 Hooks Personnalisés

- **useAuth** - Gestion de l'authentification
- **useImmeubles** - Gestion des immeubles
- **useLogements** - Gestion des logements
- **useInterventions** - Gestion des interventions
- **useConsumption** - Gestion des données de consommation
- **useSearch** - Gestion de la recherche

## 📝 Types TypeScript

- **auth.ts** - Types d'authentification
- **immeuble.ts** - Types des immeubles
- **logement.ts** - Types des logements
- **consumption.ts** - Types de consommation
- **intervention.ts** - Types des interventions
- **common.ts** - Types communs

## 📄 Pages Créées

- **login.tsx** - Page de connexion
- **dashboard.tsx** - Tableau de bord principal
- **immeubles/[id].tsx** - Détail d'un immeuble
- **logements/[id].tsx** - Détail d'un logement

## 🔧 Utilisation

### Import des composants

```typescript
import { BaseLayout, ImmeublesList, useImmeubles } from "../components";
```

### Utilisation des hooks

```typescript
const { immeubles, loading, error } = useImmeubles();
```

### Utilisation des types

```typescript
import { Immeuble, User, ConsumptionData } from "../types";
```

## 🎨 Styling

Les composants utilisent les classes CSS existantes du projet Symfony/Twig pour maintenir la cohérence visuelle. Les classes Bootstrap et les classes personnalisées sont préservées.

## 🔄 Migration

Cette structure permet une migration progressive de Symfony/Twig vers Next.js/React en :

1. Remplaçant les templates Twig par des composants React
2. Conservant la logique métier dans les hooks
3. Maintenant la structure de données avec les types TypeScript
4. Préservant l'interface utilisateur existante

## 📋 Prochaines Étapes

1. Implémenter les API endpoints correspondants
2. Ajouter les tests unitaires
3. Configurer le routing Next.js
4. Intégrer les graphiques et visualisations
5. Ajouter la gestion d'état globale (Redux/Zustand)
6. Implémenter la gestion des erreurs
7. Ajouter les tests d'intégration
