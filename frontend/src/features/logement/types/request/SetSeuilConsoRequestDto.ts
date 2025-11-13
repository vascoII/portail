/**
 * Request DTO for setting seuil consommation
 * Corresponds to: App\Application\Dto\Input\Logement\SetSeuilConsoInputDto
 */
export interface SetSeuilConsoRequestDto {
  seuilConsoEf: number;
  seuilConsoEc: number;
  seuilConsoActif: number;
  seuilConsoEmail: number;
}
