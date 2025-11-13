import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ListFacturesResponseDto } from "@/src/features/facture/types/response/ListFacturesResponseDto";

export class ListFacturesApiService extends BaseApiService {
  async listFactures(
    params?: Record<string, string | number>
  ): Promise<ApiResponse<ListFacturesResponseDto>> {
    const queryParams = new URLSearchParams();
    if (params) {
      Object.entries(params).forEach(([key, value]) => {
        queryParams.append(key, value.toString());
      });
    }
    const queryString = queryParams.toString();
    return this.apiCall<ListFacturesResponseDto>(
      `/api/facture${queryString ? `?${queryString}` : ""}`,
      {
        method: "GET",
      }
    );
  }
}

export const listFacturesApiService = new ListFacturesApiService();
