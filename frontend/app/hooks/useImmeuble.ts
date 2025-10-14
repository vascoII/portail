import { useState, useEffect, useCallback } from "react";
import { useDataStore } from "../store/dataStore";

// Types matching backend DTOs exactly
export interface Immeuble {
  pkImmeuble: number;
  nom: string;
  numero: string;
  ref: string;
  adresse1: string;
  adresse2: string;
  adresse3: string;
  cp: string;
  ville: string;
  hasTelereleve: boolean;
  fkClientTop: number;
  actif: boolean;
  dateActivationClient: string;
  dateActivationOccupant: string;
  hasNoteOccupant: boolean;
  hasDecompteOccupant: boolean;
  hasFactures: boolean;
  hasChantiers: boolean;
}

// Types matching backend DTOs exactly
export interface ImmeubleIndicators {
  pkImmeuble: number;
  nbLogements: number;
  nbAppareils: number;
  nbDepannages: number;
  nbDepannagesTotal: number;
  degresDepannages: number;
  nbDysfonctionnements: number;
  degresDysfonctionnements: number;
  hasTelereleve: boolean;
  nbCompteursEC: number;
  nbCompteursEF: number;
  nbCompteursRepart: number;
  nbCompteursCET: number;
  nbCompteursCapteur: number;
  nbCompteursElect: number;
  nbCompteursGaz: number;
  nbCompteursTelereveleTotal: number;
  nbCompteursTelereveleOK: number;
  hasTransfertFichiers: boolean;
}

// Types matching backend DTOs exactly
export interface IndexRecap {
  date: string;
  moy: string;
  max: string;
  min: string;
}

export interface SerieConsos {
  defaultIntervalle: number;
  valeursXYL: string;
  annee: string;
}

export interface ImmeubleCapteur {
  IndexRecapTemperature: IndexRecap;
  indexRecapHumidite: IndexRecap;
  serieConsosTemperature: SerieConsos;
  SerieConsosHumidite: SerieConsos;
}

export interface ImmeubleCapteurData {
  pkImmeuble: number;
  immeubleCapteur: ImmeubleCapteur;
}

// Types matching backend DTOs exactly
export interface Chantier {
  pkChantier: number;
  pkDevis: number;
  pkImmeuble: number;
  dateEntreeChantier: string;
  nbCompteursPoses: number;
  nbCompteursCommandes: number;
}

export interface TopConsos {
  dateReleve: string;
}

export interface ImmeubleCET {
  nbCompteursARelever: number;
  nbCompteursReleves: number;
  chantier: Chantier;
  topConsos: TopConsos;
  serieConsos: SerieConsos;
  totURepart: string;
  totTantChauff: string;
  puTant: string;
  prixURepart: string;
  prixAbonn: string;
  montARepartTant: string;
  partRepartConsos: string;
  ctCombust: string;
  serieConsosTotale1: SerieConsos;
  serieConsosTotale2: SerieConsos;
  serieConsosDJU: SerieConsos;
}

export interface ImmeubleCETData {
  pkImmeuble: number;
  immeubleCET: ImmeubleCET;
}

// Types matching backend DTOs exactly
export interface ConsoLogement {
  pkLogement: number;
  nomOcc: string;
  refOcc: string;
  fluide: number;
  conso: string;
}

export interface TopConsosEC {
  dateReleve: string;
  consosGrandes: ConsoLogement[];
  consosPetites: ConsoLogement[];
}

export interface ImmeubleEC {
  nbCompteursARelever: number;
  nbCompteursReleves: number;
  nbFuites: number;
  degresFuites: number;
  nbAnomalies: number;
  degresAnomalies: number;
  chantier: Chantier;
  topConsos: TopConsosEC;
  serieConsos1: SerieConsos;
  serieConsos2: SerieConsos;
}

export interface ImmeubleECData {
  pkImmeuble: number;
  immeubleEC: ImmeubleEC;
}

// Types matching backend DTOs exactly
export interface TopConsosEF {
  dateReleve: string;
  consosGrandes: ConsoLogement[];
  consosPetites: ConsoLogement[];
}

export interface ImmeubleEF {
  pkImmeuble: number;
  nbCompteursARelever: number;
  nbCompteursReleves: number;
  nbFuites: number;
  degresFuites: number;
  nbAnomalies: number;
  degresAnomalies: number;
  chantier: Chantier;
  topConsos: TopConsosEF;
  serieConsos1: SerieConsos;
  serieConsos2: SerieConsos;
}

export interface ImmeubleEFData {
  immeubleEF: ImmeubleEF;
}

// Types matching backend DTOs exactly
export interface TopConsosRepart {
  dateReleve: string;
}

export interface ImmeubleRepart {
  nbCompteursARelever: number;
  nbCompteursReleves: number;
  chantier: Chantier;
  topConsos: TopConsosRepart;
  serieConsos: SerieConsos;
  totURepart: string;
  totTantChauff: string;
  puTant: string;
  prixURepart: string;
  prixAbonn: string;
  montARepartTant: string;
  partRepartConsos: string;
  ctCombust: string;
  serieConsosTotale1: SerieConsos;
  serieConsosTotale2: SerieConsos;
  serieConsosDJU: SerieConsos;
}

export interface ImmeubleRepartData {
  pkImmeuble: number;
  immeubleRepart: ImmeubleRepart;
}

// Response wrapper types
interface ImmeubleIndicatorsResponse {
  indicators: ImmeubleIndicators;
}

interface ImmeubleCapteurResponse {
  indicators: ImmeubleCapteurData;
}

interface ImmeubleCETResponse {
  indicators: ImmeubleCETData;
}

interface ImmeubleECResponse {
  indicators: ImmeubleECData;
}

interface ImmeubleEFResponse {
  indicators: ImmeubleEFData;
}

interface ImmeubleRepartResponse {
  indicators: ImmeubleRepartData;
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
  indicators: ImmeubleIndicators | null;
  indicatorsLoading: boolean;
  indicatorsError: string | null;

  capteur: ImmeubleCapteurData | null;
  capteurLoading: boolean;
  capteurError: string | null;

  cet: ImmeubleCETData | null;
  cetLoading: boolean;
  cetError: string | null;

  ec: ImmeubleECData | null;
  ecLoading: boolean;
  ecError: string | null;

  ef: ImmeubleEFData | null;
  efLoading: boolean;
  efError: string | null;

  repart: ImmeubleRepartData | null;
  repartLoading: boolean;
  repartError: string | null;

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
  const [capteur, setCapteur] = useState<ImmeubleCapteurData | null>(null);
  const [capteurLoading, setCapteurLoading] = useState(false);
  const [capteurError, setCapteurError] = useState<string | null>(null);

  const [cet, setCet] = useState<ImmeubleCETData | null>(null);
  const [cetLoading, setCetLoading] = useState(false);
  const [cetError, setCetError] = useState<string | null>(null);

  const [ec, setEc] = useState<ImmeubleECData | null>(null);
  const [ecLoading, setEcLoading] = useState(false);
  const [ecError, setEcError] = useState<string | null>(null);

  const [ef, setEf] = useState<ImmeubleEFData | null>(null);
  const [efLoading, setEfLoading] = useState(false);
  const [efError, setEfError] = useState<string | null>(null);

  const [indicators, setIndicators] = useState<ImmeubleIndicators | null>(null);
  const [indicatorsLoading, setIndicatorsLoading] = useState(false);
  const [indicatorsError, setIndicatorsError] = useState<string | null>(null);

  const [repart, setRepart] = useState<ImmeubleRepartData | null>(null);
  const [repartLoading, setRepartLoading] = useState(false);
  const [repartError, setRepartError] = useState<string | null>(null);

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
      setData: (data: any) => void,
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

        // Handle different response structures
        if (dataType === "indicators" && data.indicators) {
          // For indicators endpoint, extract the nested data and type it properly
          const indicatorsData: ImmeubleIndicators = data.indicators;
          setSingleImmeubleData(cacheKey, dataType, indicatorsData);
          setData(indicatorsData);
        } else if (dataType === "capteur" && data.indicators) {
          // For capteur endpoint, extract the nested data and type it properly
          const capteurData: ImmeubleCapteurData = data.indicators;
          setSingleImmeubleData(cacheKey, dataType, capteurData);
          setData(capteurData);
        } else if (dataType === "cet" && data.indicators) {
          // For cet endpoint, extract the nested data and type it properly
          const cetData: ImmeubleCETData = data.indicators;
          setSingleImmeubleData(cacheKey, dataType, cetData);
          setData(cetData);
        } else if (dataType === "ec" && data.indicators) {
          // For ec endpoint, extract the nested data and type it properly
          const ecData: ImmeubleECData = data.indicators;
          setSingleImmeubleData(cacheKey, dataType, ecData);
          setData(ecData);
        } else if (dataType === "ef" && data.indicators) {
          // For ef endpoint, extract the nested data and type it properly
          const efData: ImmeubleEFData = data.indicators;
          setSingleImmeubleData(cacheKey, dataType, efData);
          setData(efData);
        } else if (dataType === "repart" && data.indicators) {
          // For repart endpoint, extract the nested data and type it properly
          const repartData: ImmeubleRepartData = data.indicators;
          setSingleImmeubleData(cacheKey, dataType, repartData);
          setData(repartData);
        } else {
          // For other endpoints, use data as-is
          const result = data.indicators || data;
          setSingleImmeubleData(cacheKey, dataType, result);
          setData(result);
        }
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

      const data: Immeuble = await response.json();

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
    setSingleImmeubleData(cacheKey, "indicators", null);
    setSingleImmeubleData(cacheKey, "repart", null);

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
    indicatorsLoading ||
    repartLoading;
  const error =
    immeubleError ||
    capteurError ||
    cetError ||
    ecError ||
    efError ||
    indicatorsError ||
    repartError;

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

    indicators,
    indicatorsLoading,
    indicatorsError,

    repart,
    repartLoading,
    repartError,

    // Combined states
    loading,
    error,

    // Actions
    refetch,
    refetchImmeuble,
    refetchAsyncData,
  };
};
