import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GenerateOccupantRepartDocumentRequestDto } from "@/src/features/document/types/request/GenerateOccupantRepartDocumentRequestDto";

export class GenerateOccupantRepartPdfApiService extends BaseApiService {
  async generateOccupantRepartPdf(
    data: GenerateOccupantRepartDocumentRequestDto
  ): Promise<ApiResponse<Blob>> {
    return this.apiCallBlob("/api/document/generate-occupant-repart-pdf", {
      method: "POST",
      body: JSON.stringify(data),
    });
  }
}

export const generateOccupantRepartPdfApiService = new GenerateOccupantRepartPdfApiService();

