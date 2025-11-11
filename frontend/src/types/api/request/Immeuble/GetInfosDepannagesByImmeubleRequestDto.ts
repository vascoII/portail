/**
 * Request DTO for getting depannages info by immeuble
 * Corresponds to: App\Application\Dto\Input\Immeuble\GetInfosDepannagesByImmeubleInputDto
 */
export interface GetInfosDepannagesByImmeubleRequestDto {
  pkImmeuble: string;
  paramsFiltres: string;
}
