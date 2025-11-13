import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GetInfosLogementsByImmeubleRequestDto } from "@/src/features/immeuble/types/request/GetInfosLogementsByImmeubleRequestDto";
import type { ListLogementsResponseDto } from "@/src/features/immeuble/types/response/ListLogementsResponseDto";

export class ListLogementsByImmeubleApiService extends BaseApiService {
  async listLogementsByImmeuble(
    data: GetInfosLogementsByImmeubleRequestDto
  ): Promise<ApiResponse<ListLogementsResponseDto>> {
    return this.apiCall<ListLogementsResponseDto>(
      `/api/immeuble/${data.pkImmeuble}/logements`,
      {
        method: "GET",
      }
    );
  }
}

export const listLogementsByImmeubleApiService = new ListLogementsByImmeubleApiService();

