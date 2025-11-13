import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GetInfosAnomaliesByImmeubleRequestDto } from "@/src/features/immeuble/types/request/GetInfosAnomaliesByImmeubleRequestDto";
import type { ListAnomaliesResponseDto } from "@/src/shared/types/response/ListAnomaliesResponseDto";

export class ListAnomaliesByImmeubleApiService extends BaseApiService {
  async listAnomaliesByImmeuble(
    data: GetInfosAnomaliesByImmeubleRequestDto
  ): Promise<ApiResponse<ListAnomaliesResponseDto>> {
    return this.apiCall<ListAnomaliesResponseDto>(
      `/api/immeuble/${data.pkImmeuble}/anomalies`,
      {
        method: "GET",
      }
    );
  }
}

export const listAnomaliesByImmeubleApiService = new ListAnomaliesByImmeubleApiService();

