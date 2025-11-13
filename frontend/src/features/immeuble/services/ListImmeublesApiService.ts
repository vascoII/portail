import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { IndexRequestDto } from "@/src/features/immeuble/types/request/IndexRequestDto";
import type { ListImmeublesResponseDto } from "@/src/features/immeuble/types/response/ListImmeublesResponseDto";

export class ListImmeublesApiService extends BaseApiService {
  async listImmeubles(
    data?: IndexRequestDto
  ): Promise<ApiResponse<ListImmeublesResponseDto>> {
    const params = new URLSearchParams();
    if (data) {
      Object.entries(data).forEach(([key, value]) => {
        if (value !== undefined && value !== null) {
          params.append(key, value.toString());
        }
      });
    }
    const queryString = params.toString();
    return this.apiCall<ListImmeublesResponseDto>(
      `/api/immeuble${queryString ? `?${queryString}` : ""}`,
      {
        method: "GET",
      }
    );
  }
}

export const listImmeublesApiService = new ListImmeublesApiService();
