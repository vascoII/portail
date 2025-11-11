/**
 * Request DTO for getting number of tickets inter by logement
 * Corresponds to: App\Application\Dto\Input\Logement\GetNbTicketsInterByLogementInputDto
 */
export interface GetNbTicketsInterByLogementRequestDto {
  pkLogement: number;
  paramsFilters: string;
}
