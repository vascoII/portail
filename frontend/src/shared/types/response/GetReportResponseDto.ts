/**
 * DTO for report data output
 * Corresponds to: App\Application\Dto\Output\Shared\GetReportOutputDto
 */
export interface GetReportResponseDto {
  data: string;
  filename: string;
  length: string; // File size in bytes
}

