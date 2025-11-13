/**
 * Request DTO for getting logements info by immeuble
 * Corresponds to: App\Application\Dto\Input\Immeuble\GetInfosLogementsByImmeubleInputDto
 * Note: pkImmeuble is required by the API service for the URL path
 */
export interface GetInfosLogementsByImmeubleRequestDto {
  pkImmeuble: string;
  paramsFiltres: string;
  paramsInfos: string;
}
