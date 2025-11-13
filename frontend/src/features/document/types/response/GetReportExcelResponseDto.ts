/**
 * DTO for Excel report output
 * Corresponds to: App\Application\Dto\Output\Document\GetReportExcelOutputDto
 */
export interface GetReportExcelResponseDto {
  content: string | ArrayBuffer; // Binary content of the Excel file (typically base64 encoded string)
  mimeType: string; // Typically 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
  filename: string; // File name, e.g., 'rapport.xlsx'
  length: string; // File size in bytes
}
