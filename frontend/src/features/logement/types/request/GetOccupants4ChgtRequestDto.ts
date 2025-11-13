/**
 * Request DTO for getting occupants for change
 * Corresponds to: App\Application\Dto\Input\Logement\GetOccupants4ChgtInputDto
 */
export interface GetOccupants4ChgtRequestDto {
  pkImmeuble: number;
  pkOccupant: number;
  IsNew: boolean;
}
