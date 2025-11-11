/**
 * DTO for InfosDepannage entity (domain entity)
 * Corresponds to: App\Domain\Entity\InfosDepannage
 */
import type { LogementResponseDto } from '../logement/LogementResponseDto';
import type { OccupantResponseDto } from '../occupant/OccupantResponseDto';
import type { DepannageResponseDto } from './DepannageResponseDto';

export interface InfosDepannageResponseDto {
  logement: LogementResponseDto | null;
  occupant: OccupantResponseDto | null;
  depannage: DepannageResponseDto | null;
}
