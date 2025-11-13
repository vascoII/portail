import { BaseExternalApiService } from "@/src/shared/services/BaseExternalApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { LoginRequestDto } from "@/src/features/security/types/request/LoginRequestDto";
import type { LoginResponseDto } from "@/src/features/security/types/response/LoginResponseDto";

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

