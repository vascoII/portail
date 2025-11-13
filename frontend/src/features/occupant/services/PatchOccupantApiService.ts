import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { PatchOccupantRequestDto } from "@/src/features/occupant/types/request/PatchOccupantRequestDto";
import type { SuccessResponseDto } from "@/src/shared/types/response/SuccessResponseDto";

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

