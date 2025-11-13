import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ShowInterventionRequestDto } from "@/src/features/immeuble/types/request/ShowInterventionRequestDto";
import type { ListInterventionsResponseDto } from "@/src/shared/types/response/ListInterventionsResponseDto";

export class ListInterventionsByImmeubleApiService extends BaseApiService {
  async listInterventionsByImmeuble(
    data: ShowInterventionRequestDto
  ): Promise<ApiResponse<ListInterventionsResponseDto>> {
    return this.apiCall<ListInterventionsResponseDto>(
      `/api/immeuble/${data.pkImmeuble}/interventions`,
      {
        method: "GET",
      }
    );
  }
}

export const listInterventionsByImmeubleApiService = new ListInterventionsByImmeubleApiService();

