/**
 * Request DTO for generating occupant note document
 * Corresponds to: App\Application\Dto\Input\Document\GenerateOccupantNoteDocumentInputDto
 */
export interface GenerateOccupantNoteDocumentRequestDto {
  pkOccupant: number;
  pkImmeuble: number;
  typeEnergie: string | null; // EAU, CHAUFFAGE or null
}
