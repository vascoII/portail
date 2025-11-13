import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { MyAccountRequestDto } from "@/src/features/occupant/types/request/MyAccountRequestDto";
import type { GetOccupantAccountResponseDto } from "@/src/features/occupant/types/response/GetOccupantAccountResponseDto";

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
