/**
 * DTO for create user output
 * Corresponds to: App\Application\Dto\Output\Security\CreateOutputDto
 * Extends SuccessOutputDto
 */
import type { SuccessResponseDto } from "../shared/SuccessResponseDto";

export interface CreateResponseDto extends SuccessResponseDto {
  bool: boolean;
}
