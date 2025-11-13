/**
 * Request DTO for patching occupant
 * Corresponds to: App\Application\Dto\Input\Occupant\PatchOccupantInputDto
 */
export interface PatchOccupantRequestDto {
  pkOccupant?: number | null;
  nom?: string | null;
  ref?: string | null;
  dateArrivee?: string | null; // ISO date string (DateTimeImmutable in PHP)
  dateDepart?: string | null; // ISO date string (DateTimeImmutable in PHP)
}
