/**
 * DTO for reset password from PK user output
 * Corresponds to: App\Application\Dto\Output\Security\ResetPasswordFromPKUserOutputDto
 */
import type { UserEntityResponseDto } from "@/src/shared/types/response/UserEntityResponseDto";

export interface ResetPasswordFromPKUserResponseDto {
  user: UserEntityResponseDto;
}
