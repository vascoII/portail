export interface Intervention {
  id: string;
  numero: string;
  dateCreation: string;
  statut: "ouvert" | "en_cours" | "ferme";
  type: string;
  description: string;
  priorite: "basse" | "normale" | "haute" | "critique";
  technicien?: string;
  dateIntervention?: string;
  dateResolution?: string;
  immeubleId?: string;
  logementId?: string;
  commentaires?: string;
}

export interface InterventionCreateData {
  type: string;
  description: string;
  priorite: "basse" | "normale" | "haute" | "critique";
  immeubleId?: string;
  logementId?: string;
  technicien?: string;
  dateIntervention?: string;
}

export interface InterventionUpdateData
  extends Partial<InterventionCreateData> {
  id: string;
  statut?: "ouvert" | "en_cours" | "ferme";
  commentaires?: string;
  dateResolution?: string;
}

export interface InterventionFilters {
  statut?: "ouvert" | "en_cours" | "ferme";
  priorite?: "basse" | "normale" | "haute" | "critique";
  type?: string;
  technicien?: string;
  dateDebut?: string;
  dateFin?: string;
  immeubleId?: string;
  logementId?: string;
}

export interface InterventionStats {
  total: number;
  ouvert: number;
  en_cours: number;
  ferme: number;
  parPriorite: {
    basse: number;
    normale: number;
    haute: number;
    critique: number;
  };
}
