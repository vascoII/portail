/**
 * Request DTO for generating fuites (leaks) document
 * Corresponds to: App\Application\Dto\Input\Document\GenerateFuitesDocumentInputDto
 */
export interface GenerateFuitesDocumentRequestDto {
  pkImmeuble: number;
  pkLogement?: number | null;
  pkOccupant?: number | null;
  pkAppareil?: number | null;
}
