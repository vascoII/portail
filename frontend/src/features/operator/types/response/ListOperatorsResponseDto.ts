/**
 * DTO for list of operators
 * Corresponds to: App\Application\Dto\Output\Operator\ListOperatorsOutputDto
 */
import type { UserResponseDto } from "@/src/shared/types/response/UserResponseDto";

export interface ListOperatorsResponseDto {
  userDto: UserResponseDto[];
}
