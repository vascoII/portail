import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GenerateImmeubleSyntheseDocumentRequestDto } from "@/types/api/request/Document/GenerateImmeubleSyntheseDocumentRequestDto";

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

