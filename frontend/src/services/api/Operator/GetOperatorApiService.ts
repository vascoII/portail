import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GetByIdIntRequestDto } from "@/types/api/request/Shared/GetByIdIntRequestDto";
import type { GetOperatorResponseDto } from "@/types/api/response/operator/GetOperatorResponseDto";

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

