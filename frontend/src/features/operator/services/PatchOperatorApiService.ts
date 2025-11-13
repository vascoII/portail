import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { PatchOperatorRequestDto } from "@/src/features/operator/types/request/PatchOperatorRequestDto";
import type { UpdateUserResponseDto } from "@/src/features/operator/types/response/UpdateUserResponseDto";

export class PatchOperatorApiService extends BaseApiService {
  async patchOperator(
    data: PatchOperatorRequestDto
  ): Promise<ApiResponse<UpdateUserResponseDto>> {
    return this.apiCall<UpdateUserResponseDto>(
      `/api/operator/${data.pkOperator}`,
      {
        method: "PATCH",
        body: JSON.stringify(data),
      }
    );
  }
}

export const patchOperatorApiService = new PatchOperatorApiService();

