import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ListOperatorsRequestDto } from "@/src/features/operator/types/request/ListOperatorsRequestDto";
import type { ListOperatorsResponseDto } from "@/src/features/operator/types/response/ListOperatorsResponseDto";

export class ListOperatorsApiService extends BaseApiService {
  async listOperators(
    data?: ListOperatorsRequestDto
  ): Promise<ApiResponse<ListOperatorsResponseDto>> {
    const params = new URLSearchParams();
    if (data) {
      Object.entries(data).forEach(([key, value]) => {
        if (value !== undefined && value !== null) {
          params.append(key, value.toString());
        }
      });
    }
    const queryString = params.toString();
    return this.apiCall<ListOperatorsResponseDto>(
      `/api/operator${queryString ? `?${queryString}` : ""}`,
      {
        method: "GET",
      }
    );
  }
}

export const listOperatorsApiService = new ListOperatorsApiService();

