import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { DysfunctionsRequestDto } from "@/src/features/logement/types/request/DysfunctionsRequestDto";
import type { ListDysfonctionnementsResponseDto } from "@/src/shared/types/response/ListDysfonctionnementsResponseDto";

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

