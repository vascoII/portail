import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { ShowRequestDto } from "@/types/api/request/Logement/ShowRequestDto";

export class GetLogementCETApiService extends BaseApiService {
  async getLogementCET(
    data: ShowRequestDto
  ): Promise<ApiResponse<any>> {
    return this.apiCall<any>(
      `/api/logement/${data.pkLogement}/cet`,
      {
        method: "GET",
      }
    );
  }
}

export const getLogementCETApiService = new GetLogementCETApiService();

