export interface Immeuble {
  id: string;
  numero: string;
  adresse: string;
  ville: string;
  cp: string;
  nbLogements: number;
  nbAnomalies: number;
  nbDysfonctionnements: number;
  nbInterventions: number;
  nbFuite: number;
  hasTelereleve?: boolean;
  hasNoteOccupant?: boolean;
}

export interface ImmeubleCreateData {
  numero: string;
  adresse: string;
  ville: string;
  cp: string;
  hasTelereleve?: boolean;
  hasNoteOccupant?: boolean;
}

export interface ImmeubleUpdateData extends Partial<ImmeubleCreateData> {
  id: string;
}

export interface ImmeubleFilters {
  numero?: string;
  ville?: string;
  cp?: string;
  hasTelereleve?: boolean;
  hasNoteOccupant?: boolean;
}

export interface ImmeubleStats {
  totalLogements: number;
  totalAnomalies: number;
  totalDysfonctionnements: number;
  totalInterventions: number;
  totalFuite: number;
}
