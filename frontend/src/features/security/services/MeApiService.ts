import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { UserResponseDto } from "@/src/shared/types/response/UserResponseDto";

export class MeApiService extends BaseApiService {
  async me(): Promise<ApiResponse<UserResponseDto>> {
    return this.apiCall<UserResponseDto>(
      `/api/security/me`,
      {
        method: "GET",
      }
    );
  }
}

export const meApiService = new MeApiService();

