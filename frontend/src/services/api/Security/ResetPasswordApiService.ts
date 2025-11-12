import { BaseExternalApiService } from "../BaseExternalApiService";
import type { ApiResponse } from "@/types/api";
import type { ResetPasswordRequestDto } from "@/types/api/request/Security/ResetPasswordRequestDto";
import type { ResetPasswordResponseDto } from "@/types/api/response/security/ResetPasswordResponseDto";

export class ResetPasswordApiService extends BaseExternalApiService {
  async resetPassword(
    data: ResetPasswordRequestDto
  ): Promise<ApiResponse<ResetPasswordResponseDto>> {
    return this.apiCall<ResetPasswordResponseDto>(
      `/api/security/reset-password`,
      {
        method: "POST",
        body: JSON.stringify(data),
      }
    );
  }
}

export const resetPasswordApiService = new ResetPasswordApiService();

