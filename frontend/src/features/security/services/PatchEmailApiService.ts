import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { PatchEmailRequestDto } from "@/src/features/security/types/request/PatchEmailRequestDto";
import type { SuccessResponseDto } from "@/src/shared/types/response/SuccessResponseDto";

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

