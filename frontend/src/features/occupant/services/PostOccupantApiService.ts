import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { PostOccupantRequestDto } from "@/src/features/occupant/types/request/PostOccupantRequestDto";
import type { SuccessResponseDto } from "@/src/shared/types/response/SuccessResponseDto";

export class PostOccupantApiService extends BaseApiService {
  async postOccupant(
    data: PostOccupantRequestDto
  ): Promise<ApiResponse<SuccessResponseDto>> {
    return this.apiCall<SuccessResponseDto>(
      `/api/occupant`,
      {
        method: "POST",
        body: JSON.stringify(data),
      }
    );
  }
}

export const postOccupantApiService = new PostOccupantApiService();

