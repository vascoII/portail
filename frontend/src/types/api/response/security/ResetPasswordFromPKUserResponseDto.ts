/**
 * DTO for reset password from PK user output
 * Corresponds to: App\Application\Dto\Output\Security\ResetPasswordFromPKUserOutputDto
 */
import type { UserEntityResponseDto } from "../shared/UserEntityResponseDto";

export interface ResetPasswordFromPKUserResponseDto {
  user: UserEntityResponseDto;
}
