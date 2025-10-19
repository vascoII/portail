// Configuration des routes de l'application
export const ROUTES = {
  // Pages principales
  HOME: "/",
  PAGES: "/pages",

  // Authentification
  LOGIN: "/pages/login",
  RESET_PASSWORD: "/pages/reset-password",
  UPDATE_PASSWORD: "/pages/update-password",

  // Pages légales
  LEGAL_NOTICES: "/pages/legal/legal-notices",
  CGU: "/pages/legal/cgu",
  RGPD: "/pages/legal/rgpd",

  // Dashboard et navigation
  DASHBOARD: "/pages/dashboard",
  SEARCH: "/pages/search",
  PROFILE: "/pages/profile",

  // Immeubles
  IMMEUBLES: "/pages/immeubles",
  IMMEUBLE_DETAIL: (id: string) => `/pages/immeubles/${id}`,
  IMMEUBLE_ANOMALIES: (id: string) => `/pages/immeubles/${id}/anomalies`,
  IMMEUBLE_DYSFUNCTIONS: (id: string) => `/pages/immeubles/${id}/dysfunctions`,
  IMMEUBLE_INTERVENTIONS: (id: string) =>
    `/pages/immeubles/${id}/interventions`,
  IMMEUBLE_LEAKS: (id: string) => `/pages/immeubles/${id}/leaks`,

  // Logements
  LOGEMENTS: "/pages/logements",
  LOGEMENT_DETAIL: (id: string) => `/pages/logements/${id}`,
  LOGEMENT_EDIT: (id: string) => `/pages/logements/${id}/edit`,
  LOGEMENT_ANOMALIES: (id: string) => `/pages/logements/${id}/anomalies`,
  LOGEMENT_DYSFUNCTIONS: (id: string) => `/pages/logements/${id}/dysfunctions`,
  LOGEMENT_INTERVENTIONS: (id: string) =>
    `/pages/logements/${id}/interventions`,
  LOGEMENT_LEAKS: (id: string) => `/pages/logements/${id}/leaks`,
  LOGEMENT_INTERVENTION_DETAIL: (id: string, interventionId: string) =>
    `/pages/logements/${id}/intervention/${interventionId}`,

  // Occupant
  OCCUPANT_DASHBOARD: "/pages/occupant/dashboard",
  OCCUPANT_LOGEMENT: (id: string) => `/pages/occupant/logement/${id}`,
  OCCUPANT_ALERTES: "/pages/occupant/alertes",
  OCCUPANT_SIMULATEUR: "/pages/occupant/simulateur",
  OCCUPANT_ACCOUNT: "/pages/occupant/account",

  // Opérateurs
  OPERATORS: "/pages/operators",
  OPERATOR_CREATE: "/pages/operators/create",
  OPERATOR_EDIT: (id: string) => `/pages/operators/${id}/edit`,
  OPERATOR_VIEW: (id: string) => `/pages/operators/${id}/view`,
  OPERATORS_STATS: "/pages/operators/stats",

  // Factures
  FACTURES: "/pages/factures",
  FACTURE_DETAIL: (id: string) => `/pages/factures/${id}`,

  // Tickets
  TICKETS: "/pages/tickets",
  TICKET_CREATE: "/pages/tickets/create",
  TICKET_DETAIL: (id: string) => `/pages/tickets/${id}`,

  // Interventions
  INTERVENTIONS: "/pages/interventions",
  INTERVENTION_DETAIL: (id: string) => `/pages/interventions/${id}`,
};

// Helper pour la navigation
export const navigateTo = (route: string) => {
  if (typeof window !== "undefined") {
    window.location.href = route;
  }
};
