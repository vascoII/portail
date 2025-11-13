import { BaseExternalApiService } from "@/src/shared/services/BaseExternalApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { PaginatedResponse } from "@/src/shared/types/api";
import type { DepannageResponseDto } from "@/src/shared/types/response/DepannageResponseDto";

export class ListWorkOrdersApiService extends BaseExternalApiService {
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

