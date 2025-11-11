/**
 * DTO for Depannage entity (domain entity)
 * Corresponds to: App\Domain\Entity\Depannage
 */
export interface DepannageResponseDto {
  workOrderNumber: string | null;
  numero: string | null;
  statut: string | null;
  statutAbrege: string | null;
  date: string | null; // ISO date string (DateTimeImmutable in PHP)
  motif: string | null;
  motifAbrege: string | null;
  compteRendu: string | null;
}

