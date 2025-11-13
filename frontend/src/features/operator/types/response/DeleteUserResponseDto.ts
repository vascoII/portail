/**
 * DTO for deleting a user
 * Corresponds to: App\Application\Dto\Output\Operator\DeleteUserOutputDto
 */
import type { RetourResponseDto } from "@/src/shared/types/response/RetourResponseDto";

export interface DeleteUserResponseDto {
  retour: RetourResponseDto;
}
