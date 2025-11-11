import { BaseApiService } from "../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { PostOccupantRequestDto } from "@/types/api/request/Occupant/PostOccupantRequestDto";
import type { SuccessResponseDto } from "@/types/api/response/shared/SuccessResponseDto";

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

