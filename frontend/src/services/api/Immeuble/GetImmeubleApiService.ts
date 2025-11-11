import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { ShowRequestDto } from "@/types/api/request/Immeuble/ShowRequestDto";
import type { GetImmeubleResponseDto } from "@/types/api/response/immeuble/GetImmeubleResponseDto";

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
