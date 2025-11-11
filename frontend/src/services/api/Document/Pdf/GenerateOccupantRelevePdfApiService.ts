import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GenerateOccupantReleveDocumentRequestDto } from "@/types/api/request/Document/GenerateOccupantReleveDocumentRequestDto";

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

