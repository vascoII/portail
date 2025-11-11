import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { PutOperatorRequestDto } from "@/types/api/request/Operator/PutOperatorRequestDto";
import type { UpdateUserResponseDto } from "@/types/api/response/operator/UpdateUserResponseDto";

export class PutOperatorApiService extends BaseApiService {
  async putOperator(
    data: PutOperatorRequestDto
  ): Promise<ApiResponse<UpdateUserResponseDto>> {
    return this.apiCall<UpdateUserResponseDto>(
      `/api/operator/${data.pkOperator}`,
      {
        method: "PUT",
        body: JSON.stringify(data),
      }
    );
  }
}

export const putOperatorApiService = new PutOperatorApiService();

