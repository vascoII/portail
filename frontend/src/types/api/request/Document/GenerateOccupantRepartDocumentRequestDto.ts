/**
 * Request DTO for generating occupant repart document
 * Corresponds to: App\Application\Dto\Input\Document\GenerateOccupantRepartDocumentInputDto
 */
export interface GenerateOccupantRepartDocumentRequestDto {
  pkImmeuble: number;
  pkOccupant: number;
}
