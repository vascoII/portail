/**
 * DTO for list of dysfonctionnements (malfunctions)
 * Corresponds to: App\Application\Dto\Output\Shared\ListDysfonctionnementsOuputDto
 */
export interface ListDysfonctionnementsResponseDto {
  dysfonctionnements: unknown[]; // Array of Dysfonctionnement entities (type to be defined based on actual usage)
}

