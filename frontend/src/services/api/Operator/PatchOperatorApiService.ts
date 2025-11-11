import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { PatchOperatorRequestDto } from "@/types/api/request/Operator/PatchOperatorRequestDto";
import type { UpdateUserResponseDto } from "@/types/api/response/operator/UpdateUserResponseDto";

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

