import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { AnomaliesRequestDto } from "@/src/features/occupant/types/request/AnomaliesRequestDto";
import type { ListAnomaliesResponseDto } from "@/src/shared/types/response/ListAnomaliesResponseDto";

export class ListAnomaliesByOccupantApiService extends BaseApiService {
  async listAnomaliesByOccupant(
    data: AnomaliesRequestDto
  ): Promise<ApiResponse<ListAnomaliesResponseDto>> {
    return this.apiCall<ListAnomaliesResponseDto>(
      `/api/occupant/${data.pkOccupant}/anomalies`,
      {
        method: "GET",
      }
    );
  }
}

export const listAnomaliesByOccupantApiService = new ListAnomaliesByOccupantApiService();

