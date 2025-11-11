/**
 * DTO for a single invoice/facture
 * Corresponds to: App\Domain\Entity\Facture
 */
export interface FactureResponseDto {
  pkFacture: number | null;
  numFacture: string | null;
  dateEdition: string | null; // ISO date string (DateTimeImmutable in PHP)
  dateDebut: string | null; // ISO date string (DateTimeImmutable in PHP)
  dateFin: string | null; // ISO date string (DateTimeImmutable in PHP)
  montantTotalHt: number | null;
  montantTotalTtc: number | null;
  montantTotalAPayer: number | null;
  idImm: string | null;
  codeGestio: string | null;
  cp: string | null;
  adresse: string | null;
  ville: string | null;
}

