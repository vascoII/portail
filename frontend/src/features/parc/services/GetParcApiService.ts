import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GetParcResponseDto } from "@/src/features/parc/types/response/GetParcResponseDto";

export class GetParcApiService extends BaseApiService {
  async getParc(): Promise<ApiResponse<GetParcResponseDto>> {
    return this.apiCall<GetParcResponseDto>(
      `/api/parc`,
      {
        method: "GET",
      }
    );
  }
}

export const getParcApiService = new GetParcApiService();

