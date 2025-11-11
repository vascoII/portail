import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GenerateLogementRepartDocumentRequestDto } from "@/types/api/request/Document/GenerateLogementRepartDocumentRequestDto";

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

