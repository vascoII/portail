import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ShowInterventionRequestDto } from "@/src/features/logement/types/request/ShowInterventionRequestDto";
import type { ListInterventionsResponseDto } from "@/src/shared/types/response/ListInterventionsResponseDto";

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

