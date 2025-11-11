/**
 * DTO for reset or create password output
 * Corresponds to: App\Application\Dto\Output\Security\ResetOrCreateOutputDto
 * Extends SuccessOutputDto
 */
import type { SuccessResponseDto } from "../shared/SuccessResponseDto";

export interface ResetOrCreateResponseDto extends SuccessResponseDto {
  bool: boolean;
}
