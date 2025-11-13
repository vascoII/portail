import { BaseExternalApiService } from "@/src/shared/services/BaseExternalApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GetDetailsDepannageInpuDto } from "@/src/shared/types/request/GetDetailsDepannageInpuDto";

export class GenerateWorkOrderDetailsPdfApiService extends BaseExternalApiService {
  async generateWorkOrderDetailsPdf(
    data: GetDetailsDepannageInpuDto
  ): Promise<ApiResponse<Blob>> {
    return this.apiCallBlob(
      "/api/external/suivi/generate-work-order-details-pdf",
      {
        method: "POST",
        body: JSON.stringify(data),
      }
    );
  }
}

export const generateWorkOrderDetailsPdfApiService =
  new GenerateWorkOrderDetailsPdfApiService();
