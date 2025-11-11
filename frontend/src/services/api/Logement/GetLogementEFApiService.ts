import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { ShowRequestDto } from "@/types/api/request/Logement/ShowRequestDto";

export class GetLogementEFApiService extends BaseApiService {
  async getLogementEF(
    data: ShowRequestDto
  ): Promise<ApiResponse<any>> {
    return this.apiCall<any>(
      `/api/logement/${data.pkLogement}/ef`,
      {
        method: "GET",
      }
    );
  }
}

export const getLogementEFApiService = new GetLogementEFApiService();

