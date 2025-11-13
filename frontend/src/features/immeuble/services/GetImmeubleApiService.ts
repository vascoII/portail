import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ShowRequestDto } from "@/src/features/immeuble/types/request/ShowRequestDto";
import type { GetImmeubleResponseDto } from "@/src/features/immeuble/types/response/GetImmeubleResponseDto";

export class GetImmeubleApiService extends BaseApiService {
  async getImmeuble(
    data: ShowRequestDto
  ): Promise<ApiResponse<GetImmeubleResponseDto>> {
    return this.apiCall<GetImmeubleResponseDto>(
      `/api/immeuble/${data.pkImmeuble}`,
      {
        method: "GET",
      }
    );
  }
}

export const getImmeubleApiService = new GetImmeubleApiService();
