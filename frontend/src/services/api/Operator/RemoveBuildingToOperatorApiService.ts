import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { PatchOperatorImmeubleRequestDto } from "@/types/api/request/Operator/PatchOperatorImmeubleRequestDto";
import type { SuccessResponseDto } from "@/types/api/response/shared/SuccessResponseDto";

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

