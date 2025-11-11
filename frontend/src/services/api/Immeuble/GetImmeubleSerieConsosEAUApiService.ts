import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { ShowRequestDto } from "@/types/api/request/Immeuble/ShowRequestDto";

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
