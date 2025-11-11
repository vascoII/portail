import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { MyAccountRequestDto } from "@/types/api/request/Occupant/MyAccountRequestDto";
import type { GetOccupantAccountResponseDto } from "@/types/api/response/occupant/GetOccupantAccountResponseDto";

export class GetOccupantAccountApiService extends BaseApiService {
  async getOccupantAccount(
    data: MyAccountRequestDto
  ): Promise<ApiResponse<GetOccupantAccountResponseDto>> {
    return this.apiCall<GetOccupantAccountResponseDto>(
      `/api/occupant/account`,
      {
        method: "GET",
      }
    );
  }
}

export const getOccupantAccountApiService = new GetOccupantAccountApiService();
