import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GenerateImmeubleReleveDocumentRequestDto } from "@/src/features/document/types/request/GenerateImmeubleReleveDocumentRequestDto";

export class GenerateImmeubleRelevePdfApiService extends BaseApiService {
  async generateImmeubleRelevePdf(
    data: GenerateImmeubleReleveDocumentRequestDto
  ): Promise<ApiResponse<Blob>> {
    return this.apiCallBlob("/api/document/generate-immeuble-releve-pdf", {
      method: "POST",
      body: JSON.stringify(data),
    });
  }
}

export const generateImmeubleRelevePdfApiService = new GenerateImmeubleRelevePdfApiService();

