/**
 * DTO for stored document output
 * Corresponds to: App\Application\Dto\Output\External\StoredDocumentOutputDto
 */
export interface StoredDocumentResponseDto {
  filename: string;
  path: string;
  url: string;
  length: string; // File size in bytes
}

