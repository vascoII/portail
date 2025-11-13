import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GenerateInterventionsDocumentRequestDto } from "@/src/features/document/types/request/GenerateInterventionsDocumentRequestDto";

export class GenerateImmeubleInterventionsExcelApiService extends BaseApiService {
  async generateImmeubleInterventionsExcel(
    data: GenerateInterventionsDocumentRequestDto
  ): Promise<ApiResponse<Blob>> {
    return this.apiCallBlob("/api/document/generate-immeuble-interventions-excel", {
      method: "POST",
      body: JSON.stringify(data),
    });
  }
}

export const generateImmeubleInterventionsExcelApiService = new GenerateImmeubleInterventionsExcelApiService();

