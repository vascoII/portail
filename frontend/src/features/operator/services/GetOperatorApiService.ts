import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GetByIdIntRequestDto } from "@/src/shared/types/request/GetByIdIntRequestDto";
import type { GetOperatorResponseDto } from "@/src/features/operator/types/response/GetOperatorResponseDto";

export class GetOperatorApiService extends BaseApiService {
  async getOperator(
    data: GetByIdIntRequestDto
  ): Promise<ApiResponse<GetOperatorResponseDto>> {
    return this.apiCall<GetOperatorResponseDto>(
      `/api/operator/${data.id}`,
      {
        method: "GET",
      }
    );
  }
}

export const getOperatorApiService = new GetOperatorApiService();

