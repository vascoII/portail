import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { LeaksRequestDto } from "@/src/features/occupant/types/request/LeaksRequestDto";
import type { ListFuitesResponseDto } from "@/src/shared/types/response/ListFuitesResponseDto";

export class ListFuitesByOccupantApiService extends BaseApiService {
  async listFuitesByOccupant(
    data: LeaksRequestDto
  ): Promise<ApiResponse<ListFuitesResponseDto>> {
    return this.apiCall<ListFuitesResponseDto>(
      `/api/occupant/${data.pkOccupant}/fuites`,
      {
        method: "GET",
      }
    );
  }
}

export const listFuitesByOccupantApiService = new ListFuitesByOccupantApiService();

