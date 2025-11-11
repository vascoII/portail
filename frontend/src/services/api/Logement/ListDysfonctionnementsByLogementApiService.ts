import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { DysfunctionsRequestDto } from "@/types/api/request/Logement/DysfunctionsRequestDto";
import type { ListDysfonctionnementsResponseDto } from "@/types/api/response/shared/ListDysfonctionnementsResponseDto";

export class ListDysfonctionnementsByLogementApiService extends BaseApiService {
  async listDysfonctionnementsByLogement(
    data: DysfunctionsRequestDto
  ): Promise<ApiResponse<ListDysfonctionnementsResponseDto>> {
    return this.apiCall<ListDysfonctionnementsResponseDto>(
      `/api/logement/${data.pkLogement}/dysfonctionnements`,
      {
        method: "GET",
      }
    );
  }
}

export const listDysfonctionnementsByLogementApiService = new ListDysfonctionnementsByLogementApiService();

