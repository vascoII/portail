import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { UpdatePasswordRequestDto } from "@/src/features/security/types/request/UpdatePasswordRequestDto";
import type { UpdatePasswordResponseDto } from "@/src/features/security/types/response/UpdatePasswordResponseDto";

export class UpdatePasswordApiService extends BaseApiService {
  async updatePassword(
    data: UpdatePasswordRequestDto
  ): Promise<ApiResponse<UpdatePasswordResponseDto>> {
    return this.apiCall<UpdatePasswordResponseDto>(
      `/api/security/update-password`,
      {
        method: "PUT",
        body: JSON.stringify(data),
      }
    );
  }
}

export const updatePasswordApiService = new UpdatePasswordApiService();

