/**
 * Request DTO for getting dysfonctionnements info by immeuble
 * Corresponds to: App\Application\Dto\Input\Immeuble\GetInfosDysfonctionnementsByImmeubleInputDto
 */
export interface GetInfosDysfonctionnementsByImmeubleRequestDto {
  pkImmeuble: string;
  paramsFiltres: string;
}
