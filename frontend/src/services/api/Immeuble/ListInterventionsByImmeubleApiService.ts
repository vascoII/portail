import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { ShowInterventionRequestDto } from "@/types/api/request/Immeuble/ShowInterventionRequestDto";
import type { ListInterventionsResponseDto } from "@/types/api/response/shared/ListInterventionsResponseDto";

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

