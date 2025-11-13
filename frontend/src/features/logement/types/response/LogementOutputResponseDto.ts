/**
 * DTO for logement output
 * Corresponds to: App\Application\Dto\Output\Logement\LogementOutputResponseDto
 * Note: This DTO contains an array of Logement entities
 */
import type { LogementResponseDto } from './LogementResponseDto';

export interface LogementOutputResponseDto {
  logementDto: LogementResponseDto[];
}

