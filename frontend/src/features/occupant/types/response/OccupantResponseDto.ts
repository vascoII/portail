/**
 * DTO for a single occupant entity
 * Corresponds to: App\Domain\Entity\Occupant
 */
export interface OccupantResponseDto {
  pkOccupant: number | null;
  nom: string | null;
  ref: string | null;
  dateArrivee: string | null; // ISO date string (DateTimeImmutable in PHP)
  dateDepart: string | null; // ISO date string (DateTimeImmutable in PHP)
}

