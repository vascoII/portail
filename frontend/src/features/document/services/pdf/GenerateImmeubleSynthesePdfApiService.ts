import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GenerateImmeubleSyntheseDocumentRequestDto } from "@/src/features/document/types/request/GenerateImmeubleSyntheseDocumentRequestDto";

export class GenerateImmeubleSynthesePdfApiService extends BaseApiService {
  async generateImmeubleSynthesePdf(
    data: GenerateImmeubleSyntheseDocumentRequestDto
  ): Promise<ApiResponse<Blob>> {
    return this.apiCallBlob("/api/document/generate-immeuble-synthese-pdf", {
      method: "POST",
      body: JSON.stringify(data),
    });
  }
}

export const generateImmeubleSynthesePdfApiService = new GenerateImmeubleSynthesePdfApiService();

