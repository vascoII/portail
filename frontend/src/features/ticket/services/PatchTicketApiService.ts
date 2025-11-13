import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { SetTicketStatusRequestDto } from "@/src/features/ticket/types/request/SetTicketStatusRequestDto";
import type { SuccessResponseDto } from "@/src/shared/types/response/SuccessResponseDto";

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

