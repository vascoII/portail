import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { CreateOperatorRequestDto } from "@/src/features/operator/types/request/CreateOperatorRequestDto";
import type { CreateGestionnaireResponseDto } from "@/src/features/operator/types/response/CreateGestionnaireResponseDto";

export class CreateOperatorApiService extends BaseApiService {
  async createOperator(
    data: CreateOperatorRequestDto
  ): Promise<ApiResponse<CreateGestionnaireResponseDto>> {
    return this.apiCall<CreateGestionnaireResponseDto>(
      `/api/operator`,
      {
        method: "POST",
        body: JSON.stringify(data),
      }
    );
  }
}

export const createOperatorApiService = new CreateOperatorApiService();

