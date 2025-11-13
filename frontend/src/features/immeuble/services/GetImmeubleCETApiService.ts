import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ShowRequestDto } from "@/src/features/immeuble/types/request/ShowRequestDto";

export class GetImmeubleCETApiService extends BaseApiService {
  async getImmeubleCET(data: ShowRequestDto): Promise<ApiResponse<any>> {
    return this.apiCall<any>(`/api/immeuble/${data.pkImmeuble}/cet`, {
      method: "GET",
    });
  }
}

export const getImmeubleCETApiService = new GetImmeubleCETApiService();
