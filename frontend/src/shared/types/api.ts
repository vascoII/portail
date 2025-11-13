// API Types - Based on backend JSON structure

// Base API Response wrapper
export interface ApiResponse<T> {
  success: boolean;
  data?: T;
  error?: string;
  message?: string;
}

// Parc Data - From GetParcAction.json
export interface ParcData {
  // Building counts
  nbImmeubles: number;
  nbImmeublesTelereleve: number;
  nbImmeublesTransfertFichiers: number;

  // Counter counts
  nbCompteursARelever: number;
  nbCompteursReleves: number;
  nbLogements: number;
  nbCompteurs: number;

  // Counter types
  nbCompteursEc: number; // Eau Chaude
  nbCompteursEf: number; // Eau Froide
  nbCompteursRepart: number; // Répartiteurs
  nbCompteursCet: number; // Compteur d'énergie thermique
  nbCompteursCapteur: number; // Capteurs
  nbCompteursElect: number; // Électricité (-1 if not available)
  nbCompteursGaz: number; // Gaz (-1 if not available)

  // Alert counts
  nbFuites: number;
  degresFuites: number; // -1 if not available
  nbDepannages: number;
  degresDepannages: number; // -1 if not available
  nbDysfonctionnements: number;
  degresDysfonctionnements: number; // -1 if not available
  nbAnomalies: number;
  degresAnomalies: number; // -1 if not available

  // Construction data
  nbChantiers: number;
  nbCompteursPoses: number;
  nbCompteursCommandes: number;

  // Percentages
  pcImmeublesTelereleve: number;
  pcImmeublesTransfertFichiers: number;
}

// User Data - From authentication/me endpoint
export interface UserData {
  pkUser: number;
  nom: string;
  prenom: string;
  email: string;
  userType: "Client" | "Gestionnaire" | "Occupant";
  showChgtOccupant?: boolean;
  isDemo?: boolean;
  permissions?: string[];
  lastLogin?: string;
  fkClientTop?: number;
}

// Building Data - From ListImmeublesAction.json
export interface ImmeubleDto {
  pkImmeuble: number;
  nom: string;
  numero: string;
  ref: string;
  adresse1: string;
  adresse2?: string;
  adresse3?: string;
  cp: string;
  ville: string;
  hasTelereleve: boolean;
  fkClientTop: number;
  actif: boolean;
  dateActivationClient: string;
  dateActivationOccupant: string;
  hasNoteOccupant: boolean;
  hasDecompteOccupant: boolean;
  hasFactures: boolean;
  hasChantiers: boolean;

  // Counts
  nbLogements: number;
  nbAppareils: number;
  nbDepannages: number;
  nbDepannagesTotal?: number;
  degresDepannages?: number;
  nbDysfonctionnements: number;
  degresDysfonctionnements?: number;

  // Counter types
  nbCompteursEC: number;
  nbCompteursEF: number;
  nbCompteursRepart: number;
  nbCompteursCET: number;
  nbCompteursCapteur: number;
  nbCompteursElect: number;
  nbCompteursGaz: number;

  // Telemetry
  nbCompteursTelereveleTotal?: number;
  nbCompteursTelereveleOK?: number;
  hasTransfertFichiers?: boolean;

  // Alerts
  nbFuites: number;
  nbAnomalies: number;
  nbChantiers: number;
}

// Intervention Data - From ListInterventionsByImmeubleAction.json
export interface InterventionDto {
  pkIntervention: number;
  dateIntervention: string;
  typeIntervention: string;
  description: string;
  statut: string;
  technicien?: string;
  duree?: number;
  fkImmeuble: number;
  fkLogement?: number;
  fkCompteur?: number;
}

// Anomaly Data - From ListAnomaliesByImmeubleAction.json
export interface AnomalieDto {
  pkAnomalie: number;
  dateDetection: string;
  typeAnomalie: string;
  description: string;
  niveau: "Faible" | "Moyen" | "Élevé";
  statut: "Ouvert" | "En cours" | "Fermé";
  fkImmeuble: number;
  fkLogement?: number;
  fkCompteur?: number;
  consommationAnterieure?: number;
  consommationActuelle?: number;
  ecart?: number;
}

// Leak Data - From ListFuitesByImmeubleAction.json
export interface FuiteDto {
  pkFuite: number;
  dateDetection: string;
  typeFuite: string;
  description: string;
  niveau: "Faible" | "Moyen" | "Élevé";
  statut: "Ouvert" | "En cours" | "Fermé";
  fkImmeuble: number;
  fkLogement?: number;
  fkCompteur?: number;
  debitEstime?: number;
  coutEstime?: number;
}

// Dysfunction Data - From ListDysfonctionnementsByImmeubleAction.json
export interface DysfonctionnementDto {
  pkDysfonctionnement: number;
  dateDetection: string;
  typeDysfonctionnement: string;
  description: string;
  niveau: "Faible" | "Moyen" | "Élevé";
  statut: "Ouvert" | "En cours" | "Fermé";
  fkImmeuble: number;
  fkLogement?: number;
  fkCompteur?: number;
  impact?: string;
}

// Logement Data - From ListLogementsByImmeubleAction.json
export interface LogementDto {
  pkLogement: number;
  numero: string;
  etage?: string;
  typeLogement: string;
  surface?: number;
  nbOccupants?: number;
  fkImmeuble: number;
  actif: boolean;
  dateActivation?: string;
  nbCompteurs: number;
  nbCompteursEC: number;
  nbCompteursEF: number;
  nbCompteursRepart: number;
  nbCompteursCET: number;
  nbCompteursCapteur: number;
  nbCompteursElect: number;
  nbCompteursGaz: number;
}

// Compteur Data - From GetLogementEFAction.json, GetLogementECAction.json, etc.
export interface CompteurDto {
  pkCompteur: number;
  numero: string;
  typeCompteur: "EC" | "EF" | "Repart" | "CET" | "Capteur" | "Elect" | "Gaz";
  marque?: string;
  modele?: string;
  dateInstallation?: string;
  dateDerniereLecture?: string;
  indexActuel?: number;
  indexPrecedent?: number;
  consommation?: number;
  fkLogement: number;
  fkImmeuble: number;
  actif: boolean;
  hasTelereleve: boolean;
  statutTelereleve?: "OK" | "Erreur" | "En attente";
}

// Dashboard Data - Transformed data for frontend components
export interface DashboardData {
  // Parc overview data
  NbImmeubles: number;
  NbCompteurs: number;
  NbCompteursEF: number;
  NbCompteursEC: number;
  NbCompteursRepart: number;
  NbCompteursCET: number;
  NbCompteursElect: number;
  NbCompteursGaz: number;
  PcImmeublesTransfertFichiers: number;
  showChgtOccupant: boolean;

  // Status data
  NbFuites: number;
  NbDysfonctionnements: number;
  NbAnomalies: number;
  NbDepannages: number;

  // Construction data
  NbChantiers: number;
  NbCompteursCommandes: number;
  NbCompteursPoses: number;
  DateEntreeChantier: string | null;

  // Demo mode
  isDemo: boolean;
}

// Construction Statistics - Calculated data
export interface ConstructionStats {
  installed: number;
  installed_percent: number;
  remaining: number;
  remaining_percent: number;
  total: number;
}

// Error Types
export interface ApiError {
  code: string;
  message: string;
  details?: any;
  timestamp: string;
}

// Loading States
export interface LoadingState {
  isLoading: boolean;
  error: string | null;
  lastUpdated?: string;
}

// Filter Types
export interface FilterOptions {
  immeubles?: number[];
  logements?: number[];
  types?: string[];
  statuts?: string[];
  dateDebut?: string;
  dateFin?: string;
}

// Pagination
export interface PaginationParams {
  page: number;
  limit: number;
  sortBy?: string;
  sortOrder?: "asc" | "desc";
}

export interface PaginatedResponse<T> {
  data: T[];
  pagination: {
    page: number;
    limit: number;
    total: number;
    totalPages: number;
    hasNext: boolean;
    hasPrev: boolean;
  };
}

// Export types for external use
export type {
  ApiResponse,
  ParcData,
  UserData,
  ImmeubleDto,
  InterventionDto,
  AnomalieDto,
  FuiteDto,
  DysfonctionnementDto,
  LogementDto,
  CompteurDto,
  DashboardData,
  ConstructionStats,
  ApiError,
  LoadingState,
  FilterOptions,
  PaginationParams,
  PaginatedResponse,
};
