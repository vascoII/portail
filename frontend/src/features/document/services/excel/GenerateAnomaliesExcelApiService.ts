import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GenerateAnomaliesDocumentRequestDto } from "@/src/features/document/types/request/GenerateAnomaliesDocumentRequestDto";

export class GenerateAnomaliesExcelApiService extends BaseApiService {
  async generateAnomaliesExcel(
    data: GenerateAnomaliesDocumentRequestDto
  ): Promise<ApiResponse<Blob>> {
    return this.apiCallBlob("/api/document/generate-anomalies-excel", {
      method: "POST",
      body: JSON.stringify(data),
    });
  }
}

export const generateAnomaliesExcelApiService =
  new GenerateAnomaliesExcelApiService();
