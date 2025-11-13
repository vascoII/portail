import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ShowRequestDto } from "@/src/features/occupant/types/request/ShowRequestDto";
import type { ListAlertesResponseDto } from "@/src/shared/types/response/ListAlertesResponseDto";

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

