/**
 * Request DTO for generating immeuble synthese document by immeuble
 * Corresponds to: App\Application\Dto\Input\Document\GenerateImmeubleSyntheseByImmeubleDocumentInputDto
 */
export interface GenerateImmeubleSyntheseByImmeubleDocumentRequestDto {
  pkImmeuble?: number | null;
  date1: string;
  date2: string;
}
