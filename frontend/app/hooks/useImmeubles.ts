import { useState, useEffect, useCallback } from "react";
import { useDataStore } from "../store/dataStore";

// Types matching backend DTOs
interface Immeuble {
  Immeuble: {
    PkImmeuble: number;
    Ref: string;
    Numero: string;
    Nom?: string;
    Adresse1: string;
    Adresse2?: string;
    Adresse3?: string;
    Cp: string;
    Ville: string;
  };
  NbLogements: number;
  NbAppareils: number;
  NbCompteursEF: number;
  NbCompteursEC: number;
  NbCompteursRepart: number;
  NbCompteursCET: number;
  NbCompteursElect: number;
  NbCompteursGaz: number;
  NbFuites: number;
  NbAnomalies: number;
  NbDysfonctionnements: number;
  NbDepannages: number;
  NbChantiers: number;
}

interface Indicator {
  pkImmeuble: number;
  [key: string]: any; // Flexible structure for different indicator types
}

interface UseImmeublesReturn {
  // Buildings data (sync)
  immeubles: Immeuble[];
  buildingsLoading: boolean;
  buildingsError: string | null;

  // Indicators data (async)
  indicators: Indicator[];
  indicatorsLoading: boolean;
  indicatorsError: string | null;

  // Combined loading state
  loading: boolean;
  error: string | null;

  // Actions
  refetch: () => void;
  refetchBuildings: () => void;
  refetchIndicators: () => void;
}

// Cache is now handled by the dataStore

export const useImmeubles = (): UseImmeublesReturn => {
  const {
    loginData,
    immeublesCache,
    setImmeublesBuildings,
    setImmeublesIndicators,
  } = useDataStore();

  // Buildings state (sync)
  const [immeubles, setImmeubles] = useState<Immeuble[]>([]);
  const [buildingsLoading, setBuildingsLoading] = useState(false);
  const [buildingsError, setBuildingsError] = useState<string | null>(null);

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

  // Fetch buildings (sync call)
  const fetchBuildings = useCallback(async () => {
    if (!loginData?.tokenJwt) {
      setBuildingsError("No authentication token available");
      return;
    }

    // Check cache first
    if (immeublesCache.buildings && immeublesCache.buildings.data) {
      setImmeubles(immeublesCache.buildings.data);
      setBuildingsLoading(false);
      return;
    }

    setBuildingsLoading(true);
    setBuildingsError(null);

    try {
      const response = await fetch("http://localhost:8000/api/immeubles", {
        method: "GET",
        headers: getAuthHeaders(),
      });

      if (!response.ok) {
        throw new Error(
          `Failed to fetch buildings: ${response.status} ${response.statusText}`
        );
      }

      const data = await response.json();
      const buildingsData = data.immeubleDto || [];

      // Cache the data
      setImmeublesBuildings(buildingsData);
      setImmeubles(buildingsData);
    } catch (err) {
      const errorMessage =
        err instanceof Error
          ? err.message
          : "An error occurred while fetching buildings";
      setBuildingsError(errorMessage);
      console.error("Buildings fetch error:", err);
    } finally {
      setBuildingsLoading(false);
    }
  }, [
    loginData?.tokenJwt,
    getAuthHeaders,
    immeublesCache.buildings,
    setImmeublesBuildings,
  ]);

  // Fetch indicators (async call with caching)
  const fetchIndicators = useCallback(async () => {
    if (!loginData?.tokenJwt) {
      setIndicatorsError("No authentication token available");
      return;
    }

    // Check cache first
    if (immeublesCache.indicators && immeublesCache.indicators.data) {
      setIndicators(immeublesCache.indicators.data);
      setIndicatorsLoading(false);
      return;
    }

    setIndicatorsLoading(true);
    setIndicatorsError(null);

    try {
      const response = await fetch(
        "http://localhost:8000/api/immeubles_indicators",
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

      // Cache the data
      setImmeublesIndicators(indicatorsData);
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
    getAuthHeaders,
    immeublesCache.indicators,
    setImmeublesIndicators,
  ]);

  // Combined refetch
  const refetch = useCallback(() => {
    // Clear both caches to force fresh fetch
    setImmeublesBuildings([]);
    setImmeublesIndicators([]);
    fetchBuildings();
    fetchIndicators();
  }, [
    fetchBuildings,
    fetchIndicators,
    setImmeublesBuildings,
    setImmeublesIndicators,
  ]);

  // Individual refetch functions
  const refetchBuildings = useCallback(() => {
    fetchBuildings();
  }, [fetchBuildings]);

  const refetchIndicators = useCallback(() => {
    // Clear cache to force fresh fetch
    setImmeublesIndicators([]);
    fetchIndicators();
  }, [fetchIndicators, setImmeublesIndicators]);

  // Initial load
  useEffect(() => {
    if (loginData?.tokenJwt) {
      // Start with buildings (sync)
      fetchBuildings();

      // Then indicators (async)
      fetchIndicators();
    }
  }, [loginData?.tokenJwt, fetchBuildings, fetchIndicators]);

  // Computed states
  const loading = buildingsLoading || indicatorsLoading;
  const error = buildingsError || indicatorsError;

  return {
    // Buildings data
    immeubles,
    buildingsLoading,
    buildingsError,

    // Indicators data
    indicators,
    indicatorsLoading,
    indicatorsError,

    // Combined states
    loading,
    error,

    // Actions
    refetch,
    refetchBuildings,
    refetchIndicators,
  };
};
