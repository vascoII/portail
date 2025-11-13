import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GenerateImmeubleDetailDocumentRequestDto } from "@/src/features/document/types/request/GenerateImmeubleDetailDocumentRequestDto";

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

