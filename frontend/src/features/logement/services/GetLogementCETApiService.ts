import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ShowRequestDto } from "@/src/features/logement/types/request/ShowRequestDto";

export class GetLogementCETApiService extends BaseApiService {
  async getLogementCET(
    data: ShowRequestDto
  ): Promise<ApiResponse<any>> {
    return this.apiCall<any>(
      `/api/logement/${data.pkLogement}/cet`,
      {
        method: "GET",
      }
    );
  }
}

export const getLogementCETApiService = new GetLogementCETApiService();

