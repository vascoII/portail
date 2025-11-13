/**
 * Request DTO for LoginFromParamRequestDto
 * Corresponds to: App\Application\Dto\Input\Security\LoginFromParamInputDto
 */
export interface LoginFromParamRequestDto {
  username?: string | null;
  password?: string | null;
  param?: string | null;
}
