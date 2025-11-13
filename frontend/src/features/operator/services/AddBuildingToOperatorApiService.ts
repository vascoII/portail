import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { CreateOperationImmeubleRequestDto } from "@/src/features/operator/types/request/CreateOperationImmeubleRequestDto";
import type { SuccessResponseDto } from "@/src/shared/types/response/SuccessResponseDto";

export class AddBuildingToOperatorApiService extends BaseApiService {
  async addBuildingToOperator(
    data: CreateOperationImmeubleRequestDto
  ): Promise<ApiResponse<SuccessResponseDto>> {
    return this.apiCall<SuccessResponseDto>(
      `/api/operator/${data.operatorId}/immeubles`,
      {
        method: "POST",
        body: JSON.stringify(data),
      }
    );
  }
}

export const addBuildingToOperatorApiService =
  new AddBuildingToOperatorApiService();
