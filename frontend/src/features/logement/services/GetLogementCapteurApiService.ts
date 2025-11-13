import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ShowRequestDto } from "@/src/features/logement/types/request/ShowRequestDto";

export class GetLogementCapteurApiService extends BaseApiService {
  async getLogementCapteur(data: ShowRequestDto): Promise<ApiResponse<any>> {
    return this.apiCall<any>(`/api/logement/${data.pkLogement}/capteur`, {
      method: "GET",
    });
  }
}

export const getLogementCapteurApiService = new GetLogementCapteurApiService();
