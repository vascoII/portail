// Configuration des routes de l'application
export const ROUTES = {
  // Pages principales
  HOME: "/",
  PAGES: "/pages",

  // Authentification
  LOGIN: "/login",
  RESET_PASSWORD: "/reset-password",
  UPDATE_PASSWORD: "/update-password",

  // Pages légales
  LEGAL_NOTICES: "/legal/legal-notices",
  CGU: "/legal/cgu",
  RGPD: "/legal/rgpd",

  // Dashboard et navigation
  DASHBOARD: "/dashboard",
  SEARCH: "/search",
  PROFILE: "/profile",

  // Immeubles
  IMMEUBLES: "/immeubles",
  IMMEUBLE_DETAIL: (id: string) => `/immeubles/${id}`,
  IMMEUBLE_ANOMALIES: (id: string) => `/immeubles/${id}/anomalies`,
  IMMEUBLE_DYSFUNCTIONS: (id: string) => `/immeubles/${id}/dysfunctions`,
  IMMEUBLE_INTERVENTIONS: (id: string) =>
    `/immeubles/${id}/interventions`,
  IMMEUBLE_LEAKS: (id: string) => `/immeubles/${id}/leaks`,

  // Logements
  LOGEMENTS: "/logements",
  LOGEMENT_DETAIL: (id: string) => `/logements/${id}`,
  LOGEMENT_EDIT: (id: string) => `/logements/${id}/edit`,
  LOGEMENT_ANOMALIES: (id: string) => `/logements/${id}/anomalies`,
  LOGEMENT_DYSFUNCTIONS: (id: string) => `/logements/${id}/dysfunctions`,
  LOGEMENT_INTERVENTIONS: (id: string) =>
    `/logements/${id}/interventions`,
  LOGEMENT_LEAKS: (id: string) => `/logements/${id}/leaks`,
  LOGEMENT_INTERVENTION_DETAIL: (id: string, interventionId: string) =>
    `/logements/${id}/intervention/${interventionId}`,

  // Occupant
  OCCUPANT_DASHBOARD: "/occupant/dashboard",
  OCCUPANT_LOGEMENT: (id: string) => `/occupant/logement/${id}`,
  OCCUPANT_ALERTES: "/occupant/alertes",
  OCCUPANT_SIMULATEUR: "/occupant/simulateur",
  OCCUPANT_ACCOUNT: "/occupant/account",

  // Opérateurs
  OPERATORS: "/operators",
  OPERATOR_CREATE: "/operators/create",
  OPERATOR_EDIT: (id: string) => `/operators/${id}/edit`,
  OPERATOR_VIEW: (id: string) => `/operators/${id}/view`,
  OPERATORS_STATS: "/operators/stats",

  // Factures
  FACTURES: "/factures",
  FACTURE_DETAIL: (id: string) => `/factures/${id}`,

  // Tickets
  TICKETS: "/tickets",
  TICKET_CREATE: "/tickets/create",
  TICKET_DETAIL: (id: string) => `/tickets/${id}`,

  // Interventions
  INTERVENTIONS: "/interventions",
  INTERVENTION_DETAIL: (id: string) => `/interventions/${id}`,
};

// Helper pour la navigation
export const navigateTo = (route: string) => {
  if (typeof window !== "undefined") {
    window.location.href = route;
  }
};
