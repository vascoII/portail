import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { LeaksRequestDto } from "@/src/features/logement/types/request/LeaksRequestDto";
import type { ListFuitesResponseDto } from "@/src/shared/types/response/ListFuitesResponseDto";

export class ListFuitesByLogementApiService extends BaseApiService {
  async listFuitesByLogement(
    data: LeaksRequestDto
  ): Promise<ApiResponse<ListFuitesResponseDto>> {
    return this.apiCall<ListFuitesResponseDto>(
      `/api/logement/${data.pkLogement}/fuites`,
      {
        method: "GET",
      }
    );
  }
}

export const listFuitesByLogementApiService = new ListFuitesByLogementApiService();

