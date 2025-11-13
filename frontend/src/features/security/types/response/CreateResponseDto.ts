/**
 * DTO for create user output
 * Corresponds to: App\Application\Dto\Output\Security\CreateOutputDto
 * Extends SuccessOutputDto
 */
import type { SuccessResponseDto } from "@/src/shared/types/response/SuccessResponseDto";

export interface CreateResponseDto extends SuccessResponseDto {
  bool: boolean;
}
