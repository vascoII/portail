import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { AnomaliesRequestDto } from "@/types/api/request/Logement/AnomaliesRequestDto";
import type { ListAnomaliesResponseDto } from "@/types/api/response/shared/ListAnomaliesResponseDto";

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

