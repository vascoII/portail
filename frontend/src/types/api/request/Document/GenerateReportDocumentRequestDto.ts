/**
 * Request DTO for generating report document
 * Corresponds to: App\Application\Dto\Input\Document\GenerateReportDocumentInputDto
 */
export interface GenerateReportDocumentRequestDto {
  id: number;
  pdfContent: unknown; // mixed type in PHP - adjust based on actual usage
}
