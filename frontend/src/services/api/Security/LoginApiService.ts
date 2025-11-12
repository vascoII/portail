import { BaseExternalApiService } from "../BaseExternalApiService";
import type { ApiResponse } from "@/types/api";
import type { LoginRequestDto } from "@/types/api/request/Security/LoginRequestDto";
import type { LoginResponseDto } from "@/types/api/response/security/LoginResponseDto";

export class LoginApiService extends BaseExternalApiService {
  async login(
    data: LoginRequestDto
  ): Promise<ApiResponse<LoginResponseDto>> {
    return this.apiCall<LoginResponseDto>(
      `/api/security/login`,
      {
        method: "POST",
        body: JSON.stringify(data),
      }
    );
  }
}

export const loginApiService = new LoginApiService();

