import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { AnomaliesRequestDto } from "@/types/api/request/Occupant/AnomaliesRequestDto";
import type { ListAnomaliesResponseDto } from "@/types/api/response/shared/ListAnomaliesResponseDto";

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

