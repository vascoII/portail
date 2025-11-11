import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { ShowInterventionRequestDto } from "@/types/api/request/Logement/ShowInterventionRequestDto";
import type { ListInterventionsResponseDto } from "@/types/api/response/shared/ListInterventionsResponseDto";

export class ListInterventionsByLogementApiService extends BaseApiService {
  async listInterventionsByLogement(
    data: ShowInterventionRequestDto
  ): Promise<ApiResponse<ListInterventionsResponseDto>> {
    return this.apiCall<ListInterventionsResponseDto>(
      `/api/logement/${data.pkLogement}/interventions`,
      {
        method: "GET",
      }
    );
  }
}

export const listInterventionsByLogementApiService = new ListInterventionsByLogementApiService();

