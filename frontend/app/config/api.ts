/**
 * Configuration de l'API
 * Centralise toutes les URLs et configurations de l'API backend
 */

// Configuration de base
const API_BASE_URL =
  process.env.NEXT_PUBLIC_API_BASE_URL || "http://backend:8000";
const API_VERSION = process.env.NEXT_PUBLIC_API_VERSION || "v1";

// Construction de l'URL de base de l'API
export const API_URL = `${API_BASE_URL}/api/${API_VERSION}`;

// Endpoints d'authentification
export const AUTH_ENDPOINTS = {
  LOGIN: `${API_URL}/security/login`,
  LOGOUT: `${API_URL}/security/logout`,
  ME: `${API_URL}/security/me`,
  RESET_PASSWORD: `${API_URL}/security/reset-password`,
  UPDATE_PASSWORD: `${API_URL}/security/update-password`,
} as const;

// Endpoints des immeubles
export const BUILDING_ENDPOINTS = {
  LIST: `${API_URL}/buildings`,
  DETAIL: (id: string) => `${API_URL}/buildings/${id}`,
  ANOMALIES: (id: string) => `${API_URL}/buildings/${id}/anomalies`,
  DYSFUNCTIONS: (id: string) => `${API_URL}/buildings/${id}/dysfunctions`,
  INTERVENTIONS: (id: string) => `${API_URL}/buildings/${id}/interventions`,
  LEAKS: (id: string) => `${API_URL}/buildings/${id}/leaks`,
} as const;

// Endpoints des logements
export const HOUSING_ENDPOINTS = {
  LIST: `${API_URL}/housings`,
  DETAIL: (id: string) => `${API_URL}/housings/${id}`,
  EDIT: (id: string) => `${API_URL}/housings/${id}/edit`,
  ANOMALIES: (id: string) => `${API_URL}/housings/${id}/anomalies`,
  DYSFUNCTIONS: (id: string) => `${API_URL}/housings/${id}/dysfunctions`,
  INTERVENTIONS: (id: string) => `${API_URL}/housings/${id}/interventions`,
  LEAKS: (id: string) => `${API_URL}/housings/${id}/leaks`,
  INTERVENTION_DETAIL: (id: string, interventionId: string) =>
    `${API_URL}/housings/${id}/interventions/${interventionId}`,
} as const;

// Endpoints des occupants
export const OCCUPANT_ENDPOINTS = {
  DASHBOARD: `${API_URL}/occupant/dashboard`,
  HOUSING: (id: string) => `${API_URL}/occupant/housing/${id}`,
  ALERTS: `${API_URL}/occupant/alerts`,
  SIMULATOR: `${API_URL}/occupant/simulator`,
  ACCOUNT: `${API_URL}/occupant/account`,
} as const;

// Endpoints des opérateurs
export const OPERATOR_ENDPOINTS = {
  LIST: `${API_URL}/operators`,
  CREATE: `${API_URL}/operators`,
  DETAIL: (id: string) => `${API_URL}/operators/${id}`,
  EDIT: (id: string) => `${API_URL}/operators/${id}/edit`,
  STATS: `${API_URL}/operators/stats`,
} as const;

// Endpoints de facturation
export const BILLING_ENDPOINTS = {
  LIST: `${API_URL}/bills`,
  DETAIL: (id: string) => `${API_URL}/bills/${id}`,
} as const;

// Endpoints de ticketing
export const TICKET_ENDPOINTS = {
  LIST: `${API_URL}/tickets`,
  CREATE: `${API_URL}/tickets`,
  DETAIL: (id: string) => `${API_URL}/tickets/${id}`,
} as const;

// Configuration des headers par défaut
export const DEFAULT_HEADERS = {
  "Content-Type": "application/json",
  Accept: "application/json",
} as const;

// Configuration des timeouts
export const API_TIMEOUTS = {
  DEFAULT: 10000, // 10 secondes
  UPLOAD: 30000, // 30 secondes pour les uploads
  AUTH: 5000, // 5 secondes pour l'auth
} as const;

// Types pour les réponses API
export interface ApiResponse<T = any> {
  data: T;
  message?: string;
  success: boolean;
  status: number;
}

export interface ApiError {
  message: string;
  code?: string;
  details?: any;
  status: number;
}

// Fonction utilitaire pour construire les URLs
export const buildApiUrl = (
  endpoint: string,
  params?: Record<string, string | number>
): string => {
  let url = `${API_BASE_URL}${endpoint}`;

  if (params) {
    const searchParams = new URLSearchParams();
    Object.entries(params).forEach(([key, value]) => {
      searchParams.append(key, String(value));
    });
    url += `?${searchParams.toString()}`;
  }

  return url;
};

// Fonction utilitaire pour gérer les erreurs API
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
