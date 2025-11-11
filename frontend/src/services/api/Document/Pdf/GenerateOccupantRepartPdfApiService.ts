import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GenerateOccupantRepartDocumentRequestDto } from "@/types/api/request/Document/GenerateOccupantRepartDocumentRequestDto";

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

