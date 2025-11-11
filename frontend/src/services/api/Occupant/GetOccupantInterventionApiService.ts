import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { ShowInterventionRequestDto } from "@/types/api/request/Occupant/ShowInterventionRequestDto";
import type { ListInterventionsResponseDto } from "@/types/api/response/shared/ListInterventionsResponseDto";

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

