import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GenerateFactureDocumentRequestDto } from "@/src/features/document/types/request/GenerateFactureDocumentRequestDto";

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
