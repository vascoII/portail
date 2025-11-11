import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GetParcResponseDto } from "@/types/api/response/parc/GetParcResponseDto";

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

