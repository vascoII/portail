import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { ShowRequestDto } from "@/src/features/immeuble/types/request/ShowRequestDto";

export class GetImmeubleEFApiService extends BaseApiService {
  async getImmeubleEF(data: ShowRequestDto): Promise<ApiResponse<any>> {
    return this.apiCall<any>(`/api/immeuble/${data.pkImmeuble}/ef`, {
      method: "GET",
    });
  }
}

export const getImmeubleEFApiService = new GetImmeubleEFApiService();
