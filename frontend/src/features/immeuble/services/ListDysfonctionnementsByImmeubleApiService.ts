import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GetInfosDysfonctionnementsByImmeubleRequestDto } from "@/src/features/immeuble/types/request/GetInfosDysfonctionnementsByImmeubleRequestDto";
import type { ListDysfonctionnementsResponseDto } from "@/src/shared/types/response/ListDysfonctionnementsResponseDto";

export class ListDysfonctionnementsByImmeubleApiService extends BaseApiService {
  async listDysfonctionnementsByImmeuble(
    data: GetInfosDysfonctionnementsByImmeubleRequestDto
  ): Promise<ApiResponse<ListDysfonctionnementsResponseDto>> {
    return this.apiCall<ListDysfonctionnementsResponseDto>(
      `/api/immeuble/${data.pkImmeuble}/dysfonctionnements`,
      {
        method: "GET",
      }
    );
  }
}

export const listDysfonctionnementsByImmeubleApiService =
  new ListDysfonctionnementsByImmeubleApiService();
