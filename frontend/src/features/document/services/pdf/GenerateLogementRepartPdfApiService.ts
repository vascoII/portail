import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GenerateLogementRepartDocumentRequestDto } from "@/src/features/document/types/request/GenerateLogementRepartDocumentRequestDto";

export class GenerateLogementRepartPdfApiService extends BaseApiService {
  async generateLogementRepartPdf(
    data: GenerateLogementRepartDocumentRequestDto
  ): Promise<ApiResponse<Blob>> {
    return this.apiCallBlob("/api/document/generate-logement-repart-pdf", {
      method: "POST",
      body: JSON.stringify(data),
    });
  }
}

export const generateLogementRepartPdfApiService = new GenerateLogementRepartPdfApiService();

