import { BaseApiService } from "@/src/shared/services/BaseApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { UserResponseDto } from "@/src/shared/types/response/UserResponseDto";
import { shouldUseMockData } from "@/src/config";
import { mockDataService } from "@/src/shared/services/MockDataService";

/**
 * Interface pour la structure de MeAction.json avec wrapper
 */
interface MeActionResponse {
  success: boolean;
  user: UserResponseDto;
}

/**
 * Service API pour récupérer les données de l'utilisateur connecté (me)
 *
 * En mode mock (NEXT_PUBLIC_USE_MOCK_DATA=true) :
 * - Charge les données depuis /public/data/MeAction.json
 * - Extrait l'objet user de la réponse { success: true, user: {...} }
 * - Mappe vers UserResponseDto
 *
 * En mode production :
 * - Fait un appel GET vers /api/security/me
 * - Retourne UserResponseDto
 */
export class MeApiService extends BaseApiService {
  /**
   * Récupère les données de l'utilisateur connecté
   * @returns Réponse avec les données utilisateur
   */
  async me(): Promise<ApiResponse<UserResponseDto>> {
    // En mode mock, gérer explicitement le chargement et l'extraction
    if (shouldUseMockData()) {
      try {
        console.log("[MOCK] Loading user data from MeAction.json");
        const mockData = await mockDataService.load<MeActionResponse>(
          "MeAction.json"
        );

        // Extraire l'objet user de la réponse { success: true, user: {...} }
        if (mockData && mockData.success && mockData.user) {
          const userData: UserResponseDto = {
            loginId: mockData.user.loginId ?? null,
            userName: mockData.user.userName ?? null,
            email: mockData.user.email ?? null,
            userType: mockData.user.userType ?? null,
            pkUser: mockData.user.pkUser ?? null,
            adresse: mockData.user.adresse ?? null,
            cp: mockData.user.cp ?? null,
            ville: mockData.user.ville ?? null,
            fk: mockData.user.fk ?? null,
            phoneNumber: mockData.user.phoneNumber ?? null,
            firstName: mockData.user.firstName ?? null,
            userRole: mockData.user.userRole ?? null,
            clientName: mockData.user.clientName ?? null,
            clientId: mockData.user.clientId ?? null,
            cgu: mockData.user.cgu ?? null,
            fkClient: mockData.user.fkClient ?? null,
            fkClientTop: mockData.user.fkClientTop ?? null,
            nbImmeubles: mockData.user.nbImmeubles ?? null,
            seuilConsoEf: mockData.user.seuilConsoEf ?? null,
            seuilConsoEc: mockData.user.seuilConsoEc ?? null,
            seuilConsoRepart: mockData.user.seuilConsoRepart ?? null,
            seuilConsoCet: mockData.user.seuilConsoCet ?? null,
            seuilConsoActif: mockData.user.seuilConsoActif ?? null,
            seuilConsoEmail: mockData.user.seuilConsoEmail ?? null,
            showImmeublesArc: mockData.user.showImmeublesArc ?? null,
            showFactures: mockData.user.showFactures ?? null,
            showChgtOccupant: mockData.user.showChgtOccupant ?? null,
            showChantiers: mockData.user.showChantiers ?? null,
          };

          return {
            success: true,
            data: userData,
          };
        }

        return {
          success: false,
          error: "Invalid mock data structure: missing user object",
        };
      } catch (error) {
        console.error("[MOCK] Failed to load user mock data:", error);
        return {
          success: false,
          error:
            error instanceof Error
              ? error.message
              : "Failed to load user mock data",
        };
      }
    }

    // Appel API réel
    // BaseApiService gère déjà l'extraction de l'objet user si la réponse contient { success: true, user: {...} }
    return this.apiCall<UserResponseDto>(`/api/security/me`, {
      method: "GET",
    });
  }
}

export const meApiService = new MeApiService();
