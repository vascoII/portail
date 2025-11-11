import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GenerateInterventionDocumentRequestDto } from "@/types/api/request/Document/GenerateInterventionDocumentRequestDto";

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

