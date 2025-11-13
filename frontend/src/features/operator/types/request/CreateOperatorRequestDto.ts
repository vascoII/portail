/**
 * Request DTO for creating operator
 * Corresponds to: App\Application\Dto\Input\Operator\CreateOperatorInputDto
 */
export interface CreateOperatorRequestDto {
  email: string;
  lastname: string;
  firstname: string;
  phone: string;
  job: string;
}
