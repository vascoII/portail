import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GetTicketsIntersUserRequestDto } from "@/types/api/request/Ticket/GetTicketsIntersUserRequestDto";
import type { PaginatedResponse } from "@/types/api";

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

