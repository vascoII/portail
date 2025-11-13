/**
 * Request DTO for CreateTicketInterRequestDto
 * Corresponds to: App\Application\Dto\Input\Ticket\CreateTicketInterInputDto
 */
export interface CreateTicketInterRequestDto {
  pkLogement: number;
  name: string;
  email: string;
  phone: string;
  mobile: string;
  objet: string;
  message: string;
  attachmentName: string;
  attachmentContent: string;
}
