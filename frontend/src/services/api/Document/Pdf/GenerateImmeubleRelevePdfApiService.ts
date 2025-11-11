import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GenerateImmeubleReleveDocumentRequestDto } from "@/types/api/request/Document/GenerateImmeubleReleveDocumentRequestDto";

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

