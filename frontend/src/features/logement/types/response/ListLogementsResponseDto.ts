/**
 * DTO for list of housing units/logements
 * Corresponds to: App\Application\Dto\Output\Logement\ListLogementsOuputDto
 */
import type { LogementResponseDto } from './LogementResponseDto';

export interface ListLogementsResponseDto {
  listLogementDto: LogementResponseDto[];
}

