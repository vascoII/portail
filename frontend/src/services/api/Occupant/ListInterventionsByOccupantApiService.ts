import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { InterventionsRequestDto } from "@/types/api/request/Occupant/InterventionsRequestDto";
import type { ListInterventionsResponseDto } from "@/types/api/response/shared/ListInterventionsResponseDto";

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

