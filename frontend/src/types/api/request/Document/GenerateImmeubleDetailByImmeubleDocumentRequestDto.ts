/**
 * Request DTO for generating immeuble detail document by immeuble
 * Corresponds to: App\Application\Dto\Input\Document\GenerateImmeubleDetailByImmeubleDocumentInputDto
 */
export interface GenerateImmeubleDetailByImmeubleDocumentRequestDto {
  pkImmeuble: number;
  date1: string;
  date2: string;
}
