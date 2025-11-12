import { BaseExternalApiService } from "../../BaseExternalApiService";
import type { ApiResponse } from "@/types/api";
import type { GenerateReportByTokenDocumentRequestDto } from "@/types/api/request/Document/GenerateReportByTokenDocumentRequestDto";

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
