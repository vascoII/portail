import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GenerateDysfonctionnementsDocumentRequestDto } from "@/types/api/request/Document/GenerateDysfonctionnementsDocumentRequestDto";

export class GenerateDysfonctionnementsExcelApiService extends BaseApiService {
  async generateDysfonctionnementsExcel(
    data: GenerateDysfonctionnementsDocumentRequestDto
  ): Promise<ApiResponse<Blob>> {
    return this.apiCallBlob("/api/document/generate-dysfonctionnements-excel", {
      method: "POST",
      body: JSON.stringify(data),
    });
  }
}

export const generateDysfonctionnementsExcelApiService = new GenerateDysfonctionnementsExcelApiService();

