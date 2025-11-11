import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { SetTicketStatusRequestDto } from "@/types/api/request/Ticket/SetTicketStatusRequestDto";
import type { SuccessResponseDto } from "@/types/api/response/shared/SuccessResponseDto";

export class PatchTicketApiService extends BaseApiService {
  async patchTicket(
    data: SetTicketStatusRequestDto
  ): Promise<ApiResponse<SuccessResponseDto>> {
    return this.apiCall<SuccessResponseDto>(
      `/api/ticket/${data.pkTicket}`,
      {
        method: "PATCH",
        body: JSON.stringify({ statut: data.statut }),
      }
    );
  }
}

export const patchTicketApiService = new PatchTicketApiService();

