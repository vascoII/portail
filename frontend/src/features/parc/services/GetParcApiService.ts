import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { GetParcResponseDto } from "@/src/features/parc/types/response/GetParcResponseDto";
import { shouldUseMockData } from "@/src/config";
import { mockDataService } from "@/src/shared/services/MockDataService";

/**
 * Service API pour récupérer les données du parc (portfolio)
 *
 * En mode mock (NEXT_PUBLIC_USE_MOCK_DATA=true) :
 * - Charge les données depuis /public/data/GetParcAction.json
 * - Mappe directement vers GetParcResponseDto (structure identique)
 *
 * En mode production :
 * - Fait un appel GET vers /api/parc
 * - Retourne GetParcResponseDto
 */
export class GetParcApiService extends BaseApiService {
  /**
   * Récupère les données du parc
   * @returns Réponse avec les données du parc
   */
  async getParc(): Promise<ApiResponse<GetParcResponseDto>> {
    // En mode mock, charger explicitement depuis GetParcAction.json
    if (shouldUseMockData()) {
      try {
        console.log("[MOCK] Loading parc data from GetParcAction.json");
        const mockData = await mockDataService.load<GetParcResponseDto>(
          "GetParcAction.json"
        );

        // La structure de GetParcAction.json correspond exactement à GetParcResponseDto
        // Mapper toutes les propriétés pour garantir la cohérence des types
        const parcData: GetParcResponseDto = {
          // Building counts
          nbImmeubles: mockData.nbImmeubles ?? 0,
          nbImmeublesTelereleve: mockData.nbImmeublesTelereleve ?? 0,
          nbImmeublesTransfertFichiers:
            mockData.nbImmeublesTransfertFichiers ?? 0,

          // Counter counts
          nbCompteursARelever: mockData.nbCompteursARelever ?? 0,
          nbCompteursReleves: mockData.nbCompteursReleves ?? 0,
          nbLogements: mockData.nbLogements ?? 0,
          nbCompteurs: mockData.nbCompteurs ?? 0,

          // Counter types
          nbCompteursEc: mockData.nbCompteursEc ?? 0,
          nbCompteursEf: mockData.nbCompteursEf ?? 0,
          nbCompteursRepart: mockData.nbCompteursRepart ?? 0,
          nbCompteursCet: mockData.nbCompteursCet ?? 0,
          nbCompteursCapteur: mockData.nbCompteursCapteur ?? 0,
          nbCompteursElect: mockData.nbCompteursElect ?? 0,
          nbCompteursGaz: mockData.nbCompteursGaz ?? 0,

          // Alert counts
          nbFuites: mockData.nbFuites ?? 0,
          degresFuites: mockData.degresFuites ?? 0,
          nbDepannages: mockData.nbDepannages ?? 0,
          degresDepannages: mockData.degresDepannages ?? 0,
          nbDysfonctionnements: mockData.nbDysfonctionnements ?? 0,
          degresDysfonctionnements: mockData.degresDysfonctionnements ?? 0,
          nbAnomalies: mockData.nbAnomalies ?? 0,
          degresAnomalies: mockData.degresAnomalies ?? 0,

          // Construction data
          nbChantiers: mockData.nbChantiers ?? 0,
          nbCompteursPoses: mockData.nbCompteursPoses ?? 0,
          nbCompteursCommandes: mockData.nbCompteursCommandes ?? 0,

          // Percentages
          pcImmeublesTelereleve: mockData.pcImmeublesTelereleve ?? 0,
          pcImmeublesTransfertFichiers:
            mockData.pcImmeublesTransfertFichiers ?? 0,
        };

        return {
          success: true,
          data: parcData,
        };
      } catch (error) {
        console.error("[MOCK] Failed to load parc mock data:", error);
        return {
          success: false,
          error:
            error instanceof Error
              ? error.message
              : "Failed to load parc mock data",
        };
      }
    }

    // Appel API réel
    return this.apiCall<GetParcResponseDto>(`/api/parc`, {
      method: "GET",
    });
  }
}

export const getParcApiService = new GetParcApiService();
