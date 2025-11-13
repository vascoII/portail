/**
 * DTO for list of invoices/factures
 * Corresponds to: App\Application\Dto\Output\Facture\ListFacturesOutputDto
 */
import type { FactureResponseDto } from './FactureResponseDto';

export interface ListFacturesResponseDto {
  factures: FactureResponseDto[];
}

