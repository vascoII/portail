/**
 * Request DTO for generating anomalies document
 * Corresponds to: App\Application\Dto\Input\Document\GenerateAnomaliesDocumentInputDto
 */
export interface GenerateAnomaliesDocumentRequestDto {
  pkImmeuble: number;
  pkLogement?: number | null;
  pkOccupant?: number | null;
  pkAppareil?: number | null;
}
