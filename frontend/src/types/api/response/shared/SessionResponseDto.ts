/**
 * DTO for session output
 * Corresponds to: App\Application\Dto\Output\Shared\SessionResponseDto
 */
import type { SessionEntityResponseDto } from './SessionEntityResponseDto';

export interface SessionResponseDto {
  session: SessionEntityResponseDto;
}

