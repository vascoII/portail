import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ShowInterventionRequestDto } from "@/src/features/occupant/types/request/ShowInterventionRequestDto";
import type { ListInterventionsResponseDto } from "@/src/shared/types/response/ListInterventionsResponseDto";

export class GetOccupantInterventionApiService extends BaseApiService {
  async getOccupantIntervention(
    data: ShowInterventionRequestDto
  ): Promise<ApiResponse<ListInterventionsResponseDto>> {
    return this.apiCall<ListInterventionsResponseDto>(
      `/api/occupant/${data.pkOccupant}/interventions`,
      {
        method: "GET",
      }
    );
  }
}

export const getOccupantInterventionApiService = new GetOccupantInterventionApiService();

