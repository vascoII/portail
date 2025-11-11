import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GenerateAnomaliesDocumentRequestDto } from "@/types/api/request/Document/GenerateAnomaliesDocumentRequestDto";

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
