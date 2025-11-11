import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { PaginatedResponse } from "@/types/api";
import type { DepannageResponseDto } from "@/types/api/response/shared/DepannageResponseDto";

export class ListWorkOrdersApiService extends BaseApiService {
  async listWorkOrders(
    params?: Record<string, string | number>
  ): Promise<ApiResponse<PaginatedResponse<DepannageResponseDto>>> {
    const queryParams = new URLSearchParams();
    if (params) {
      Object.entries(params).forEach(([key, value]) => {
        queryParams.append(key, value.toString());
      });
    }
    const queryString = queryParams.toString();
    return this.apiCall<PaginatedResponse<DepannageResponseDto>>(
      `/api/external/suivi/work-orders${queryString ? `?${queryString}` : ""}`,
      {
        method: "GET",
      }
    );
  }
}

export const listWorkOrdersApiService = new ListWorkOrdersApiService();

