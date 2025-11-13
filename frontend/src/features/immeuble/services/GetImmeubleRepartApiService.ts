import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ShowRepartReleveRequestDto } from "@/src/features/logement/types/request/ShowRepartReleveRequestDto";

export class GetImmeubleRepartApiService extends BaseApiService {
  async getImmeubleRepart(
    data: ShowRepartReleveRequestDto
  ): Promise<ApiResponse<any>> {
    return this.apiCall<any>(
      `/api/immeuble/${data.pkImmeuble}/repart`,
      {
        method: "GET",
      }
    );
  }
}

export const getImmeubleRepartApiService = new GetImmeubleRepartApiService();

