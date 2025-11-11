import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GetByIdIntRequestDto } from "@/types/api/request/Shared/GetByIdIntRequestDto";
import type { DeleteUserResponseDto } from "@/types/api/response/operator/DeleteUserResponseDto";

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

