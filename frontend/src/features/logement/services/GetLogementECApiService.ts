import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ShowRequestDto } from "@/src/features/logement/types/request/ShowRequestDto";

export class GetLogementECApiService extends BaseApiService {
  async getLogementEC(
    data: ShowRequestDto
  ): Promise<ApiResponse<any>> {
    return this.apiCall<any>(
      `/api/logement/${data.pkLogement}/ec`,
      {
        method: "GET",
      }
    );
  }
}

export const getLogementECApiService = new GetLogementECApiService();

