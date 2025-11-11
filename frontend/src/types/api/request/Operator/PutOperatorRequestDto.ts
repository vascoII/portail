/**
 * Request DTO for putting operator
 * Corresponds to: App\Application\Dto\Input\Operator\PutOperatorInputDto
 */
export interface PutOperatorRequestDto {
  id: number;
  email: string;
  lastname: string;
  firstname: string;
  phone: string;
  job: string;
}
