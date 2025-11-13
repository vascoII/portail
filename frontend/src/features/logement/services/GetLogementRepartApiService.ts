import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ShowRepartReleveRequestDto } from "@/src/features/logement/types/request/ShowRepartReleveRequestDto";

export class GetLogementRepartApiService extends BaseApiService {
  async getLogementRepart(
    data: ShowRepartReleveRequestDto
  ): Promise<ApiResponse<any>> {
    return this.apiCall<any>(
      `/api/logement/${data.pkLogement}/repart`,
      {
        method: "GET",
      }
    );
  }
}

export const getLogementRepartApiService = new GetLogementRepartApiService();

