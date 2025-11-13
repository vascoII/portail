import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { UpdateCGUFromPKUserRequestDto } from "@/src/features/security/types/request/UpdateCGUFromPKUserRequestDto";
import type { SuccessResponseDto } from "@/src/shared/types/response/SuccessResponseDto";

export class PatchCguApiService extends BaseApiService {
  async patchCgu(
    data: UpdateCGUFromPKUserRequestDto
  ): Promise<ApiResponse<SuccessResponseDto>> {
    return this.apiCall<SuccessResponseDto>(
      `/api/security/patch-cgu`,
      {
        method: "PATCH",
        body: JSON.stringify(data),
      }
    );
  }
}

export const patchCguApiService = new PatchCguApiService();

