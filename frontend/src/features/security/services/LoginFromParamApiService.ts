import { BaseExternalApiService } from "@/src/shared/services/BaseExternalApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { LoginFromParamRequestDto } from "@/src/features/security/types/request/LoginFromParamRequestDto";
import type { LoginResponseDto } from "@/src/features/security/types/response/LoginResponseDto";

export class LoginFromParamApiService extends BaseExternalApiService {
  async loginFromParam(
    data: LoginFromParamRequestDto
  ): Promise<ApiResponse<LoginResponseDto>> {
    const params = new URLSearchParams();
    if (data.param) {
      params.append("param", data.param);
    }
    return this.apiCall<LoginResponseDto>(
      `/api/security/login-from-param${params.toString() ? `?${params.toString()}` : ""}`,
      {
        method: "POST",
        body: JSON.stringify({ username: data.username, password: data.password }),
      }
    );
  }
}

export const loginFromParamApiService = new LoginFromParamApiService();

