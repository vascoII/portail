import config from "@/src/config";
import type { ApiResponse } from "@/types/api";

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

