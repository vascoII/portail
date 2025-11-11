/**
 * DTO for a single housing unit/logement entity
 * Corresponds to: App\Domain\Entity\Logement
 */
export interface LogementResponseDto {
  pkLogement: number | null;
  numBatiment: string | null;
  adrBatiment: string | null;
  numEscalier: string | null;
  adrEscalier: string | null;
  numEtage: string | null;
  numOrdre: string | null;
  type: string | null;
}

