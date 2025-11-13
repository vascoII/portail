import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { InterventionsRequestDto } from "@/src/features/occupant/types/request/InterventionsRequestDto";
import type { ListInterventionsResponseDto } from "@/src/shared/types/response/ListInterventionsResponseDto";

export class ListInterventionsByOccupantApiService extends BaseApiService {
  async listInterventionsByOccupant(
    data: InterventionsRequestDto
  ): Promise<ApiResponse<ListInterventionsResponseDto>> {
    return this.apiCall<ListInterventionsResponseDto>(
      `/api/occupant/${data.pkOccupant}/interventions`,
      {
        method: "GET",
      }
    );
  }
}

export const listInterventionsByOccupantApiService = new ListInterventionsByOccupantApiService();

