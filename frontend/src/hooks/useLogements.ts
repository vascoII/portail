import { useState, useEffect, useCallback } from "react";
import { useDataStore } from "@/store/dataStore";

// Types matching backend DTOs exactly
export interface Logement {
  pkLogement: number;
  numBatiment: string;
  adrBatiment: string;
  numEscalier: string;
  adrEscalier: string;
  numEtage: string;
  numOrdre: string;
  type: string;
}

// Response wrapper type
interface ListLogementsResponse {
  listLogementDto: Logement[];
}

// Types matching backend DTOs exactly
export interface Appareil {
  PkAppareil: number;
  Numero: string;
  Emplacement: string;
  Fluide: string;
  TypeAppareil: string;
  Unite: string;
}

export interface ListeAppareils {
  appareil: Appareil | Appareil[];
}

export interface LogementIndicator {
  pkImmeuble: number;
  pkLogement: number;
  nbAppareils: number;
  nbCompteursEC: number;
  nbCompteursEF: number;
  nbCompteursRepart: number;
  nbCompteursCET: number;
  nbCompteursCapteur: number;
  nbCompteursElect: number;
  nbCompteursGaz: number;
  nbFuites: number;
  nbDepannages: number;
  nbDysfonctionnements: number;
  nbAnomalies: number;
  nbTicketsInter: number;
  ticketsInterEnabled: boolean;
  listeAppareils: ListeAppareils;
}

// Response wrapper type
interface ListLogementsIndicatorsResponse {
  indicators: LogementIndicator[];
}

interface UseLogementsReturn {
  // Logements data (sync)
  logements: Logement[];
  logementsLoading: boolean;
  logementsError: string | null;

  // Indicators data (async)
  indicators: LogementIndicator[];
  indicatorsLoading: boolean;
  indicatorsError: string | null;

  // Combined loading state
  loading: boolean;
  error: string | null;

  // Helper functions
  getIndicatorsForLogement: (
    pkLogement: number
  ) => LogementIndicator | undefined;

  // Actions
  refetch: () => void;
  refetchLogements: () => void;
  refetchIndicators: () => void;
}

// Cache is now handled by the dataStore

export const useLogements = (immeubleId?: string): UseLogementsReturn => {
  const {
    loginData,
    logementsCache,
    setLogementsLogements,
    setLogementsIndicators,
  } = useDataStore();

  // Logements state (sync)
  const [logements, setLogements] = useState<Logement[]>([]);
  const [logementsLoading, setLogementsLoading] = useState(false);
  const [logementsError, setLogementsError] = useState<string | null>(null);

  // Indicators state (async)
  const [indicators, setIndicators] = useState<LogementIndicator[]>([]);
  const [indicatorsLoading, setIndicatorsLoading] = useState(false);
  const [indicatorsError, setIndicatorsError] = useState<string | null>(null);

  // Helper function to get auth headers
  const getAuthHeaders = useCallback(() => {
    if (!loginData?.tokenJwt) {
      throw new Error("No authentication token available");
    }
    return {
      Authorization: `Bearer ${loginData.tokenJwt}`,
      "Content-Type": "application/json",
    };
  }, [loginData?.tokenJwt]);

  // Fetch logements (sync call)
  const fetchLogements = useCallback(async () => {
    if (!loginData?.tokenJwt) {
      setLogementsError("No authentication token available");
      return;
    }

    if (!immeubleId) {
      setLogementsError("Immeuble ID is required");
      return;
    }

    // Check cache first
    if (logementsCache.logements && logementsCache.logements.data) {
      setLogements(logementsCache.logements.data);
      setLogementsLoading(false);
      return;
    }

    setLogementsLoading(true);
    setLogementsError(null);

    try {
      const response = await fetch(
        `http://localhost:8000/api/immeuble/${immeubleId}/logements`,
        {
          method: "GET",
          headers: getAuthHeaders(),
        }
      );

      if (!response.ok) {
        throw new Error(
          `Failed to fetch logements: ${response.status} ${response.statusText}`
        );
      }

      const data: ListLogementsResponse = await response.json();
      const logementsData = data.listLogementDto || [];

      // Cache the data
      setLogementsLogements(logementsData);
      setLogements(logementsData);
    } catch (err) {
      const errorMessage =
        err instanceof Error
          ? err.message
          : "An error occurred while fetching logements";
      setLogementsError(errorMessage);
      console.error("Logements fetch error:", err);
    } finally {
      setLogementsLoading(false);
    }
  }, [
    loginData?.tokenJwt,
    immeubleId,
    getAuthHeaders,
    logementsCache.logements,
    setLogementsLogements,
  ]);

  // Fetch indicators (async call with caching)
  const fetchIndicators = useCallback(async () => {
    if (!loginData?.tokenJwt) {
      setIndicatorsError("No authentication token available");
      return;
    }

    if (!immeubleId) {
      setIndicatorsError("Immeuble ID is required");
      return;
    }

    // Check cache first
    if (logementsCache.indicators && logementsCache.indicators.data) {
      setIndicators(logementsCache.indicators.data);
      setIndicatorsLoading(false);
      return;
    }

    setIndicatorsLoading(true);
    setIndicatorsError(null);

    try {
      const response = await fetch(
        `http://localhost:8000/api/immeuble/${immeubleId}/logements_indicators`,
        {
          method: "GET",
          headers: getAuthHeaders(),
        }
      );

      if (!response.ok) {
        throw new Error(
          `Failed to fetch indicators: ${response.status} ${response.statusText}`
        );
      }

      const data: ListLogementsIndicatorsResponse = await response.json();
      const indicatorsData = data.indicators || [];

      // Cache the data
      setLogementsIndicators(indicatorsData);
      setIndicators(indicatorsData);
    } catch (err) {
      const errorMessage =
        err instanceof Error
          ? err.message
          : "An error occurred while fetching indicators";
      setIndicatorsError(errorMessage);
      console.error("Indicators fetch error:", err);
    } finally {
      setIndicatorsLoading(false);
    }
  }, [
    loginData?.tokenJwt,
    immeubleId,
    getAuthHeaders,
    logementsCache.indicators,
    setLogementsIndicators,
  ]);

  // Combined refetch
  const refetch = useCallback(() => {
    // Clear both caches to force fresh fetch
    setLogementsLogements([]);
    setLogementsIndicators([]);
    fetchLogements();
    fetchIndicators();
  }, [
    fetchLogements,
    fetchIndicators,
    setLogementsLogements,
    setLogementsIndicators,
  ]);

  // Individual refetch functions
  const refetchLogements = useCallback(() => {
    fetchLogements();
  }, [fetchLogements]);

  const refetchIndicators = useCallback(() => {
    // Clear cache to force fresh fetch
    setLogementsIndicators([]);
    fetchIndicators();
  }, [fetchIndicators, setLogementsIndicators]);

  // Initial load
  useEffect(() => {
    if (loginData?.tokenJwt) {
      // Start with logements (sync)
      fetchLogements();

      // Then indicators (async)
      fetchIndicators();
    }
  }, [loginData?.tokenJwt, immeubleId, fetchLogements, fetchIndicators]);

  // Helper function to get indicators for a specific logement
  const getIndicatorsForLogement = useCallback(
    (pkLogement: number): LogementIndicator | undefined => {
      return indicators.find(
        (indicator) => indicator.pkLogement === pkLogement
      );
    },
    [indicators]
  );

  // Computed states
  const loading = logementsLoading || indicatorsLoading;
  const error = logementsError || indicatorsError;

  return {
    // Logements data
    logements,
    logementsLoading,
    logementsError,

    // Indicators data
    indicators,
    indicatorsLoading,
    indicatorsError,

    // Combined states
    loading,
    error,

    // Helper functions
    getIndicatorsForLogement,

    // Actions
    refetch,
    refetchLogements,
    refetchIndicators,
  };
};
