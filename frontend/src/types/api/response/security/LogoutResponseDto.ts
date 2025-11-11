/**
 * DTO for logout output
 * Corresponds to: App\Application\Dto\Output\Security\LogoutOutputDto
 * Extends SuccessOutputDto
 */
import type { SuccessResponseDto } from "../shared/SuccessResponseDto";

export interface LogoutResponseDto extends SuccessResponseDto {
  bool: boolean;
}
