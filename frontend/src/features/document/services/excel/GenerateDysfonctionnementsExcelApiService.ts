import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GenerateDysfonctionnementsDocumentRequestDto } from "@/src/features/document/types/request/GenerateDysfonctionnementsDocumentRequestDto";

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

