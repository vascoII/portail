/**
 * DTO for Session entity (domain entity)
 * Corresponds to: App\Domain\Entity\Session
 */
import type { UserEntityResponseDto } from './UserEntityResponseDto';

export interface SessionEntityResponseDto {
  connected: boolean | null;
  sessionId: string | null;
  user: UserEntityResponseDto | null;
}

