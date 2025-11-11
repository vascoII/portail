/**
 * DTO for list of buildings/immeubles
 * Corresponds to: App\Application\Dto\Output\Immeuble\ListImmeublesOutputDto
 */
import type { ImmeubleResponseDto } from './ImmeubleResponseDto';

export interface ListImmeublesResponseDto {
  listImmeubleDto: ImmeubleResponseDto[];
}

