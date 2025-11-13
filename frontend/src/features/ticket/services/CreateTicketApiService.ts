import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { CreateTicketInterRequestDto } from "@/src/features/ticket/types/request/CreateTicketInterRequestDto";
import type { SuccessResponseDto } from "@/src/shared/types/response/SuccessResponseDto";

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

