import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GenerateInterventionDocumentRequestDto } from "@/src/features/document/types/request/GenerateInterventionDocumentRequestDto";

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

