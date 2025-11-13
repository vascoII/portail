import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GetByIdIntRequestDto } from "@/src/shared/types/request/GetByIdIntRequestDto";

export class GetOperatorStatApiService extends BaseApiService {
  async getOperatorStat(
    data: GetByIdIntRequestDto
  ): Promise<ApiResponse<any>> {
    return this.apiCall<any>(
      `/api/operator/${data.id}/stat`,
      {
        method: "GET",
      }
    );
  }
}

export const getOperatorStatApiService = new GetOperatorStatApiService();

