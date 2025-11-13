import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ShowRequestDto } from "@/src/features/immeuble/types/request/ShowRequestDto";

export class GetImmeubleECApiService extends BaseApiService {
  async getImmeubleEC(
    data: ShowRequestDto
  ): Promise<ApiResponse<any>> {
    return this.apiCall<any>(
      `/api/immeuble/${data.pkImmeuble}/ec`,
      {
        method: "GET",
      }
    );
  }
}

export const getImmeubleECApiService = new GetImmeubleECApiService();

