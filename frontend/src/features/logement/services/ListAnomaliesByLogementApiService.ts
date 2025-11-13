import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { AnomaliesRequestDto } from "@/src/features/logement/types/request/AnomaliesRequestDto";
import type { ListAnomaliesResponseDto } from "@/src/shared/types/response/ListAnomaliesResponseDto";

export class ListAnomaliesByLogementApiService extends BaseApiService {
  async listAnomaliesByLogement(
    data: AnomaliesRequestDto
  ): Promise<ApiResponse<ListAnomaliesResponseDto>> {
    return this.apiCall<ListAnomaliesResponseDto>(
      `/api/logement/${data.pkLogement}/anomalies`,
      {
        method: "GET",
      }
    );
  }
}

export const listAnomaliesByLogementApiService = new ListAnomaliesByLogementApiService();

