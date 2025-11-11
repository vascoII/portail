import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { UpdatePasswordRequestDto } from "@/types/api/request/Security/UpdatePasswordRequestDto";
import type { UpdatePasswordResponseDto } from "@/types/api/response/security/UpdatePasswordResponseDto";

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

