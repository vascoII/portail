/**
 * Request DTO for generating interventions document
 * Corresponds to: App\Application\Dto\Input\Document\GenerateInterventionsDocumentInputDto
 */
export interface GenerateInterventionsDocumentRequestDto {
  pkImmeuble?: number | null;
  pkLogement?: number | null;
  pkOccupant?: number | null;
  date1?: string | null;
  date2?: string | null;
}
