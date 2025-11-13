/**
 * Request DTO for getting tableau de bord logement
 * Corresponds to: App\Application\Dto\Input\Logement\GetTableauBordLogementInputDto
 */
export interface GetTableauBordLogementRequestDto {
  pkLogement: number;
  pkOccupant: number;
}
