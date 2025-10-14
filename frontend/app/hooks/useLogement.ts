import { useState, useEffect, useCallback } from "react";
import { useDataStore } from "../store/dataStore";

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

// Response wrapper types
interface LogementResponse {
  logementDto: Logement;
}

// Logement indicators interface matching backend response
export interface LogementIndicators {
  pkLogement: number;
  NbAppareils: number;
  NbCompteursEC: number;
  NbCompteursEF: number;
  NbCompteursRepart: number;
  NbCompteursCET: number;
  NbCompteursCapteur: number;
  NbCompteursElect: number;
  NbCompteursGaz: number;
  NbDepannages: number;
  NbDepannagesTotal: number;
  NbDysfonctionnements: number;
  NbTicketsInter: number;
  TicketsInterEnabled: boolean;
}

// Response wrapper for indicators
interface LogementIndicatorsResponse {
  indicators: LogementIndicators;
}

// Logement capteur interfaces matching backend response
export interface IndexRecap {
  date: string;
  moy: string;
  max: string;
  min: string;
}

export interface SerieConsos {
  erreur: string;
  info: string;
  defaultIntervalle: number;
  valeursXYL: string;
  annee: string;
}

export interface LogementCapteur {
  IndexRecapTemperature: IndexRecap;
  IndexRecapHumidite: IndexRecap;
  SerieConsosTemperature: SerieConsos;
  SerieConsosHumidite: SerieConsos;
}

export interface LogementCapteurData {
  pkLogement: number;
  logementCapteur: LogementCapteur;
}

// Response wrapper for capteur
interface LogementCapteurResponse {
  indicators: LogementCapteurData;
}

// Logement CET interfaces matching backend response
export interface LogementCET {
  ListeInfosAppareils: AppareilInfo[];
  Tot_URepart: string;
  Tot_TantChauff: string;
  PU_Tant: string;
  Prix_URepart: string;
  Prix_Abonn: string;
  Mont_ARepartTant: string;
  Part_RepartConsos: string;
  CT_Combust: string;
  URepartLog: string;
  TantLog: string;
  Prix_ChauffTantLog: string;
  CT_ChauffLog: string;
  SerieConsosDJU: SerieConsos;
}

export interface LogementCETData {
  pkLogement: number;
  logementCET: LogementCET;
}

// Response wrapper for CET
interface LogementCETResponse {
  indicators: LogementCETData;
}

// Logement EC interfaces matching backend response (same structure as EF)
export interface LogementEC {
  NbFuites: number;
  NbAnomalies: number;
  ConsoPeriode: ConsoPeriode;
  ListeInfosAppareils: ListeInfosAppareils;
  SerieConsos: SerieConsos;
  ConsoMemeTypeLogement: string;
}

export interface LogementECData {
  pkLogement: number;
  logementEC: LogementEC;
}

// Response wrapper for EC
interface LogementECResponse {
  indicators: LogementECData;
}

// Logement EF interfaces matching backend response
export interface Releve {
  DateReleve: string;
  Index: string;
  Conso: string;
}

export interface ConsoPeriode {
  Conso: string;
  DateDeb: string;
  DateFin: string;
  R5: Releve;
  R4: Releve;
  R3: Releve;
  R2: Releve;
  R1: Releve;
  VAR4: string;
  VAR3: string;
  VAR2: string;
  VAR1: string;
  DegresVAR4: number;
  DegresVAR3: number;
  DegresVAR2: number;
  DegresVAR1: number;
}

export interface Appareil {
  PkAppareil: number;
  Numero: string;
  Emplacement: string;
  Fluide: string;
  TypeAppareil: string;
  Unite: string;
}

export interface InfosAppareilEAU {
  Appareil: Appareil;
  SerieConsos: SerieConsos;
  R6: Releve;
  R5: Releve;
  R4: Releve;
  R3: Releve;
  R2: Releve;
  R1: Releve;
  NbFuites: number;
  NbDepannages: number;
  NbDysfonctionnements: number;
  NbAnomalies: number;
}

export interface ListeInfosAppareils {
  infosAppareilEAU: InfosAppareilEAU[];
}

export interface LogementEF {
  NbFuites: number;
  NbAnomalies: number;
  ConsoPeriode: ConsoPeriode;
  ListeInfosAppareils: ListeInfosAppareils;
  SerieConsos: SerieConsos;
  ConsoMemeTypeLogement: string;
}

export interface LogementEFData {
  pkLogement: number;
  logementEF: LogementEF;
}

// Response wrapper for EF
interface LogementEFResponse {
  indicators: LogementEFData;
}

// Logement repart interfaces matching backend response
export interface AppareilInfo {
  // Will be defined when we have actual appareil data
  [key: string]: any;
}

export interface ConsosPieces {
  // Will be defined when we have actual pieces data
  [key: string]: any;
}

export interface LogementRepart {
  ListeInfosAppareils: AppareilInfo[];
  Tot_URepart: string;
  Tot_TantChauff: string;
  PU_Tant: string;
  Prix_URepart: string;
  Prix_Abonn: string;
  Mont_ARepartTant: string;
  Part_RepartConsos: string;
  CT_Combust: string;
  URepartLog: string;
  TantLog: string;
  Prix_ChauffTantLog: string;
  CT_ChauffLog: string;
  SerieConsosDJU: SerieConsos;
  ConsosPieces: ConsosPieces[];
}

export interface LogementRepartData {
  pkLogement: number;
  logementRepart: LogementRepart;
}

// Response wrapper for repart
interface LogementRepartResponse {
  indicators: LogementRepartData;
}

interface AsyncData {
  [key: string]: unknown;
}

interface UseLogementReturn {
  // Main logement data (sync)
  logement: Logement | null;
  logementLoading: boolean;
  logementError: string | null;

  // Async data sections
  indicators: LogementIndicators | null;
  indicatorsLoading: boolean;
  indicatorsError: string | null;

  capteur: LogementCapteurData | null;
  capteurLoading: boolean;
  capteurError: string | null;

  cet: LogementCETData | null;
  cetLoading: boolean;
  cetError: string | null;

  ec: LogementECData | null;
  ecLoading: boolean;
  ecError: string | null;

  ef: LogementEFData | null;
  efLoading: boolean;
  efError: string | null;

  repart: LogementRepartData | null;
  repartLoading: boolean;
  repartError: string | null;

  // Combined loading state
  loading: boolean;
  error: string | null;

  // Actions
  refetch: () => void;
  refetchLogement: () => void;
  refetchAsyncData: (dataType: string) => void;
}

export const useLogement = (logementId: number): UseLogementReturn => {
  const { loginData, singleLogementCache, setSingleLogementData } =
    useDataStore();

  // Main logement state
  const [logement, setLogement] = useState<Logement | null>(null);
  const [logementLoading, setLogementLoading] = useState(false);
  const [logementError, setLogementError] = useState<string | null>(null);

  // Async data states
  const [indicators, setIndicators] = useState<LogementIndicators | null>(null);
  const [indicatorsLoading, setIndicatorsLoading] = useState(false);
  const [indicatorsError, setIndicatorsError] = useState<string | null>(null);

  const [capteur, setCapteur] = useState<LogementCapteurData | null>(null);
  const [capteurLoading, setCapteurLoading] = useState(false);
  const [capteurError, setCapteurError] = useState<string | null>(null);

  const [cet, setCet] = useState<LogementCETData | null>(null);
  const [cetLoading, setCetLoading] = useState(false);
  const [cetError, setCetError] = useState<string | null>(null);

  const [ec, setEc] = useState<LogementECData | null>(null);
  const [ecLoading, setEcLoading] = useState(false);
  const [ecError, setEcError] = useState<string | null>(null);

  const [ef, setEf] = useState<LogementEFData | null>(null);
  const [efLoading, setEfLoading] = useState(false);
  const [efError, setEfError] = useState<string | null>(null);

  const [repart, setRepart] = useState<LogementRepartData | null>(null);
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

  // Fetch main logement data (sync call)
  const fetchLogement = useCallback(async () => {
    if (!loginData?.tokenJwt) {
      setLogementError("No authentication token available");
      return;
    }

    // Check cache first
    const cacheKey = logementId.toString();
    if (singleLogementCache[cacheKey]?.logement?.data) {
      setLogement(singleLogementCache[cacheKey]!.logement!.data);
      setLogementLoading(false);
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

      const data: LogementResponse = await response.json();
      const logementData = data.logementDto;

      // Cache the data
      setSingleLogementData(cacheKey, "logement", logementData);
      setLogement(logementData);
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
  }, [
    loginData?.tokenJwt,
    logementId,
    getAuthHeaders,
    singleLogementCache,
    setSingleLogementData,
  ]);

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
      const cacheKey = logementId.toString();
      if (singleLogementCache[cacheKey]?.[dataType]?.data) {
        setData(singleLogementCache[cacheKey]![dataType]!.data);
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
          const responseData: LogementIndicatorsResponse = data;
          const indicatorsData: LogementIndicators = responseData.indicators;
          setSingleLogementData(cacheKey, dataType, indicatorsData);
          setData(indicatorsData);
        } else if (dataType === "capteur" && data.indicators) {
          // For capteur endpoint, extract the nested data and type it properly
          const responseData: LogementCapteurResponse = data;
          const capteurData: LogementCapteurData = responseData.indicators;
          setSingleLogementData(cacheKey, dataType, capteurData);
          setData(capteurData);
        } else if (dataType === "cet" && data.indicators) {
          // For cet endpoint, extract the nested data and type it properly
          const responseData: LogementCETResponse = data;
          const cetData: LogementCETData = responseData.indicators;
          setSingleLogementData(cacheKey, dataType, cetData);
          setData(cetData);
        } else if (dataType === "ec" && data.indicators) {
          // For ec endpoint, extract the nested data and type it properly
          const responseData: LogementECResponse = data;
          const ecData: LogementECData = responseData.indicators;
          setSingleLogementData(cacheKey, dataType, ecData);
          setData(ecData);
        } else if (dataType === "ef" && data.indicators) {
          // For ef endpoint, extract the nested data and type it properly
          const responseData: LogementEFResponse = data;
          const efData: LogementEFData = responseData.indicators;
          setSingleLogementData(cacheKey, dataType, efData);
          setData(efData);
        } else if (dataType === "repart" && data.indicators) {
          // For repart endpoint, extract the nested data and type it properly
          const responseData: LogementRepartResponse = data;
          const repartData: LogementRepartData = responseData.indicators;
          setSingleLogementData(cacheKey, dataType, repartData);
          setData(repartData);
        } else {
          // For other endpoints, use data as-is
          const result = data.indicators || data;
          setSingleLogementData(cacheKey, dataType, result);
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
      logementId,
      getAuthHeaders,
      singleLogementCache,
      setSingleLogementData,
    ]
  );

  // Fetch all async data
  const fetchAllAsyncData = useCallback(() => {
    fetchAsyncData(
      `/api/logement_indicators/${logementId}`,
      "indicators",
      setIndicators,
      setIndicatorsLoading,
      setIndicatorsError
    );

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
      `/api/logement_repart/${logementId}`,
      "repart",
      setRepart,
      setRepartLoading,
      setRepartError
    );
  }, [fetchAsyncData, logementId]);

  // Combined refetch
  const refetch = useCallback(() => {
    // Clear all caches for this logement
    const cacheKey = logementId.toString();
    setSingleLogementData(cacheKey, "logement", null);
    setSingleLogementData(cacheKey, "indicators", null);
    setSingleLogementData(cacheKey, "capteur", null);
    setSingleLogementData(cacheKey, "cet", null);
    setSingleLogementData(cacheKey, "ec", null);
    setSingleLogementData(cacheKey, "ef", null);
    setSingleLogementData(cacheKey, "repart", null);

    fetchLogement();
    fetchAllAsyncData();
  }, [fetchLogement, fetchAllAsyncData, logementId, setSingleLogementData]);

  // Individual refetch functions
  const refetchLogement = useCallback(() => {
    fetchLogement();
  }, [fetchLogement]);

  const refetchAsyncData = useCallback(
    (dataType: string) => {
      const cacheKey = logementId.toString();
      setSingleLogementData(cacheKey, dataType, null);

      switch (dataType) {
        case "indicators":
          fetchAsyncData(
            `/api/logement_indicators/${logementId}`,
            "indicators",
            setIndicators,
            setIndicatorsLoading,
            setIndicatorsError
          );
          break;
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
        case "repart":
          fetchAsyncData(
            `/api/logement_repart/${logementId}`,
            "repart",
            setRepart,
            setRepartLoading,
            setRepartError
          );
          break;
      }
    },
    [fetchAsyncData, logementId, setSingleLogementData]
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
    indicatorsLoading ||
    capteurLoading ||
    cetLoading ||
    ecLoading ||
    efLoading ||
    repartLoading;
  const error =
    logementError ||
    indicatorsError ||
    capteurError ||
    cetError ||
    ecError ||
    efError ||
    repartError;

  return {
    // Main logement data
    logement,
    logementLoading,
    logementError,

    // Async data sections
    indicators,
    indicatorsLoading,
    indicatorsError,

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

    repart,
    repartLoading,
    repartError,

    // Combined states
    loading,
    error,

    // Actions
    refetch,
    refetchLogement,
    refetchAsyncData,
  };
};
