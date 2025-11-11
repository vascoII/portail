/**
 * DTO for getting a single building/immeuble
 * Corresponds to: App\Application\Dto\Output\Immeuble\GetImmeubleOutputDto
 */
export interface GetImmeubleResponseDto {
  pkImmeuble: number | null;
  nom: string | null;
  numero: string | null;
  ref: string | null;
  adresse1: string | null;
  adresse2: string | null;
  adresse3: string | null;
  cp: string | null;
  ville: string | null;
  hasTelereleve: boolean | null;
  fkClientTop: number | null;
  actif: boolean | null;
  dateActivationClient: string | null; // ISO date string (DateTimeImmutable in PHP)
  dateActivationOccupant: string | null; // ISO date string (DateTimeImmutable in PHP)
  hasNoteOccupant: boolean | null;
  hasDecompteOccupant: boolean | null;
  hasFactures: boolean | null;
  hasChantiers: boolean | null;
  nbLogements: number | null;
  nbAppareils: number | null;
  nbDepannages: number | null;
  nbDepannagesTotal: number | null;
  degresDepannages: number | null;
  nbDysfonctionnements: number | null;
  degresDysfonctionnements: number | null;
  nbCompteursEC: number | null;
  nbCompteursEF: number | null;
  nbCompteursRepart: number | null;
  nbCompteursCET: number | null;
  nbCompteursCapteur: number | null;
  nbCompteursElect: number | null;
  nbCompteursGaz: number | null;
  nbCompteursTelereveleTotal: number | null;
  nbCompteursTelereveleOK: number | null;
  hasTransfertFichiers: boolean | null;
}

