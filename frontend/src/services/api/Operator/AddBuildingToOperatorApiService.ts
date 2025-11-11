import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { CreateOperationImmeubleRequestDto } from "@/types/api/request/Operator/CreateOperationImmeubleRequestDto";
import type { SuccessResponseDto } from "@/types/api/response/shared/SuccessResponseDto";

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
