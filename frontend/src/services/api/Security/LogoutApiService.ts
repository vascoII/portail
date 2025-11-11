import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { LogoutRequestDto } from "@/types/api/request/Security/LogoutRequestDto";
import type { LogoutResponseDto } from "@/types/api/response/security/LogoutResponseDto";

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

