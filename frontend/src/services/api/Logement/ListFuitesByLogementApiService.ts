import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { LeaksRequestDto } from "@/types/api/request/Logement/LeaksRequestDto";
import type { ListFuitesResponseDto } from "@/types/api/response/shared/ListFuitesResponseDto";

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

