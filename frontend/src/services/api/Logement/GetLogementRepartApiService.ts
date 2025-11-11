import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { ShowRepartReleveRequestDto } from "@/types/api/request/Logement/ShowRepartReleveRequestDto";

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

