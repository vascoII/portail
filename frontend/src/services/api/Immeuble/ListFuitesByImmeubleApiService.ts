import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GetInfosFuitesByImmeubleRequestDto } from "@/types/api/request/Immeuble/GetInfosFuitesByImmeubleRequestDto";
import type { ListFuitesResponseDto } from "@/types/api/response/shared/ListFuitesResponseDto";

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

