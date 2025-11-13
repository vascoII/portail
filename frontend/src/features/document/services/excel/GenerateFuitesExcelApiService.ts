import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GenerateFuitesDocumentRequestDto } from "@/src/features/document/types/request/GenerateFuitesDocumentRequestDto";

export class GenerateFuitesExcelApiService extends BaseApiService {
  async generateFuitesExcel(
    data: GenerateFuitesDocumentRequestDto
  ): Promise<ApiResponse<Blob>> {
    return this.apiCallBlob("/api/document/generate-fuites-excel", {
      method: "POST",
      body: JSON.stringify(data),
    });
  }
}

export const generateFuitesExcelApiService = new GenerateFuitesExcelApiService();

