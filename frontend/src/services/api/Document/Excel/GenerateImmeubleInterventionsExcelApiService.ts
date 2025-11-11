import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GenerateInterventionsDocumentRequestDto } from "@/types/api/request/Document/GenerateInterventionsDocumentRequestDto";

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

