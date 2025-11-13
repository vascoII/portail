import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ShowRequestDto } from "@/src/features/occupant/types/request/ShowRequestDto";
import type { GetOccupantResponseDto } from "@/src/features/occupant/types/response/GetOccupantResponseDto";

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

