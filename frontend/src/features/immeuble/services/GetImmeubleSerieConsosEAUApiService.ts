import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ShowRequestDto } from "@/src/features/immeuble/types/request/ShowRequestDto";

export class GetImmeubleSerieConsosEAUApiService extends BaseApiService {
  async getImmeubleSerieConsosEAU(
    data: ShowRequestDto
  ): Promise<ApiResponse<any>> {
    return this.apiCall<any>(
      `/api/immeuble/${data.pkImmeuble}/serie-consos-eau`,
      {
        method: "GET",
      }
    );
  }
}

export const getImmeubleSerieConsosEAUApiService =
  new GetImmeubleSerieConsosEAUApiService();
