import { BaseExternalApiService } from "@/src/shared/services/BaseExternalApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GeneratedDocumentResponseDto } from "@/src/features/external/types/response/GeneratedDocumentResponseDto";

export class ReceiveGeneratedDocumentApiService extends BaseExternalApiService {
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

