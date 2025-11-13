import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { LogoutRequestDto } from "@/src/features/security/types/request/LogoutRequestDto";
import type { LogoutResponseDto } from "@/src/features/security/types/response/LogoutResponseDto";

export class LogoutApiService extends BaseApiService {
  async logout(
    data: LogoutRequestDto
  ): Promise<ApiResponse<LogoutResponseDto>> {
    return this.apiCall<LogoutResponseDto>(
      `/api/security/logout`,
      {
        method: "POST",
        body: JSON.stringify(data),
      }
    );
  }
}

export const logoutApiService = new LogoutApiService();

