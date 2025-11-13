import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { IndexRequestDto } from "@/src/features/immeuble/types/request/IndexRequestDto";
import type { ListImmeublesResponseDto } from "@/src/features/immeuble/types/response/ListImmeublesResponseDto";
import { shouldUseMockData } from "@/src/config";
import { mockDataService } from "@/src/shared/services/MockDataService";

/**
 * Service API pour récupérer la liste des immeubles
 *
 * En mode mock (NEXT_PUBLIC_USE_MOCK_DATA=true) :
 * - Charge les données depuis /public/data/ListImmeublesAction.json
 * - Mappe directement vers ListImmeublesResponseDto (structure identique)
 *
 * En mode production :
 * - Fait un appel GET vers /api/immeuble avec les filtres optionnels
 * - Retourne ListImmeublesResponseDto
 */
export class ListImmeublesApiService extends BaseApiService {
  /**
   * Récupère la liste des immeubles
   * @param data - Filtres optionnels pour la recherche
   * @returns Réponse avec la liste des immeubles
   */
  async listImmeubles(
    data?: IndexRequestDto
  ): Promise<ApiResponse<ListImmeublesResponseDto>> {
    // En mode mock, charger explicitement depuis ListImmeublesAction.json
    if (shouldUseMockData()) {
      try {
        console.log(
          "[MOCK] Loading immeubles data from ListImmeublesAction.json"
        );
        const mockData = await mockDataService.load<ListImmeublesResponseDto>(
          "ListImmeublesAction.json"
        );

        // La structure de ListImmeublesAction.json correspond exactement à ListImmeublesResponseDto
        // Vérifier que listImmeubleDto existe et est un tableau
        if (!mockData || !Array.isArray(mockData.listImmeubleDto)) {
          console.warn(
            "[MOCK] Invalid structure in ListImmeublesAction.json: missing or invalid listImmeubleDto"
          );
          return {
            success: false,
            error: "Invalid mock data structure: missing listImmeubleDto array",
          };
        }

        // Mapper vers ListImmeublesResponseDto
        const immeublesData: ListImmeublesResponseDto = {
          listImmeubleDto: mockData.listImmeubleDto || [],
        };

        return {
          success: true,
          data: immeublesData,
        };
      } catch (error) {
        console.error("[MOCK] Failed to load immeubles mock data:", error);
        return {
          success: false,
          error:
            error instanceof Error
              ? error.message
              : "Failed to load immeubles mock data",
        };
      }
    }

    // Appel API réel avec les filtres optionnels
    const params = new URLSearchParams();
    if (data) {
      Object.entries(data).forEach(([key, value]) => {
        if (value !== undefined && value !== null) {
          params.append(key, value.toString());
        }
      });
    }
    const queryString = params.toString();
    return this.apiCall<ListImmeublesResponseDto>(
      `/api/immeuble${queryString ? `?${queryString}` : ""}`,
      {
        method: "GET",
      }
    );
  }
}

export const listImmeublesApiService = new ListImmeublesApiService();
