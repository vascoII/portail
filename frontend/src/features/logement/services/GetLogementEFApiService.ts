import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ShowRequestDto } from "@/src/features/logement/types/request/ShowRequestDto";

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

