import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { PutOperatorRequestDto } from "@/src/features/operator/types/request/PutOperatorRequestDto";
import type { UpdateUserResponseDto } from "@/src/features/operator/types/response/UpdateUserResponseDto";

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

