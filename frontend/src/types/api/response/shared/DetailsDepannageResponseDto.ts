/**
 * DTO for DetailsDepannage entity (domain entity)
 * Corresponds to: App\Domain\Entity\DetailsDepannage
 */
import type { InfosDepannageResponseDto } from './InfosDepannageResponseDto';
import type { DepannageResponseDto } from './DepannageResponseDto';

export interface DetailsDepannageResponseDto {
  infosDepannage: InfosDepannageResponseDto | null;
  listeDepannagesOccupant: DepannageResponseDto[];
}

