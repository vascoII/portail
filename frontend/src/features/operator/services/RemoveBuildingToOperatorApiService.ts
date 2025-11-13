import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { PatchOperatorImmeubleRequestDto } from "@/src/features/operator/types/request/PatchOperatorImmeubleRequestDto";
import type { SuccessResponseDto } from "@/src/shared/types/response/SuccessResponseDto";

export class RemoveBuildingToOperatorApiService extends BaseApiService {
  async removeBuildingToOperator(
    data: PatchOperatorImmeubleRequestDto
  ): Promise<ApiResponse<SuccessResponseDto>> {
    return this.apiCall<SuccessResponseDto>(
      `/api/operator/${data.pkOperator}/immeubles/${data.pkImmeuble}`,
      {
        method: "DELETE",
      }
    );
  }
}

export const removeBuildingToOperatorApiService = new RemoveBuildingToOperatorApiService();

