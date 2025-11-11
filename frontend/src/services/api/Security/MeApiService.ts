import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { UserResponseDto } from "@/types/api/response/shared/UserResponseDto";

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

