/**
 * DTO for update password output
 * Corresponds to: App\Application\Dto\Output\Security\UpdatePasswordOutputDto
 * Extends SuccessOutputDto
 */
import type { SuccessResponseDto } from "@/src/shared/types/response/SuccessResponseDto";

export interface UpdatePasswordResponseDto extends SuccessResponseDto {
  bool: boolean;
}
