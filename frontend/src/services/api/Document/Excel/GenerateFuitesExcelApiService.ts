import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GenerateFuitesDocumentRequestDto } from "@/types/api/request/Document/GenerateFuitesDocumentRequestDto";

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

