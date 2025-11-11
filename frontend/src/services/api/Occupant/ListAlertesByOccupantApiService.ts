import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { ShowRequestDto } from "@/types/api/request/Occupant/ShowRequestDto";
import type { ListAlertesResponseDto } from "@/types/api/response/shared/ListAlertesResponseDto";

export class ListAlertesByOccupantApiService extends BaseApiService {
  async listAlertesByOccupant(
    data: ShowRequestDto
  ): Promise<ApiResponse<ListAlertesResponseDto>> {
    return this.apiCall<ListAlertesResponseDto>(
      `/api/occupant/${data.pkOccupant}/alertes`,
      {
        method: "GET",
      }
    );
  }
}

export const listAlertesByOccupantApiService = new ListAlertesByOccupantApiService();

