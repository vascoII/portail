import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GenerateOccupantNoteDocumentRequestDto } from "@/types/api/request/Document/GenerateOccupantNoteDocumentRequestDto";

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

