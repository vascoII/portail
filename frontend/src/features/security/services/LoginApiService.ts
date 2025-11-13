import { BaseExternalApiService } from "@/src/shared/services/BaseExternalApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { LoginRequestDto } from "@/src/features/security/types/request/LoginRequestDto";
import type { LoginResponseDto } from "@/src/features/security/types/response/LoginResponseDto";
import { shouldUseMockData } from "@/src/config";
import { mockDataService } from "@/src/shared/services/MockDataService";

/**
 * Service API pour l'authentification (login)
 *
 * En mode mock (NEXT_PUBLIC_USE_MOCK_DATA=true) :
 * - Charge les données depuis /public/data/LoginAction.json
 * - Le fichier JSON correspond exactement à LoginResponseDto
 * - Le token JWT est inclus dans la réponse et sera stocké dans localStorage par useAuth
 *
 * En mode production :
 * - Fait un appel POST vers /api/security/login
 * - Retourne LoginResponseDto avec le token JWT
 */
export class LoginApiService extends BaseExternalApiService {
  /**
   * Authentifie un utilisateur
   * @param data Identifiants de connexion (username, password)
   * @returns Réponse avec le token JWT et les données utilisateur
   */
  async login(data: LoginRequestDto): Promise<ApiResponse<LoginResponseDto>> {
    // En mode mock, le BaseExternalApiService intercepte automatiquement l'appel
    // et charge LoginAction.json via endpointToMockMapper
    // Le mapping est : /api/security/login -> LoginAction.json
    // Le JSON correspond exactement à LoginResponseDto, donc pas de transformation nécessaire

    // Si on veut gérer explicitement le mode mock ici (optionnel) :
    if (shouldUseMockData()) {
      try {
        console.log("[MOCK] Loading login data from LoginAction.json");
        const mockData = await mockDataService.load<LoginResponseDto>(
          "LoginAction.json"
        );

        // Vérifier que le token JWT est présent
        if (!mockData.tokenJwt) {
          console.warn(
            "[MOCK] Warning: tokenJwt is missing in LoginAction.json"
          );
        }

        return {
          success: true,
          data: mockData,
        };
      } catch (error) {
        console.error("[MOCK] Failed to load login mock data:", error);
        return {
          success: false,
          error:
            error instanceof Error
              ? error.message
              : "Failed to load login mock data",
        };
      }
    }

    // Appel API réel (ou via BaseExternalApiService si le mode mock n'est pas géré explicitement)
    return this.apiCall<LoginResponseDto>(`/api/security/login`, {
      method: "POST",
      body: JSON.stringify(data),
    });
  }
}

export const loginApiService = new LoginApiService();
