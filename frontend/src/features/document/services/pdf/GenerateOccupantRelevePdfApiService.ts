import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GenerateOccupantReleveDocumentRequestDto } from "@/src/features/document/types/request/GenerateOccupantReleveDocumentRequestDto";

export class GenerateOccupantRelevePdfApiService extends BaseApiService {
  async generateOccupantRelevePdf(
    data: GenerateOccupantReleveDocumentRequestDto
  ): Promise<ApiResponse<Blob>> {
    return this.apiCallBlob("/api/document/generate-occupant-releve-pdf", {
      method: "POST",
      body: JSON.stringify(data),
    });
  }
}

export const generateOccupantRelevePdfApiService = new GenerateOccupantRelevePdfApiService();

