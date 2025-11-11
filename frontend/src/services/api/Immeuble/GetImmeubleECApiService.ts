import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { ShowRequestDto } from "@/types/api/request/Immeuble/ShowRequestDto";

export class GetImmeubleECApiService extends BaseApiService {
  async getImmeubleEC(
    data: ShowRequestDto
  ): Promise<ApiResponse<any>> {
    return this.apiCall<any>(
      `/api/immeuble/${data.pkImmeuble}/ec`,
      {
        method: "GET",
      }
    );
  }
}

export const getImmeubleECApiService = new GetImmeubleECApiService();

