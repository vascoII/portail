import { BaseExternalApiService } from "@/src/shared/services/BaseExternalApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GetDetailsDepannageInpuDto } from "@/src/shared/types/request/GetDetailsDepannageInpuDto";
import type { GetDetailsDepannageResponseDto } from "@/src/shared/types/response/GetDetailsDepannageResponseDto";

export class GetWorkOrderApiService extends BaseExternalApiService {
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

