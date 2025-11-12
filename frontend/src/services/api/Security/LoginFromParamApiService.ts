import { BaseExternalApiService } from "../BaseExternalApiService";
import type { ApiResponse } from "@/types/api";
import type { LoginFromParamRequestDto } from "@/types/api/request/Security/LoginFromParamRequestDto";
import type { LoginResponseDto } from "@/types/api/response/security/LoginResponseDto";

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

