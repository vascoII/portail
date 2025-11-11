import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { ShowRequestDto } from "@/types/api/request/Immeuble/ShowRequestDto";

export class GetImmeubleEFApiService extends BaseApiService {
  async getImmeubleEF(data: ShowRequestDto): Promise<ApiResponse<any>> {
    return this.apiCall<any>(`/api/immeuble/${data.pkImmeuble}/ef`, {
      method: "GET",
    });
  }
}

export const getImmeubleEFApiService = new GetImmeubleEFApiService();
