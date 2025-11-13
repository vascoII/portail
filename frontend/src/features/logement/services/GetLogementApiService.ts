import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ShowRequestDto } from "@/src/features/logement/types/request/ShowRequestDto";
import type { LogementResponseDto } from "@/src/features/logement/types/response/LogementResponseDto";

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

