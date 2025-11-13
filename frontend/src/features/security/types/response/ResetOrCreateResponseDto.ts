/**
 * DTO for reset or create password output
 * Corresponds to: App\Application\Dto\Output\Security\ResetOrCreateOutputDto
 * Extends SuccessOutputDto
 */
import type { SuccessResponseDto } from "@/src/shared/types/response/SuccessResponseDto";

export interface ResetOrCreateResponseDto extends SuccessResponseDto {
  bool: boolean;
}
