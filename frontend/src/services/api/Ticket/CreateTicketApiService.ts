import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { CreateTicketInterRequestDto } from "@/types/api/request/Ticket/CreateTicketInterRequestDto";
import type { SuccessResponseDto } from "@/types/api/response/shared/SuccessResponseDto";

export class CreateTicketApiService extends BaseApiService {
  async createTicket(
    data: CreateTicketInterRequestDto
  ): Promise<ApiResponse<SuccessResponseDto>> {
    return this.apiCall<SuccessResponseDto>(
      `/api/ticket`,
      {
        method: "POST",
        body: JSON.stringify(data),
      }
    );
  }
}

export const createTicketApiService = new CreateTicketApiService();

