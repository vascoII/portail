import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { CreateOperatorRequestDto } from "@/types/api/request/Operator/CreateOperatorRequestDto";
import type { CreateGestionnaireResponseDto } from "@/types/api/response/operator/CreateGestionnaireResponseDto";

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

