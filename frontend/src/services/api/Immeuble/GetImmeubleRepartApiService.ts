import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { ShowRepartReleveRequestDto } from "@/types/api/request/Logement/ShowRepartReleveRequestDto";

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

