import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GetDetailsDepannageInpuDto } from "@/types/api/request/Shared/GetDetailsDepannageInpuDto";
import type { GetDetailsDepannageResponseDto } from "@/types/api/response/shared/GetDetailsDepannageResponseDto";

export class GetWorkOrderApiService extends BaseApiService {
  async getWorkOrder(
    data: GetDetailsDepannageInpuDto
  ): Promise<ApiResponse<GetDetailsDepannageResponseDto>> {
    const params = new URLSearchParams({ pkDepannage: data.pkDepannage });
    return this.apiCall<GetDetailsDepannageResponseDto>(
      `/api/external/suivi/work-order?${params.toString()}`,
      {
        method: "GET",
      }
    );
  }
}

export const getWorkOrderApiService = new GetWorkOrderApiService();

