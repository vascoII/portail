/**
 * Request DTO for generating logement repart document
 * Corresponds to: App\Application\Dto\Input\Document\GenerateLogementRepartDocumentInputDto
 */
export interface GenerateLogementRepartDocumentRequestDto {
  pkImmeuble: number;
  pkLogement: number;
}
