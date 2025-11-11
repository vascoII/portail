import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GetDetailsDepannageInpuDto } from "@/types/api/request/Shared/GetDetailsDepannageInpuDto";

export class GenerateWorkOrderDetailsPdfApiService extends BaseApiService {
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
