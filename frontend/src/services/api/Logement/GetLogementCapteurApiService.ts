import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { ShowRequestDto } from "@/types/api/request/Logement/ShowRequestDto";

export class GetLogementCapteurApiService extends BaseApiService {
  async getLogementCapteur(data: ShowRequestDto): Promise<ApiResponse<any>> {
    return this.apiCall<any>(`/api/logement/${data.pkLogement}/capteur`, {
      method: "GET",
    });
  }
}

export const getLogementCapteurApiService = new GetLogementCapteurApiService();
