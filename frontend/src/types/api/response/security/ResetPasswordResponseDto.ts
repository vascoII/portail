/**
 * DTO for reset password output
 * Corresponds to: App\Application\Dto\Output\Security\ResetPasswordOutputDto
 * Extends SuccessOutputDto
 */
import type { SuccessResponseDto } from "../shared/SuccessResponseDto";

export interface ResetPasswordResponseDto extends SuccessResponseDto {
  bool: boolean;
}
