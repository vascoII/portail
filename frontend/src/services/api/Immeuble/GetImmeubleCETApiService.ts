import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { ShowRequestDto } from "@/types/api/request/Immeuble/ShowRequestDto";

export class GetImmeubleCETApiService extends BaseApiService {
  async getImmeubleCET(data: ShowRequestDto): Promise<ApiResponse<any>> {
    return this.apiCall<any>(`/api/immeuble/${data.pkImmeuble}/cet`, {
      method: "GET",
    });
  }
}

export const getImmeubleCETApiService = new GetImmeubleCETApiService();
