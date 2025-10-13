import { useState, useEffect, useCallback } from "react";
import { useDataStore } from "./dataStore";

// Types matching backend DTOs
interface Logement {
  infosLogement: {
    Logement: {
      PkLogement: number;
      Ref?: string;
      NumOrdre: string;
      NumBatiment: string;
      NumEscalier: string;
      NumEtage: string;
    };
    Occupant: {
      Ref: string;
      Nom: string;
    };
    NbFuites: number;
    NbAnomalies: number;
    NbDysfonctionnements: number;
    NbDepannages: number;
    NbCompteursEF: number;
    NbCompteursEC: number;
    NbCompteursRepart: number;
    NbCompteursCET: number;
    NbCompteursElect: number;
    NbCompteursGaz: number;
    TicketsInterEnabled: boolean;
    NbTicketsInter: number;
  };
}

interface Indicator {
  pkLogement: number;
  [key: string]: any; // Flexible structure for different indicator types
}

interface UseLogementsReturn {
  // Logements data (sync)
  logements: Logement[];
  logementsLoading: boolean;
  logementsError: string | null;

  // Indicators data (async)
  indicators: Indicator[];
  indicatorsLoading: boolean;
  indicatorsError: string | null;

  // Combined loading state
  loading: boolean;
  error: string | null;

  // Actions
  refetch: () => void;
  refetchLogements: () => void;
  refetchIndicators: () => void;
}

// Cache for indicators data
let indicatorsCache: Indicator[] | null = null;
let indicatorsCacheTime: number = 0;
const CACHE_DURATION = 5 * 60 * 1000; // 5 minutes

export const useLogements = (immeubleId?: string): UseLogementsReturn => {
  const { loginData } = useDataStore();

  // Logements state (sync)
  const [logements, setLogements] = useState<Logement[]>([]);
  const [logementsLoading, setLogementsLoading] = useState(false);
  const [logementsError, setLogementsError] = useState<string | null>(null);

  // Indicators state (async)
  const [indicators, setIndicators] = useState<Indicator[]>([]);
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

      const data = await response.json();
      setLogements(data.logementDto || []);
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
  }, [loginData?.tokenJwt, immeubleId, getAuthHeaders]);

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
    const now = Date.now();
    const cacheKey = `logements-indicators-${immeubleId}`;
    if (indicatorsCache && now - indicatorsCacheTime < CACHE_DURATION) {
      setIndicators(indicatorsCache);
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

      const data = await response.json();
      const indicatorsData = data.indicators || [];

      // Update cache
      indicatorsCache = indicatorsData;
      indicatorsCacheTime = now;

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
  }, [loginData?.tokenJwt, immeubleId, getAuthHeaders]);

  // Combined refetch
  const refetch = useCallback(() => {
    fetchLogements();
    fetchIndicators();
  }, [fetchLogements, fetchIndicators]);

  // Individual refetch functions
  const refetchLogements = useCallback(() => {
    fetchLogements();
  }, [fetchLogements]);

  const refetchIndicators = useCallback(() => {
    // Clear cache to force fresh fetch
    indicatorsCache = null;
    indicatorsCacheTime = 0;
    fetchIndicators();
  }, [fetchIndicators]);

  // Initial load
  useEffect(() => {
    if (loginData?.tokenJwt) {
      // Start with logements (sync)
      fetchLogements();

      // Then indicators (async)
      fetchIndicators();
    }
  }, [loginData?.tokenJwt, immeubleId, fetchLogements, fetchIndicators]);

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

    // Actions
    refetch,
    refetchLogements,
    refetchIndicators,
  };
};
