import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { DysfunctionsRequestDto } from "@/types/api/request/Occupant/DysfunctionsRequestDto";
import type { ListDysfonctionnementsResponseDto } from "@/types/api/response/shared/ListDysfonctionnementsResponseDto";

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

