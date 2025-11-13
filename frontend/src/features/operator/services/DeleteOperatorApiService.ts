import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GetByIdIntRequestDto } from "@/src/shared/types/request/GetByIdIntRequestDto";
import type { DeleteUserResponseDto } from "@/src/features/operator/types/response/DeleteUserResponseDto";

export class DeleteOperatorApiService extends BaseApiService {
  async deleteOperator(
    data: GetByIdIntRequestDto
  ): Promise<ApiResponse<DeleteUserResponseDto>> {
    return this.apiCall<DeleteUserResponseDto>(
      `/api/operator/${data.id}`,
      {
        method: "DELETE",
      }
    );
  }
}

export const deleteOperatorApiService = new DeleteOperatorApiService();

