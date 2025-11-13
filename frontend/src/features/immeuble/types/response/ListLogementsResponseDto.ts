/**
 * DTO for list of logements by immeuble
 * Corresponds to: App\Application\Dto\Output\Immeuble\ListLogementsOuputDto
 * Note: This DTO contains an array of Immeuble entities as per the backend structure
 */
import type { ImmeubleResponseDto } from './ImmeubleResponseDto';

export interface ListLogementsResponseDto {
  immeubleDto: ImmeubleResponseDto[];
}

