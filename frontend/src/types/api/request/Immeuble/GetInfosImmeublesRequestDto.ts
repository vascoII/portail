/**
 * Request DTO for getting immeubles info
 * Corresponds to: App\Application\Dto\Input\Immeuble\GetInfosImmeublesInputDto
 */
export interface GetInfosImmeublesRequestDto {
  pkUser: number;
  paramsFiltres: string;
  paramsInfos: string;
}
