import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GenerateOccupantNoteDocumentRequestDto } from "@/src/features/document/types/request/GenerateOccupantNoteDocumentRequestDto";

export class GenerateOccupantNotePdfApiService extends BaseApiService {
  async generateOccupantNotePdf(
    data: GenerateOccupantNoteDocumentRequestDto
  ): Promise<ApiResponse<Blob>> {
    return this.apiCallBlob("/api/document/generate-occupant-note-pdf", {
      method: "POST",
      body: JSON.stringify(data),
    });
  }
}

export const generateOccupantNotePdfApiService = new GenerateOccupantNotePdfApiService();

