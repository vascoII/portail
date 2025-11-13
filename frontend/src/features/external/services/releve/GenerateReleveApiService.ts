import { BaseExternalApiService } from "@/src/shared/services/BaseExternalApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GenerateReleveRequestDto } from "@/src/features/releve/types/request/GenerateReleveRequestDto";

export class GenerateReleveApiService extends BaseExternalApiService {
  async generateReleve(
    data: GenerateReleveRequestDto
  ): Promise<ApiResponse<Blob>> {
    return this.apiCallBlob("/api/external/releve/generate", {
      method: "POST",
      body: JSON.stringify(data),
    });
  }
}

export const generateReleveApiService = new GenerateReleveApiService();
