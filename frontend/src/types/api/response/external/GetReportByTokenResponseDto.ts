/**
 * DTO for report by token output
 * Corresponds to: App\Application\Dto\Output\External\GetReportByTokenOutputDto
 */
export interface GetReportByTokenResponseDto {
  content: string | ArrayBuffer; // Binary content of the report (typically base64 encoded string)
  mimeType: string; // MIME type of the document
  filename: string; // File name
  length: string; // File size in bytes
}

