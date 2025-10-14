import { useState, useEffect, useCallback } from "react";
import { useDataStore } from "../store/dataStore";

// Types matching backend DTOs
interface Immeuble {
  pkImmeuble: number;
  ref: string;
  numero: string;
  nom?: string;
  adresse1: string;
  adresse2?: string;
  adresse3?: string;
  cp: string;
  ville: string;
  hasTelereleve?: boolean;
  hasTransfertFichiers?: boolean;
  nbLogements: number;
  nbAppareils: number;
  nbCompteursEF: number;
  nbCompteursEC: number;
  nbCompteursRepart: number;
  nbCompteursCET: number;
  nbCompteursElect: number;
  nbCompteursGaz: number;
  nbCompteursCapteur: number;
  nbFuites: number;
  nbAnomalies: number;
  nbDysfonctionnements: number;
  nbDepannages: number;
  nbDepannagesTotal: number;
  nbChantiers: number;
}

interface AsyncData {
  [key: string]: unknown;
}

interface UseImmeubleReturn {
  // Main immeuble data (sync)
  immeuble: Immeuble | null;
  immeubleLoading: boolean;
  immeubleError: string | null;

  // Async data sections
  capteur: AsyncData | null;
  capteurLoading: boolean;
  capteurError: string | null;

  cet: AsyncData | null;
  cetLoading: boolean;
  cetError: string | null;

  ec: AsyncData | null;
  ecLoading: boolean;
  ecError: string | null;

  ef: AsyncData | null;
  efLoading: boolean;
  efError: string | null;

  elect: AsyncData | null;
  electLoading: boolean;
  electError: string | null;

  gaz: AsyncData | null;
  gazLoading: boolean;
  gazError: string | null;

  indicators: AsyncData | null;
  indicatorsLoading: boolean;
  indicatorsError: string | null;

  repart: AsyncData | null;
  repartLoading: boolean;
  repartError: string | null;

  serieConsosCompteurGeneral: AsyncData | null;
  serieConsosCompteurGeneralLoading: boolean;
  serieConsosCompteurGeneralError: string | null;

  serieConsosEau: AsyncData | null;
  serieConsosEauLoading: boolean;
  serieConsosEauError: string | null;

  anomalies: AsyncData | null;
  anomaliesLoading: boolean;
  anomaliesError: string | null;

  dysfonctionnements: AsyncData | null;
  dysfonctionnementsLoading: boolean;
  dysfonctionnementsError: string | null;

  fuites: AsyncData | null;
  fuitesLoading: boolean;
  fuitesError: string | null;

  // Combined states
  loading: boolean;
  error: string | null;

  // Actions
  refetch: () => void;
  refetchImmeuble: () => void;
  refetchAsyncData: (dataType: string) => void;
}

// Cache is now handled by the dataStore

export const useImmeuble = (immeubleId: number): UseImmeubleReturn => {
  const { loginData, singleImmeubleCache, setSingleImmeubleData } =
    useDataStore();

  // Main immeuble state (sync)
  const [immeuble, setImmeuble] = useState<Immeuble | null>(null);
  const [immeubleLoading, setImmeubleLoading] = useState(false);
  const [immeubleError, setImmeubleError] = useState<string | null>(null);

  // Async data states
  const [capteur, setCapteur] = useState<AsyncData | null>(null);
  const [capteurLoading, setCapteurLoading] = useState(false);
  const [capteurError, setCapteurError] = useState<string | null>(null);

  const [cet, setCet] = useState<AsyncData | null>(null);
  const [cetLoading, setCetLoading] = useState(false);
  const [cetError, setCetError] = useState<string | null>(null);

  const [ec, setEc] = useState<AsyncData | null>(null);
  const [ecLoading, setEcLoading] = useState(false);
  const [ecError, setEcError] = useState<string | null>(null);

  const [ef, setEf] = useState<AsyncData | null>(null);
  const [efLoading, setEfLoading] = useState(false);
  const [efError, setEfError] = useState<string | null>(null);

  const [elect, setElect] = useState<AsyncData | null>(null);
  const [electLoading, setElectLoading] = useState(false);
  const [electError, setElectError] = useState<string | null>(null);

  const [gaz, setGaz] = useState<AsyncData | null>(null);
  const [gazLoading, setGazLoading] = useState(false);
  const [gazError, setGazError] = useState<string | null>(null);

  const [indicators, setIndicators] = useState<AsyncData | null>(null);
  const [indicatorsLoading, setIndicatorsLoading] = useState(false);
  const [indicatorsError, setIndicatorsError] = useState<string | null>(null);

  const [repart, setRepart] = useState<AsyncData | null>(null);
  const [repartLoading, setRepartLoading] = useState(false);
  const [repartError, setRepartError] = useState<string | null>(null);

  const [serieConsosCompteurGeneral, setSerieConsosCompteurGeneral] =
    useState<AsyncData | null>(null);
  const [
    serieConsosCompteurGeneralLoading,
    setSerieConsosCompteurGeneralLoading,
  ] = useState(false);
  const [serieConsosCompteurGeneralError, setSerieConsosCompteurGeneralError] =
    useState<string | null>(null);

  const [serieConsosEau, setSerieConsosEau] = useState<AsyncData | null>(null);
  const [serieConsosEauLoading, setSerieConsosEauLoading] = useState(false);
  const [serieConsosEauError, setSerieConsosEauError] = useState<string | null>(
    null
  );

  const [anomalies, setAnomalies] = useState<AsyncData | null>(null);
  const [anomaliesLoading, setAnomaliesLoading] = useState(false);
  const [anomaliesError, setAnomaliesError] = useState<string | null>(null);

  const [dysfonctionnements, setDysfonctionnements] =
    useState<AsyncData | null>(null);
  const [dysfonctionnementsLoading, setDysfonctionnementsLoading] =
    useState(false);
  const [dysfonctionnementsError, setDysfonctionnementsError] = useState<
    string | null
  >(null);

  const [fuites, setFuites] = useState<AsyncData | null>(null);
  const [fuitesLoading, setFuitesLoading] = useState(false);
  const [fuitesError, setFuitesError] = useState<string | null>(null);

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

  // Generic async data fetcher with daily caching
  const fetchAsyncData = useCallback(
    async (
      endpoint: string,
      dataType: string,
      setData: (data: AsyncData | null) => void,
      setLoading: (loading: boolean) => void,
      setError: (error: string | null) => void
    ) => {
      if (!loginData?.tokenJwt) {
        setError("No authentication token available");
        return;
      }

      // Check cache first
      const cacheKey = immeubleId.toString();
      if (singleImmeubleCache[cacheKey]?.[dataType]?.data) {
        setData(singleImmeubleCache[cacheKey]![dataType]!.data);
        setLoading(false);
        return;
      }

      setLoading(true);
      setError(null);

      try {
        const response = await fetch(`http://localhost:8000${endpoint}`, {
          method: "GET",
          headers: getAuthHeaders(),
        });

        if (!response.ok) {
          throw new Error(
            `Failed to fetch ${dataType}: ${response.status} ${response.statusText}`
          );
        }

        const data = await response.json();
        const result = data.indicators || data;

        // Cache the data
        setSingleImmeubleData(cacheKey, dataType, result);
        setData(result);
      } catch (err) {
        const errorMessage =
          err instanceof Error
            ? err.message
            : `An error occurred while fetching ${dataType}`;
        setError(errorMessage);
        console.error(`${dataType} fetch error:`, err);
      } finally {
        setLoading(false);
      }
    },
    [
      loginData?.tokenJwt,
      immeubleId,
      getAuthHeaders,
      singleImmeubleCache,
      setSingleImmeubleData,
    ]
  );

  // Fetch main immeuble data (sync)
  const fetchImmeuble = useCallback(async () => {
    if (!loginData?.tokenJwt) {
      setImmeubleError("No authentication token available");
      return;
    }

    // Check cache first
    const cacheKey = immeubleId.toString();
    if (singleImmeubleCache[cacheKey]?.immeuble?.data) {
      setImmeuble(singleImmeubleCache[cacheKey]!.immeuble!.data);
      setImmeubleLoading(false);
      return;
    }

    setImmeubleLoading(true);
    setImmeubleError(null);

    try {
      const response = await fetch(
        `http://localhost:8000/api/immeuble/${immeubleId}`,
        {
          method: "GET",
          headers: getAuthHeaders(),
        }
      );

      if (!response.ok) {
        throw new Error(
          `Failed to fetch immeuble: ${response.status} ${response.statusText}`
        );
      }

      const data = await response.json();

      // Cache the data
      setSingleImmeubleData(cacheKey, "immeuble", data);
      setImmeuble(data);
    } catch (err) {
      const errorMessage =
        err instanceof Error
          ? err.message
          : "An error occurred while fetching immeuble";
      setImmeubleError(errorMessage);
      console.error("Immeuble fetch error:", err);
    } finally {
      setImmeubleLoading(false);
    }
  }, [
    loginData?.tokenJwt,
    immeubleId,
    getAuthHeaders,
    singleImmeubleCache,
    setSingleImmeubleData,
  ]);

  // Fetch all async data
  const fetchAllAsyncData = useCallback(() => {
    // Start all async calls simultaneously
    fetchAsyncData(
      `/api/immeuble_capteur/${immeubleId}`,
      "capteur",
      setCapteur,
      setCapteurLoading,
      setCapteurError
    );

    fetchAsyncData(
      `/api/immeuble_cet/${immeubleId}`,
      "cet",
      setCet,
      setCetLoading,
      setCetError
    );

    fetchAsyncData(
      `/api/immeuble_ec/${immeubleId}`,
      "ec",
      setEc,
      setEcLoading,
      setEcError
    );

    fetchAsyncData(
      `/api/immeuble_ef/${immeubleId}`,
      "ef",
      setEf,
      setEfLoading,
      setEfError
    );

    fetchAsyncData(
      `/api/immeuble_elect/${immeubleId}`,
      "elect",
      setElect,
      setElectLoading,
      setElectError
    );

    fetchAsyncData(
      `/api/immeuble_gaz/${immeubleId}`,
      "gaz",
      setGaz,
      setGazLoading,
      setGazError
    );

    fetchAsyncData(
      `/api/immeuble_indicators/${immeubleId}`,
      "indicators",
      setIndicators,
      setIndicatorsLoading,
      setIndicatorsError
    );

    fetchAsyncData(
      `/api/immeuble_repart/${immeubleId}`,
      "repart",
      setRepart,
      setRepartLoading,
      setRepartError
    );

    fetchAsyncData(
      `/api/immeuble_serie_consos_compteur_general/${immeubleId}`,
      "serieConsosCompteurGeneral",
      setSerieConsosCompteurGeneral,
      setSerieConsosCompteurGeneralLoading,
      setSerieConsosCompteurGeneralError
    );

    fetchAsyncData(
      `/api/immeuble_serie_conso_eau/${immeubleId}`,
      "serieConsosEau",
      setSerieConsosEau,
      setSerieConsosEauLoading,
      setSerieConsosEauError
    );

    fetchAsyncData(
      `/api/immeuble/${immeubleId}/anomalies`,
      "anomalies",
      setAnomalies,
      setAnomaliesLoading,
      setAnomaliesError
    );

    fetchAsyncData(
      `/api/immeuble/${immeubleId}/dysfonctionnements`,
      "dysfonctionnements",
      setDysfonctionnements,
      setDysfonctionnementsLoading,
      setDysfonctionnementsError
    );

    fetchAsyncData(
      `/api/immeuble/${immeubleId}/fuites`,
      "fuites",
      setFuites,
      setFuitesLoading,
      setFuitesError
    );
  }, [fetchAsyncData, immeubleId]);

  // Combined refetch
  const refetch = useCallback(() => {
    // Clear all caches for this immeuble
    const cacheKey = immeubleId.toString();
    setSingleImmeubleData(cacheKey, "immeuble", null);
    setSingleImmeubleData(cacheKey, "capteur", null);
    setSingleImmeubleData(cacheKey, "cet", null);
    setSingleImmeubleData(cacheKey, "ec", null);
    setSingleImmeubleData(cacheKey, "ef", null);
    setSingleImmeubleData(cacheKey, "elect", null);
    setSingleImmeubleData(cacheKey, "gaz", null);
    setSingleImmeubleData(cacheKey, "indicators", null);
    setSingleImmeubleData(cacheKey, "repart", null);
    setSingleImmeubleData(cacheKey, "serieConsosCompteurGeneral", null);
    setSingleImmeubleData(cacheKey, "serieConsosEau", null);
    setSingleImmeubleData(cacheKey, "anomalies", null);
    setSingleImmeubleData(cacheKey, "dysfonctionnements", null);
    setSingleImmeubleData(cacheKey, "fuites", null);

    fetchImmeuble();
    fetchAllAsyncData();
  }, [fetchImmeuble, fetchAllAsyncData, immeubleId, setSingleImmeubleData]);

  // Individual refetch functions
  const refetchImmeuble = useCallback(() => {
    fetchImmeuble();
  }, [fetchImmeuble]);

  const refetchAsyncData = useCallback(
    (dataType: string) => {
      // Clear cache for specific data type by setting empty data
      const cacheKey = immeubleId.toString();
      setSingleImmeubleData(cacheKey, dataType, null);

      // Refetch specific data type
      switch (dataType) {
        case "capteur":
          fetchAsyncData(
            `/api/immeuble_capteur/${immeubleId}`,
            "capteur",
            setCapteur,
            setCapteurLoading,
            setCapteurError
          );
          break;
        case "cet":
          fetchAsyncData(
            `/api/immeuble_cet/${immeubleId}`,
            "cet",
            setCet,
            setCetLoading,
            setCetError
          );
          break;
        // Add other cases as needed
        default:
          console.warn(`Unknown data type: ${dataType}`);
      }
    },
    [fetchAsyncData, immeubleId, setSingleImmeubleData]
  );

  // Initial load
  useEffect(() => {
    if (loginData?.tokenJwt && immeubleId) {
      // Start with immeuble (sync)
      fetchImmeuble();

      // Then all async data
      fetchAllAsyncData();
    }
  }, [loginData?.tokenJwt, immeubleId, fetchImmeuble, fetchAllAsyncData]);

  // Computed states
  const loading =
    immeubleLoading ||
    capteurLoading ||
    cetLoading ||
    ecLoading ||
    efLoading ||
    electLoading ||
    gazLoading ||
    indicatorsLoading ||
    repartLoading ||
    serieConsosCompteurGeneralLoading ||
    serieConsosEauLoading ||
    anomaliesLoading ||
    dysfonctionnementsLoading ||
    fuitesLoading;
  const error =
    immeubleError ||
    capteurError ||
    cetError ||
    ecError ||
    efError ||
    electError ||
    gazError ||
    indicatorsError ||
    repartError ||
    serieConsosCompteurGeneralError ||
    serieConsosEauError ||
    anomaliesError ||
    dysfonctionnementsError ||
    fuitesError;

  return {
    // Main immeuble data
    immeuble,
    immeubleLoading,
    immeubleError,

    // Async data sections
    capteur,
    capteurLoading,
    capteurError,

    cet,
    cetLoading,
    cetError,

    ec,
    ecLoading,
    ecError,

    ef,
    efLoading,
    efError,

    elect,
    electLoading,
    electError,

    gaz,
    gazLoading,
    gazError,

    indicators,
    indicatorsLoading,
    indicatorsError,

    repart,
    repartLoading,
    repartError,

    serieConsosCompteurGeneral,
    serieConsosCompteurGeneralLoading,
    serieConsosCompteurGeneralError,

    serieConsosEau,
    serieConsosEauLoading,
    serieConsosEauError,

    anomalies,
    anomaliesLoading,
    anomaliesError,

    dysfonctionnements,
    dysfonctionnementsLoading,
    dysfonctionnementsError,

    fuites,
    fuitesLoading,
    fuitesError,

    // Combined states
    loading,
    error,

    // Actions
    refetch,
    refetchImmeuble,
    refetchAsyncData,
  };
};
