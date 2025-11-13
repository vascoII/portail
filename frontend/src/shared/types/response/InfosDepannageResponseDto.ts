/**
 * DTO for InfosDepannage entity (domain entity)
 * Corresponds to: App\Domain\Entity\InfosDepannage
 */
import type { LogementResponseDto } from '@/src/features/logement/types/response/LogementResponseDto';
import type { OccupantResponseDto } from '@/src/features/occupant/types/response/OccupantResponseDto';
import type { DepannageResponseDto } from './DepannageResponseDto';

export interface InfosDepannageResponseDto {
  logement: LogementResponseDto | null;
  occupant: OccupantResponseDto | null;
  depannage: DepannageResponseDto | null;
}
