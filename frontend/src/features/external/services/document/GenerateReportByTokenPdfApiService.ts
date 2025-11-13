import { BaseExternalApiService } from "@/src/shared/services/BaseExternalApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GenerateReportByTokenDocumentRequestDto } from "@/src/features/external/types/request/GenerateReportByTokenDocumentRequestDto";

export class GenerateReportByTokenPdfApiService extends BaseExternalApiService {
  async generateReportByTokenPdf(
    data: GenerateReportByTokenDocumentRequestDto
  ): Promise<ApiResponse<Blob>> {
    return this.apiCallBlob(
      "/api/external/document/generate-report-by-token-pdf",
      {
        method: "POST",
        body: JSON.stringify(data),
      }
    );
  }
}

export const generateReportByTokenPdfApiService =
  new GenerateReportByTokenPdfApiService();
