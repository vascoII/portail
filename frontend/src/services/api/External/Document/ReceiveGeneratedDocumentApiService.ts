import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GeneratedDocumentResponseDto } from "@/types/api/response/external/GeneratedDocumentResponseDto";

export class ReceiveGeneratedDocumentApiService extends BaseApiService {
  async receiveGeneratedDocument(
    token: string
  ): Promise<ApiResponse<GeneratedDocumentResponseDto>> {
    return this.apiCall<GeneratedDocumentResponseDto>(
      `/api/external/document/receive-generated-document?token=${token}`,
      {
        method: "GET",
      }
    );
  }
}

export const receiveGeneratedDocumentApiService = new ReceiveGeneratedDocumentApiService();

