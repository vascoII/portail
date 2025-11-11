import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { ShowRequestDto } from "@/types/api/request/Logement/ShowRequestDto";
import type { LogementResponseDto } from "@/types/api/response/logement/LogementResponseDto";

export class GetLogementApiService extends BaseApiService {
  async getLogement(
    data: ShowRequestDto
  ): Promise<ApiResponse<LogementResponseDto>> {
    return this.apiCall<LogementResponseDto>(
      `/api/logement/${data.pkLogement}`,
      {
        method: "GET",
      }
    );
  }
}

export const getLogementApiService = new GetLogementApiService();

