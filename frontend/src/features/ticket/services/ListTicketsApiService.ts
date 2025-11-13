import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GetTicketsIntersUserRequestDto } from "@/src/features/ticket/types/request/GetTicketsIntersUserRequestDto";
import type { PaginatedResponse } from "@/src/shared/types/api";

export class ListTicketsApiService extends BaseApiService {
  async listTickets(
    data: GetTicketsIntersUserRequestDto
  ): Promise<ApiResponse<PaginatedResponse<any>>> {
    const params = new URLSearchParams({ paramsFiltres: data.paramsFiltres });
    return this.apiCall<PaginatedResponse<any>>(
      `/api/ticket?${params.toString()}`,
      {
        method: "GET",
      }
    );
  }
}

export const listTicketsApiService = new ListTicketsApiService();

