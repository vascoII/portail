import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GetByIdIntRequestDto } from "@/types/api/request/Shared/GetByIdIntRequestDto";

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

