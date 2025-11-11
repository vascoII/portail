import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GenerateInterventionDocumentRequestDto } from "@/types/api/request/Document/GenerateInterventionDocumentRequestDto";

export class GenerateInterventionsExcelApiService extends BaseApiService {
  async generateInterventionsExcel(
    data: GenerateInterventionDocumentRequestDto
  ): Promise<ApiResponse<Blob>> {
    return this.apiCallBlob("/api/document/generate-interventions-excel", {
      method: "POST",
      body: JSON.stringify(data),
    });
  }
}

export const generateInterventionsExcelApiService = new GenerateInterventionsExcelApiService();

