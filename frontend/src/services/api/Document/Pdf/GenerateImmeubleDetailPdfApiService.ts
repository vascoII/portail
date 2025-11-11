import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GenerateImmeubleDetailDocumentRequestDto } from "@/types/api/request/Document/GenerateImmeubleDetailDocumentRequestDto";

export class GenerateImmeubleDetailPdfApiService extends BaseApiService {
  async generateImmeubleDetailPdf(
    data: GenerateImmeubleDetailDocumentRequestDto
  ): Promise<ApiResponse<Blob>> {
    return this.apiCallBlob("/api/document/generate-immeuble-detail-pdf", {
      method: "POST",
      body: JSON.stringify(data),
    });
  }
}

export const generateImmeubleDetailPdfApiService = new GenerateImmeubleDetailPdfApiService();

