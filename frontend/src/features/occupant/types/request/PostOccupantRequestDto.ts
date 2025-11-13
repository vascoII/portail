/**
 * Request DTO for posting occupant
 * Corresponds to: App\Application\Dto\Input\Occupant\PostOccupantInputDto
 */
export interface PostOccupantRequestDto {
  nom?: string | null;
  ref?: string | null;
  dateArrivee?: string | null; // ISO date string (DateTimeImmutable in PHP)
  dateDepart?: string | null; // ISO date string (DateTimeImmutable in PHP)
}
