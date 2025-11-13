import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GenerateInterventionDocumentRequestDto } from "@/src/features/document/types/request/GenerateInterventionDocumentRequestDto";

export class GenerateInterventionPdfApiService extends BaseApiService {
  async generateInterventionPdf(
    data: GenerateInterventionDocumentRequestDto
  ): Promise<ApiResponse<Blob>> {
    return this.apiCallBlob("/api/document/generate-intervention-pdf", {
      method: "POST",
      body: JSON.stringify(data),
    });
  }
}

export const generateInterventionPdfApiService = new GenerateInterventionPdfApiService();

