/**
 * Request DTO for getting anomalies info by immeuble
 * Corresponds to: App\Application\Dto\Input\Immeuble\GetInfosAnomaliesByImmeubleInputDto
 */
export interface GetInfosAnomaliesByImmeubleRequestDto {
  pkImmeuble: string;
  paramsFiltres: string;
}
