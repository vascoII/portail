import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { LeaksRequestDto } from "@/types/api/request/Occupant/LeaksRequestDto";
import type { ListFuitesResponseDto } from "@/types/api/response/shared/ListFuitesResponseDto";

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

