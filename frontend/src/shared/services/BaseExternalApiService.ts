import config, { shouldUseMockData } from "@/src/config";
import type { ApiResponse } from "@/src/shared/types/api";
import { mockDataService } from "./MockDataService";
import { endpointToMockFile } from "./endpointToMockMapper";

/**
 * Base API Service for external endpoints (no JWT authentication required)
 * This service does not add Authorization header
 */
export class BaseExternalApiService {
  protected baseUrl: string;

  constructor() {
    this.baseUrl = config.apiUrl;
  }

  // Get headers without authentication
  protected getHeaders(): HeadersInit {
    return {
      "Content-Type": "application/json",
    };
  }

  // Generic API call method without JWT authentication
  protected async apiCall<T>(
    endpoint: string,
    options: RequestInit = {}
  ): Promise<ApiResponse<T>> {
    // Intercepter les appels en mode mock
    if (shouldUseMockData()) {
      const mockFile = endpointToMockFile(endpoint, options.method || "GET");
      if (mockFile) {
        try {
          console.log(
            `[MOCK] Loading mock data from ${mockFile} for endpoint ${endpoint}`
          );
          const data = await mockDataService.load<T>(mockFile);

          // Gérer les réponses avec wrapper { success: true, user: {...} }
          if (data && typeof data === "object" && "user" in data) {
            return {
              success: true,
              data: (data as any).user as T,
            };
          }

          // Gérer les réponses directes
          return {
            success: true,
            data: data as T,
          };
        } catch (error) {
          console.error(
            `[MOCK] Failed to load mock data from ${mockFile}:`,
            error
          );
          return {
            success: false,
            error:
              error instanceof Error
                ? error.message
                : `Failed to load mock data from ${mockFile}`,
          };
        }
      } else {
        console.warn(`[MOCK] No mock file found for endpoint: ${endpoint}`);
      }
    }

    // Appel API réel
    try {
      const url = `${this.baseUrl}${endpoint}`;

      const response = await fetch(url, {
        ...options,
        headers: {
          ...this.getHeaders(),
          ...options.headers,
        },
      });

      if (!response.ok) {
        const errorData = await response.json().catch(() => ({}));
        return {
          success: false,
          error:
            errorData.error ||
            errorData.message ||
            `HTTP ${response.status}: ${response.statusText}`,
        };
      }

      const data = await response.json();
      return {
        success: true,
        data,
      };
    } catch (error) {
      console.error("External API call failed:", error);
      return {
        success: false,
        error:
          error instanceof Error ? error.message : "Unknown error occurred",
      };
    }
  }

  // Generic API call for blob responses (PDF, Excel, etc.) without JWT
  protected async apiCallBlob(
    endpoint: string,
    options: RequestInit = {}
  ): Promise<ApiResponse<Blob>> {
    try {
      const url = `${this.baseUrl}${endpoint}`;

      const response = await fetch(url, {
        ...options,
        headers: {
          ...this.getHeaders(),
          ...options.headers,
        },
      });

      if (!response.ok) {
        const errorData = await response.json().catch(() => ({}));
        return {
          success: false,
          error:
            errorData.error ||
            errorData.message ||
            `HTTP ${response.status}: ${response.statusText}`,
        };
      }

      const blob = await response.blob();
      return {
        success: true,
        data: blob,
      };
    } catch (error) {
      console.error("External API call failed:", error);
      return {
        success: false,
        error:
          error instanceof Error ? error.message : "Unknown error occurred",
      };
    }
  }
}
