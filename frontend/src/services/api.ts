import config from "@/config";
import type {
  ApiResponse,
  ParcData,
  UserData,
  ImmeubleDto,
  InterventionDto,
  AnomalieDto,
  FuiteDto,
  DysfonctionnementDto,
  LogementDto,
  CompteurDto,
  FilterOptions,
  PaginationParams,
  PaginatedResponse,
} from "@/types/api";

class ApiService {
  private baseUrl: string;
  private token: string | null = null;

  constructor() {
    this.baseUrl = config.apiUrl;
  }

  // Set authentication token
  setAuthToken(token: string | null) {
    this.token = token;
  }

  // Get authentication headers
  private getAuthHeaders(): HeadersInit {
    const headers: HeadersInit = {
      "Content-Type": "application/json",
    };

    if (this.token) {
      headers["Authorization"] = `Bearer ${this.token}`;
    }

    return headers;
  }

  // Generic API call method with proper error handling
  private async apiCall<T>(
    endpoint: string,
    options: RequestInit = {}
  ): Promise<ApiResponse<T>> {
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

  // Parc Data Methods
  async getParcData(): Promise<ApiResponse<ParcData>> {
    return this.apiCall<ParcData>("/api/parc");
  }

  // User Methods
  async getCurrentUser(): Promise<ApiResponse<UserData>> {
    return this.apiCall<UserData>("/api/security/me");
  }

  // Building Methods
  async getImmeubles(
    filters?: FilterOptions,
    pagination?: PaginationParams
  ): Promise<ApiResponse<PaginatedResponse<ImmeubleDto>>> {
    const params = new URLSearchParams();

    if (filters) {
      if (filters.immeubles) {
        filters.immeubles.forEach((id) =>
          params.append("immeubles", id.toString())
        );
      }
      if (filters.statuts) {
        filters.statuts.forEach((statut) => params.append("statuts", statut));
      }
      if (filters.dateDebut) params.append("dateDebut", filters.dateDebut);
      if (filters.dateFin) params.append("dateFin", filters.dateFin);
    }

    if (pagination) {
      params.append("page", pagination.page.toString());
      params.append("limit", pagination.limit.toString());
      if (pagination.sortBy) params.append("sortBy", pagination.sortBy);
      if (pagination.sortOrder)
        params.append("sortOrder", pagination.sortOrder);
    }

    const queryString = params.toString();
    const endpoint = queryString
      ? `/api/immeubles?${queryString}`
      : "/api/immeubles";

    return this.apiCall<PaginatedResponse<ImmeubleDto>>(endpoint);
  }

  async getImmeubleById(id: number): Promise<ApiResponse<ImmeubleDto>> {
    return this.apiCall<ImmeubleDto>(`/api/immeubles/${id}`);
  }

  // Logement Methods
  async getLogementsByImmeuble(
    immeubleId: number,
    filters?: FilterOptions
  ): Promise<ApiResponse<LogementDto[]>> {
    const params = new URLSearchParams();

    if (filters) {
      if (filters.logements) {
        filters.logements.forEach((id) =>
          params.append("logements", id.toString())
        );
      }
      if (filters.types) {
        filters.types.forEach((type) => params.append("types", type));
      }
    }

    const queryString = params.toString();
    const endpoint = queryString
      ? `/api/immeubles/${immeubleId}/logements?${queryString}`
      : `/api/immeubles/${immeubleId}/logements`;

    return this.apiCall<LogementDto[]>(endpoint);
  }

  // Intervention Methods
  async getInterventionsByImmeuble(
    immeubleId: number,
    filters?: FilterOptions,
    pagination?: PaginationParams
  ): Promise<ApiResponse<PaginatedResponse<InterventionDto>>> {
    const params = new URLSearchParams();

    if (filters) {
      if (filters.types) {
        filters.types.forEach((type) => params.append("types", type));
      }
      if (filters.statuts) {
        filters.statuts.forEach((statut) => params.append("statuts", statut));
      }
      if (filters.dateDebut) params.append("dateDebut", filters.dateDebut);
      if (filters.dateFin) params.append("dateFin", filters.dateFin);
    }

    if (pagination) {
      params.append("page", pagination.page.toString());
      params.append("limit", pagination.limit.toString());
      if (pagination.sortBy) params.append("sortBy", pagination.sortBy);
      if (pagination.sortOrder)
        params.append("sortOrder", pagination.sortOrder);
    }

    const queryString = params.toString();
    const endpoint = queryString
      ? `/api/immeubles/${immeubleId}/interventions?${queryString}`
      : `/api/immeubles/${immeubleId}/interventions`;

    return this.apiCall<PaginatedResponse<InterventionDto>>(endpoint);
  }

  // Anomaly Methods
  async getAnomaliesByImmeuble(
    immeubleId: number,
    filters?: FilterOptions,
    pagination?: PaginationParams
  ): Promise<ApiResponse<PaginatedResponse<AnomalieDto>>> {
    const params = new URLSearchParams();

    if (filters) {
      if (filters.types) {
        filters.types.forEach((type) => params.append("types", type));
      }
      if (filters.statuts) {
        filters.statuts.forEach((statut) => params.append("statuts", statut));
      }
      if (filters.dateDebut) params.append("dateDebut", filters.dateDebut);
      if (filters.dateFin) params.append("dateFin", filters.dateFin);
    }

    if (pagination) {
      params.append("page", pagination.page.toString());
      params.append("limit", pagination.limit.toString());
      if (pagination.sortBy) params.append("sortBy", pagination.sortBy);
      if (pagination.sortOrder)
        params.append("sortOrder", pagination.sortOrder);
    }

    const queryString = params.toString();
    const endpoint = queryString
      ? `/api/immeubles/${immeubleId}/anomalies?${queryString}`
      : `/api/immeubles/${immeubleId}/anomalies`;

    return this.apiCall<PaginatedResponse<AnomalieDto>>(endpoint);
  }

  // Leak Methods
  async getFuitesByImmeuble(
    immeubleId: number,
    filters?: FilterOptions,
    pagination?: PaginationParams
  ): Promise<ApiResponse<PaginatedResponse<FuiteDto>>> {
    const params = new URLSearchParams();

    if (filters) {
      if (filters.types) {
        filters.types.forEach((type) => params.append("types", type));
      }
      if (filters.statuts) {
        filters.statuts.forEach((statut) => params.append("statuts", statut));
      }
      if (filters.dateDebut) params.append("dateDebut", filters.dateDebut);
      if (filters.dateFin) params.append("dateFin", filters.dateFin);
    }

    if (pagination) {
      params.append("page", pagination.page.toString());
      params.append("limit", pagination.limit.toString());
      if (pagination.sortBy) params.append("sortBy", pagination.sortBy);
      if (pagination.sortOrder)
        params.append("sortOrder", pagination.sortOrder);
    }

    const queryString = params.toString();
    const endpoint = queryString
      ? `/api/immeubles/${immeubleId}/fuites?${queryString}`
      : `/api/immeubles/${immeubleId}/fuites`;

    return this.apiCall<PaginatedResponse<FuiteDto>>(endpoint);
  }

  // Dysfunction Methods
  async getDysfonctionnementsByImmeuble(
    immeubleId: number,
    filters?: FilterOptions,
    pagination?: PaginationParams
  ): Promise<ApiResponse<PaginatedResponse<DysfonctionnementDto>>> {
    const params = new URLSearchParams();

    if (filters) {
      if (filters.types) {
        filters.types.forEach((type) => params.append("types", type));
      }
      if (filters.statuts) {
        filters.statuts.forEach((statut) => params.append("statuts", statut));
      }
      if (filters.dateDebut) params.append("dateDebut", filters.dateDebut);
      if (filters.dateFin) params.append("dateFin", filters.dateFin);
    }

    if (pagination) {
      params.append("page", pagination.page.toString());
      params.append("limit", pagination.limit.toString());
      if (pagination.sortBy) params.append("sortBy", pagination.sortBy);
      if (pagination.sortOrder)
        params.append("sortOrder", pagination.sortOrder);
    }

    const queryString = params.toString();
    const endpoint = queryString
      ? `/api/immeubles/${immeubleId}/dysfonctionnements?${queryString}`
      : `/api/immeubles/${immeubleId}/dysfonctionnements`;

    return this.apiCall<PaginatedResponse<DysfonctionnementDto>>(endpoint);
  }

  // Compteur Methods
  async getCompteursByLogement(
    logementId: number,
    type?: string
  ): Promise<ApiResponse<CompteurDto[]>> {
    const params = new URLSearchParams();
    if (type) params.append("type", type);

    const queryString = params.toString();
    const endpoint = queryString
      ? `/api/logements/${logementId}/compteurs?${queryString}`
      : `/api/logements/${logementId}/compteurs`;

    return this.apiCall<CompteurDto[]>(endpoint);
  }

  // Report Generation Methods (TODO: Backend endpoints)
  async generateInterventionReport(
    docType: "synthese-inte" | "detail-inte" | "detail-excel-inte",
    dateBegin: string,
    dateEnd: string
  ): Promise<ApiResponse<Blob>> {
    // TODO: Implement when backend endpoint is available
    const params = new URLSearchParams({
      "doc-type": docType,
      "date-begin": dateBegin,
      "date-end": dateEnd,
    });

    const endpoint = `/api/intervention?${params.toString()}`;

    try {
      const response = await fetch(`${this.baseUrl}${endpoint}`, {
        headers: this.getAuthHeaders(),
      });

      if (!response.ok) {
        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
      }

      const blob = await response.blob();
      return {
        success: true,
        data: blob,
      };
    } catch (error) {
      return {
        success: false,
        error:
          error instanceof Error ? error.message : "Unknown error occurred",
      };
    }
  }
}

// Create singleton instance
export const apiService = new ApiService();

// Export types for use in components
export type {
  ApiResponse,
  ParcData,
  UserData,
  ImmeubleDto,
  InterventionDto,
  AnomalieDto,
  FuiteDto,
  DysfonctionnementDto,
  LogementDto,
  CompteurDto,
  FilterOptions,
  PaginationParams,
  PaginatedResponse,
};
