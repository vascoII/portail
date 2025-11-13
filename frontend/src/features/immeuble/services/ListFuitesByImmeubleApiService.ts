import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GetInfosFuitesByImmeubleRequestDto } from "@/src/features/immeuble/types/request/GetInfosFuitesByImmeubleRequestDto";
import type { ListFuitesResponseDto } from "@/src/shared/types/response/ListFuitesResponseDto";

export class ListFuitesByImmeubleApiService extends BaseApiService {
  async listFuitesByImmeuble(
    data: GetInfosFuitesByImmeubleRequestDto
  ): Promise<ApiResponse<ListFuitesResponseDto>> {
    return this.apiCall<ListFuitesResponseDto>(
      `/api/immeuble/${data.pkImmeuble}/fuites`,
      {
        method: "GET",
      }
    );
  }
}

export const listFuitesByImmeubleApiService = new ListFuitesByImmeubleApiService();

