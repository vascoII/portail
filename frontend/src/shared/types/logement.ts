export interface Occupant {
  id: string;
  ref: string;
  nom: string;
  prenom?: string;
  email?: string;
  telephone?: string;
  dateArrivee: string;
  dateDepart?: string;
  pkOccupant: number;
}

export interface Logement {
  id: string;
  numero: string;
  adresse: string;
  ville: string;
  cp: string;
  occupant: Occupant;
  immeubleId: string;
  nbAppareils: number;
  nbCompteurs: {
    eauFroide: number;
    eauChaude: number;
    repartiteurs: number;
    cet: number;
    electricite: number;
    gaz: number;
    capteur: number;
  };
  nbDepannages: number;
  nbDepannagesTotal: number;
  nbDysfonctionnements: number;
}

export interface LogementCreateData {
  numero: string;
  adresse: string;
  ville: string;
  cp: string;
  immeubleId: string;
  occupant: Partial<Occupant>;
}

export interface LogementUpdateData extends Partial<LogementCreateData> {
  id: string;
}

export interface LogementFilters {
  numero?: string;
  ville?: string;
  cp?: string;
  immeubleId?: string;
  occupantRef?: string;
  occupantNom?: string;
}

export interface LogementStats {
  totalAppareils: number;
  totalCompteurs: number;
  totalDepannages: number;
  totalDysfonctionnements: number;
}
