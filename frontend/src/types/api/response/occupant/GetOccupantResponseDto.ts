/**
 * DTO for getting a single occupant
 * Corresponds to: App\Application\Dto\Output\Occupant\GetOccupantOutputDto
 */
import type { OccupantResponseDto } from './OccupantResponseDto';

export interface GetOccupantResponseDto {
  occupant: OccupantResponseDto;
}

