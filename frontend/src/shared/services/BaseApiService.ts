import config, { shouldUseMockData } from "@/src/config";
import type { ApiResponse } from "@/src/shared/types/api";
import { mockDataService } from "./MockDataService";
import { endpointToMockFile } from "./endpointToMockMapper";

/**
 * Base API Service class with common functionality
 */
export class BaseApiService {
  protected baseUrl: string;
  private token: string | null = null;

  constructor() {
    this.baseUrl = config.apiUrl;
  }

  // Set authentication token
  setAuthToken(token: string | null) {
    this.token = token;
  }

  // Get authentication headers
  protected getAuthHeaders(): HeadersInit {
    const headers: HeadersInit = {
      "Content-Type": "application/json",
    };

    if (this.token) {
      headers["Authorization"] = `Bearer ${this.token}`;
    } else {
      headers[
        "Authorization"
      ] = `Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ0ZWNoZW0tcG9ydGFpbCIsImF1ZCI6InRlY2hlbS1jbGllbnQiLCJpYXQiOjE3NjMwNDkxODAsImV4cCI6MTc2MzA1Mjc4MCwic3ViIjoiNzkyMjIiLCJkYXRhIjp7InNlc3Npb25JZCI6IjQ2YmQ2ODAyLThkYmItNDM5My04MzE4LTExNGRjM2VkZjI1OCIsInVzZXJOYW1lIjoiVEVTVCBDTElFTlQgQ29tcGxldCIsImxvZ2luSWQiOiJURVNUQ0xJRU5UQ09NUExFVCIsInVzZXJUeXBlIjoiQyIsImNsaWVudElkIjoiQzAwMzgzIiwiZmtDbGllbnQiOjM3NzE4LCJ1c2VyUm9sZSI6IiJ9fQ.TAJcHBR0AxURlGjitNdn1MGaYTjoeWTF2TvOwZnkq2E`;
    }

    return headers;
  }

  // Generic API call method with proper error handling
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
          // comme pour MeAction.json
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
          ...this.getAuthHeaders(),
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
      console.error("API call failed:", error);
      return {
        success: false,
        error:
          error instanceof Error ? error.message : "Unknown error occurred",
      };
    }
  }

  // Generic API call for blob responses (PDF, Excel, etc.)
  protected async apiCallBlob(
    endpoint: string,
    options: RequestInit = {}
  ): Promise<ApiResponse<Blob>> {
    try {
      const url = `${this.baseUrl}${endpoint}`;

      const response = await fetch(url, {
        ...options,
        headers: {
          ...this.getAuthHeaders(),
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
      console.error("API call failed:", error);
      return {
        success: false,
        error:
          error instanceof Error ? error.message : "Unknown error occurred",
      };
    }
  }
}
