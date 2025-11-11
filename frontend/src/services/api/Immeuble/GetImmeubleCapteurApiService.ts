import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { ShowRequestDto } from "@/types/api/request/Immeuble/ShowRequestDto";

export class GetImmeubleCapteurApiService extends BaseApiService {
  async getImmeubleCapteur(data: ShowRequestDto): Promise<ApiResponse<any>> {
    return this.apiCall<any>(`/api/immeuble/${data.pkImmeuble}/capteur`, {
      method: "GET",
    });
  }
}

export const getImmeubleCapteurApiService = new GetImmeubleCapteurApiService();
