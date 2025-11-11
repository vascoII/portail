import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { PatchOccupantRequestDto } from "@/types/api/request/Occupant/PatchOccupantRequestDto";
import type { SuccessResponseDto } from "@/types/api/response/shared/SuccessResponseDto";

export class PatchOccupantApiService extends BaseApiService {
  async patchOccupant(
    data: PatchOccupantRequestDto
  ): Promise<ApiResponse<SuccessResponseDto>> {
    return this.apiCall<SuccessResponseDto>(
      `/api/occupant/${data.pkOccupant}`,
      {
        method: "PATCH",
        body: JSON.stringify(data),
      }
    );
  }
}

export const patchOccupantApiService = new PatchOccupantApiService();

