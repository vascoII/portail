import { BaseExternalApiService } from "@/src/shared/services/BaseExternalApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ResetPasswordRequestDto } from "@/src/features/security/types/request/ResetPasswordRequestDto";
import type { ResetPasswordResponseDto } from "@/src/features/security/types/response/ResetPasswordResponseDto";

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

