/**
 * DTO for list of operators
 * Corresponds to: App\Application\Dto\Output\Operator\ListOperatorsOutputDto
 */
import type { UserResponseDto } from "../shared/UserResponseDto";

export interface ListOperatorsResponseDto {
  userDto: UserResponseDto[];
}
