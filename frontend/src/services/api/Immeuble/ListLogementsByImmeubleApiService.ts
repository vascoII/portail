import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GetInfosLogementsByImmeubleRequestDto } from "@/types/api/request/Immeuble/GetInfosLogementsByImmeubleRequestDto";
import type { ListLogementsResponseDto } from "@/types/api/response/immeuble/ListLogementsResponseDto";

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

