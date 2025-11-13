/**
 * DTO for logout output
 * Corresponds to: App\Application\Dto\Output\Security\LogoutOutputDto
 * Extends SuccessOutputDto
 */
import type { SuccessResponseDto } from "@/src/shared/types/response/SuccessResponseDto";

export interface LogoutResponseDto extends SuccessResponseDto {
  bool: boolean;
}
