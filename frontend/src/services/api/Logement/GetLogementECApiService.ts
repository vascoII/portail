import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { ShowRequestDto } from "@/types/api/request/Logement/ShowRequestDto";

export class GetLogementECApiService extends BaseApiService {
  async getLogementEC(
    data: ShowRequestDto
  ): Promise<ApiResponse<any>> {
    return this.apiCall<any>(
      `/api/logement/${data.pkLogement}/ec`,
      {
        method: "GET",
      }
    );
  }
}

export const getLogementECApiService = new GetLogementECApiService();

