import { useState, useEffect, useCallback } from "react";
import { useDataStore } from "./dataStore";

// Types matching backend DTOs
interface Logement {
  Logement: {
    PkLogement: number;
    Ref?: string;
    NumOrdre: string;
    NumBatiment: string;
    NumEscalier: string;
    NumEtage: string;
    AdrBatiment?: string;
  };
  Occupant: {
    PkOccupant: number;
    Ref: string;
    Nom: string;
    DateArrivee: string;
  };
  Immeuble: {
    PkImmeuble: number;
    Ref: string;
    Numero: string;
    Cp: string;
    Ville: string;
    HasTelereleve?: boolean;
    HasNoteOccupant?: boolean;
  };
  NbAppareils: number;
  NbCompteursEF: number;
  NbCompteursEC: number;
  NbCompteursRepart: number;
  NbCompteursCET: number;
  NbCompteursElect: number;
  NbCompteursGaz: number;
  NbCompteursCapteur: number;
  NbFuites: number;
  NbAnomalies: number;
  NbDysfonctionnements: number;
  NbDepannages: number;
  NbTicketsInter: number;
  TicketsInterEnabled: boolean;
}

interface AsyncData {
  [key: string]: any;
}

interface UseLogementReturn {
  // Main logement data (sync)
  logement: Logement | null;
  logementLoading: boolean;
  logementError: string | null;

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

  anomalies: AsyncData | null;
  anomaliesLoading: boolean;
  anomaliesError: string | null;

  dysfonctionnements: AsyncData | null;
  dysfonctionnementsLoading: boolean;
  dysfonctionnementsError: string | null;

  fuites: AsyncData | null;
  fuitesLoading: boolean;
  fuitesError: string | null;

  interventions: AsyncData | null;
  interventionsLoading: boolean;
  interventionsError: string | null;

  // Combined states
  loading: boolean;
  error: string | null;

  // Actions
  refetch: () => void;
  refetchLogement: () => void;
  refetchAsyncData: (dataType: string) => void;
}

// Cache for async data
const asyncDataCache: {
  [key: string]: { data: AsyncData; timestamp: number };
} = {};
const CACHE_DURATION = 5 * 60 * 1000; // 5 minutes

export const useLogement = (logementId: number): UseLogementReturn => {
  const { loginData } = useDataStore();

  // Main logement state (sync)
  const [logement, setLogement] = useState<Logement | null>(null);
  const [logementLoading, setLogementLoading] = useState(false);
  const [logementError, setLogementError] = useState<string | null>(null);

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

  const [interventions, setInterventions] = useState<AsyncData | null>(null);
  const [interventionsLoading, setInterventionsLoading] = useState(false);
  const [interventionsError, setInterventionsError] = useState<string | null>(
    null
  );

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

  // Generic async data fetcher with caching
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
      const cacheKey = `${dataType}-${logementId}`;
      const now = Date.now();
      if (
        asyncDataCache[cacheKey] &&
        now - asyncDataCache[cacheKey].timestamp < CACHE_DURATION
      ) {
        setData(asyncDataCache[cacheKey].data);
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

        // Update cache
        asyncDataCache[cacheKey] = { data: result, timestamp: now };
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
    [loginData?.tokenJwt, logementId, getAuthHeaders]
  );

  // Fetch main logement data (sync)
  const fetchLogement = useCallback(async () => {
    if (!loginData?.tokenJwt) {
      setLogementError("No authentication token available");
      return;
    }

    setLogementLoading(true);
    setLogementError(null);

    try {
      const response = await fetch(
        `http://localhost:8000/api/logement/${logementId}`,
        {
          method: "GET",
          headers: getAuthHeaders(),
        }
      );

      if (!response.ok) {
        throw new Error(
          `Failed to fetch logement: ${response.status} ${response.statusText}`
        );
      }

      const data = await response.json();
      setLogement(data);
    } catch (err) {
      const errorMessage =
        err instanceof Error
          ? err.message
          : "An error occurred while fetching logement";
      setLogementError(errorMessage);
      console.error("Logement fetch error:", err);
    } finally {
      setLogementLoading(false);
    }
  }, [loginData?.tokenJwt, logementId, getAuthHeaders]);

  // Fetch all async data
  const fetchAllAsyncData = useCallback(() => {
    // Start all async calls simultaneously
    fetchAsyncData(
      `/api/logement_capteur/${logementId}`,
      "capteur",
      setCapteur,
      setCapteurLoading,
      setCapteurError
    );

    fetchAsyncData(
      `/api/logement_cet/${logementId}`,
      "cet",
      setCet,
      setCetLoading,
      setCetError
    );

    fetchAsyncData(
      `/api/logement_ec/${logementId}`,
      "ec",
      setEc,
      setEcLoading,
      setEcError
    );

    fetchAsyncData(
      `/api/logement_ef/${logementId}`,
      "ef",
      setEf,
      setEfLoading,
      setEfError
    );

    fetchAsyncData(
      `/api/logement_elect/${logementId}`,
      "elect",
      setElect,
      setElectLoading,
      setElectError
    );

    fetchAsyncData(
      `/api/logement_gaz/${logementId}`,
      "gaz",
      setGaz,
      setGazLoading,
      setGazError
    );

    fetchAsyncData(
      `/api/logement_indicators/${logementId}`,
      "indicators",
      setIndicators,
      setIndicatorsLoading,
      setIndicatorsError
    );

    fetchAsyncData(
      `/api/logement_repart/${logementId}`,
      "repart",
      setRepart,
      setRepartLoading,
      setRepartError
    );

    fetchAsyncData(
      `/api/logement/${logementId}/anomalies`,
      "anomalies",
      setAnomalies,
      setAnomaliesLoading,
      setAnomaliesError
    );

    fetchAsyncData(
      `/api/logement/${logementId}/dysfonctionnements`,
      "dysfonctionnements",
      setDysfonctionnements,
      setDysfonctionnementsLoading,
      setDysfonctionnementsError
    );

    fetchAsyncData(
      `/api/logement/${logementId}/fuites`,
      "fuites",
      setFuites,
      setFuitesLoading,
      setFuitesError
    );

    fetchAsyncData(
      `/api/logement/${logementId}/interventions`,
      "interventions",
      setInterventions,
      setInterventionsLoading,
      setInterventionsError
    );
  }, [fetchAsyncData, logementId]);

  // Combined refetch
  const refetch = useCallback(() => {
    fetchLogement();
    fetchAllAsyncData();
  }, [fetchLogement, fetchAllAsyncData]);

  // Individual refetch functions
  const refetchLogement = useCallback(() => {
    fetchLogement();
  }, [fetchLogement]);

  const refetchAsyncData = useCallback(
    (dataType: string) => {
      // Clear cache for specific data type
      const cacheKey = `${dataType}-${logementId}`;
      delete asyncDataCache[cacheKey];

      // Refetch specific data type
      switch (dataType) {
        case "capteur":
          fetchAsyncData(
            `/api/logement_capteur/${logementId}`,
            "capteur",
            setCapteur,
            setCapteurLoading,
            setCapteurError
          );
          break;
        case "cet":
          fetchAsyncData(
            `/api/logement_cet/${logementId}`,
            "cet",
            setCet,
            setCetLoading,
            setCetError
          );
          break;
        case "ec":
          fetchAsyncData(
            `/api/logement_ec/${logementId}`,
            "ec",
            setEc,
            setEcLoading,
            setEcError
          );
          break;
        case "ef":
          fetchAsyncData(
            `/api/logement_ef/${logementId}`,
            "ef",
            setEf,
            setEfLoading,
            setEfError
          );
          break;
        case "elect":
          fetchAsyncData(
            `/api/logement_elect/${logementId}`,
            "elect",
            setElect,
            setElectLoading,
            setElectError
          );
          break;
        case "gaz":
          fetchAsyncData(
            `/api/logement_gaz/${logementId}`,
            "gaz",
            setGaz,
            setGazLoading,
            setGazError
          );
          break;
        case "indicators":
          fetchAsyncData(
            `/api/logement_indicators/${logementId}`,
            "indicators",
            setIndicators,
            setIndicatorsLoading,
            setIndicatorsError
          );
          break;
        case "repart":
          fetchAsyncData(
            `/api/logement_repart/${logementId}`,
            "repart",
            setRepart,
            setRepartLoading,
            setRepartError
          );
          break;
        case "anomalies":
          fetchAsyncData(
            `/api/logement/${logementId}/anomalies`,
            "anomalies",
            setAnomalies,
            setAnomaliesLoading,
            setAnomaliesError
          );
          break;
        case "dysfonctionnements":
          fetchAsyncData(
            `/api/logement/${logementId}/dysfonctionnements`,
            "dysfonctionnements",
            setDysfonctionnements,
            setDysfonctionnementsLoading,
            setDysfonctionnementsError
          );
          break;
        case "fuites":
          fetchAsyncData(
            `/api/logement/${logementId}/fuites`,
            "fuites",
            setFuites,
            setFuitesLoading,
            setFuitesError
          );
          break;
        case "interventions":
          fetchAsyncData(
            `/api/logement/${logementId}/interventions`,
            "interventions",
            setInterventions,
            setInterventionsLoading,
            setInterventionsError
          );
          break;
        default:
          console.warn(`Unknown data type: ${dataType}`);
      }
    },
    [fetchAsyncData, logementId]
  );

  // Initial load
  useEffect(() => {
    if (loginData?.tokenJwt && logementId) {
      // Start with logement (sync)
      fetchLogement();

      // Then all async data
      fetchAllAsyncData();
    }
  }, [loginData?.tokenJwt, logementId, fetchLogement, fetchAllAsyncData]);

  // Computed states
  const loading =
    logementLoading ||
    capteurLoading ||
    cetLoading ||
    ecLoading ||
    efLoading ||
    electLoading ||
    gazLoading ||
    indicatorsLoading ||
    repartLoading ||
    anomaliesLoading ||
    dysfonctionnementsLoading ||
    fuitesLoading ||
    interventionsLoading;
  const error =
    logementError ||
    capteurError ||
    cetError ||
    ecError ||
    efError ||
    electError ||
    gazError ||
    indicatorsError ||
    repartError ||
    anomaliesError ||
    dysfonctionnementsError ||
    fuitesError ||
    interventionsError;

  return {
    // Main logement data
    logement,
    logementLoading,
    logementError,

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

    anomalies,
    anomaliesLoading,
    anomaliesError,

    dysfonctionnements,
    dysfonctionnementsLoading,
    dysfonctionnementsError,

    fuites,
    fuitesLoading,
    fuitesError,

    interventions,
    interventionsLoading,
    interventionsError,

    // Combined states
    loading,
    error,

    // Actions
    refetch,
    refetchLogement,
    refetchAsyncData,
  };
};
