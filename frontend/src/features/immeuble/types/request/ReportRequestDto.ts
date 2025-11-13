/**
 * Request DTO for report
 * Corresponds to: App\Application\Dto\Input\Immeuble\ReportInputDto
 */
export interface ReportRequestDto {
  pkImmeuble: string;
  type: string;
  energie: string;
}
