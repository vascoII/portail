import { BaseApiService } from "../../BaseApiService";
import type { ApiResponse } from "@/types/api";
import type { GenerateReleveRequestDto } from "@/types/api/request/Releve/GenerateReleveRequestDto";

export class GenerateReleveApiService extends BaseApiService {
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
