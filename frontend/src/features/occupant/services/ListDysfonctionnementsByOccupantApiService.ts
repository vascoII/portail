import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { DysfunctionsRequestDto } from "@/src/features/occupant/types/request/DysfunctionsRequestDto";
import type { ListDysfonctionnementsResponseDto } from "@/src/shared/types/response/ListDysfonctionnementsResponseDto";

export class ListDysfonctionnementsByOccupantApiService extends BaseApiService {
  async listDysfonctionnementsByOccupant(
    data: DysfunctionsRequestDto
  ): Promise<ApiResponse<ListDysfonctionnementsResponseDto>> {
    return this.apiCall<ListDysfonctionnementsResponseDto>(
      `/api/occupant/${data.pkOccupant}/dysfonctionnements`,
      {
        method: "GET",
      }
    );
  }
}

export const listDysfonctionnementsByOccupantApiService = new ListDysfonctionnementsByOccupantApiService();

