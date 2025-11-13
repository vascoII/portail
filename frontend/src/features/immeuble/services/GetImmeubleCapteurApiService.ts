import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ShowRequestDto } from "@/src/features/immeuble/types/request/ShowRequestDto";

export class GetImmeubleCapteurApiService extends BaseApiService {
  async getImmeubleCapteur(data: ShowRequestDto): Promise<ApiResponse<any>> {
    return this.apiCall<any>(`/api/immeuble/${data.pkImmeuble}/capteur`, {
      method: "GET",
    });
  }
}

export const getImmeubleCapteurApiService = new GetImmeubleCapteurApiService();
