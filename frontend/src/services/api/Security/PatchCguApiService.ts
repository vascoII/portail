import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { UpdateCGUFromPKUserRequestDto } from "@/types/api/request/Security/UpdateCGUFromPKUserRequestDto";
import type { SuccessResponseDto } from "@/types/api/response/shared/SuccessResponseDto";

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

