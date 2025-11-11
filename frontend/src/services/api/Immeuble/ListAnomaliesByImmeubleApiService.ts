import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GetInfosAnomaliesByImmeubleRequestDto } from "@/types/api/request/Immeuble/GetInfosAnomaliesByImmeubleRequestDto";
import type { ListAnomaliesResponseDto } from "@/types/api/response/shared/ListAnomaliesResponseDto";

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

