import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GetInfosDysfonctionnementsByImmeubleRequestDto } from "@/types/api/request/Immeuble/GetInfosDysfonctionnementsByImmeubleRequestDto";
import type { ListDysfonctionnementsResponseDto } from "@/types/api/response/shared/ListDysfonctionnementsResponseDto";

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
