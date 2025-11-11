/**
 * DTO for list of alertes (alerts)
 * Corresponds to: App\Application\Dto\Output\Shared\ListAlertesOuputDto
 */
export interface ListAlertesResponseDto {
  alertes: unknown[]; // Array of Alerte entities (type to be defined based on actual usage)
}

