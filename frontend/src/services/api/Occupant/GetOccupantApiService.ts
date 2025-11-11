import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { ShowRequestDto } from "@/types/api/request/Occupant/ShowRequestDto";
import type { GetOccupantResponseDto } from "@/types/api/response/occupant/GetOccupantResponseDto";

export class GetOccupantApiService extends BaseApiService {
  async getOccupant(
    data: ShowRequestDto
  ): Promise<ApiResponse<GetOccupantResponseDto>> {
    return this.apiCall<GetOccupantResponseDto>(
      `/api/occupant/${data.pkOccupant}`,
      {
        method: "GET",
      }
    );
  }
}

export const getOccupantApiService = new GetOccupantApiService();

