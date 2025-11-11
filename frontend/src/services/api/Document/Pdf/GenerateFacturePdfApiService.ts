import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GenerateFactureDocumentRequestDto } from "@/types/api/request/Document/GenerateFactureDocumentRequestDto";

export class GenerateFacturePdfApiService extends BaseApiService {
  async generateFacturePdf(
    data: GenerateFactureDocumentRequestDto
  ): Promise<ApiResponse<Blob>> {
    return this.apiCallBlob("/api/document/generate-facture-pdf", {
      method: "POST",
      body: JSON.stringify(data),
    });
  }
}

export const generateFacturePdfApiService = new GenerateFacturePdfApiService();
