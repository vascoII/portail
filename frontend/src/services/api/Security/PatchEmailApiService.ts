import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { PatchEmailRequestDto } from "@/types/api/request/Security/PatchEmailRequestDto";
import type { SuccessResponseDto } from "@/types/api/response/shared/SuccessResponseDto";

export class PatchEmailApiService extends BaseApiService {
  async patchEmail(
    data: PatchEmailRequestDto
  ): Promise<ApiResponse<SuccessResponseDto>> {
    return this.apiCall<SuccessResponseDto>(
      `/api/security/patch-email`,
      {
        method: "PATCH",
        body: JSON.stringify(data),
      }
    );
  }
}

export const patchEmailApiService = new PatchEmailApiService();

