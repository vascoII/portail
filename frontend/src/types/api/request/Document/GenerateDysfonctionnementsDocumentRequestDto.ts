/**
 * Request DTO for generating dysfonctionnements document
 * Corresponds to: App\Application\Dto\Input\Document\GenerateDysfonctionnementsDocumentInputDto
 */
export interface GenerateDysfonctionnementsDocumentRequestDto {
  pkImmeuble: number;
  pkLogement?: number | null;
  pkOccupant?: number | null;
}
