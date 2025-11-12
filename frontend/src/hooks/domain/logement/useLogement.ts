"use client";

import { useCachedQuery } from "../shared/useCachedQuery";
import { getLogementApiService } from "@/services/api/Logement/GetLogementApiService";
import { getLogementCapteurApiService } from "@/services/api/Logement/GetLogementCapteurApiService";
import { getLogementCETApiService } from "@/services/api/Logement/GetLogementCETApiService";
import { getLogementECApiService } from "@/services/api/Logement/GetLogementECApiService";
import { getLogementEFApiService } from "@/services/api/Logement/GetLogementEFApiService";
import { getLogementRepartApiService } from "@/services/api/Logement/GetLogementRepartApiService";
import { listAnomaliesByLogementApiService } from "@/services/api/Logement/ListAnomaliesByLogementApiService";
import { listDysfonctionnementsByLogementApiService } from "@/services/api/Logement/ListDysfonctionnementsByLogementApiService";
import { listFuitesByLogementApiService } from "@/services/api/Logement/ListFuitesByLogementApiService";
import { listInterventionsByLogementApiService } from "@/services/api/Logement/ListInterventionsByLogementApiService";
import type { LogementResponseDto } from "@/types/api/response/logement/LogementResponseDto";
import type { ShowRequestDto } from "@/types/api/request/Logement/ShowRequestDto";
import type { ShowInterventionRequestDto } from "@/types/api/request/Logement/ShowInterventionRequestDto";
import type { ShowRepartReleveRequestDto } from "@/types/api/request/Logement/ShowRepartReleveRequestDto";
import type { AnomaliesRequestDto } from "@/types/api/request/Logement/AnomaliesRequestDto";
import type { DysfunctionsRequestDto } from "@/types/api/request/Logement/DysfunctionsRequestDto";
import type { LeaksRequestDto } from "@/types/api/request/Logement/LeaksRequestDto";
import type { ListAnomaliesResponseDto } from "@/types/api/response/shared/ListAnomaliesResponseDto";
import type { ListDysfonctionnementsResponseDto } from "@/types/api/response/shared/ListDysfonctionnementsResponseDto";
import type { ListFuitesResponseDto } from "@/types/api/response/shared/ListFuitesResponseDto";
import type { ListInterventionsResponseDto } from "@/types/api/response/shared/ListInterventionsResponseDto";

export interface UseLogementReturn {
  // Main logement data
  logement: LogementResponseDto | null;
  logementLoading: boolean;
  logementError: string | null;
  refetchLogement: (force?: boolean) => Promise<void>;

  // Capteur data
  capteur: any | null;
  capteurLoading: boolean;
  capteurError: string | null;
  refetchCapteur: (force?: boolean) => Promise<void>;

  // CET data
  cet: any | null;
  cetLoading: boolean;
  cetError: string | null;
  refetchCet: (force?: boolean) => Promise<void>;

  // EC data
  ec: any | null;
  ecLoading: boolean;
  ecError: string | null;
  refetchEc: (force?: boolean) => Promise<void>;

  // EF data
  ef: any | null;
  efLoading: boolean;
  efError: string | null;
  refetchEf: (force?: boolean) => Promise<void>;

  // Repart data
  repart: any | null;
  repartLoading: boolean;
  repartError: string | null;
  refetchRepart: (force?: boolean) => Promise<void>;

  // Anomalies data
  anomalies: ListAnomaliesResponseDto | null;
  anomaliesLoading: boolean;
  anomaliesError: string | null;
  refetchAnomalies: (force?: boolean) => Promise<void>;

  // Dysfonctionnements data
  dysfonctionnements: ListDysfonctionnementsResponseDto | null;
  dysfonctionnementsLoading: boolean;
  dysfonctionnementsError: string | null;
  refetchDysfonctionnements: (force?: boolean) => Promise<void>;

  // Fuites data
  fuites: ListFuitesResponseDto | null;
  fuitesLoading: boolean;
  fuitesError: string | null;
  refetchFuites: (force?: boolean) => Promise<void>;

  // Interventions data
  interventions: ListInterventionsResponseDto | null;
  interventionsLoading: boolean;
  interventionsError: string | null;
  refetchInterventions: (force?: boolean) => Promise<void>;

  // Combined states
  loading: boolean;
  error: string | null;
}

export interface UseLogementOptions {
  pkLogement: string;
  enabled?: boolean;
  // Options pour activer/désactiver chaque section
  loadCapteur?: boolean;
  loadCet?: boolean;
  loadEc?: boolean;
  loadEf?: boolean;
  loadRepart?: boolean;
  loadAnomalies?: boolean;
  loadDysfonctionnements?: boolean;
  loadFuites?: boolean;
  loadInterventions?: boolean;
  // Paramètres optionnels pour certains services
  pkImmeuble?: string; // Pour repart
  interventionParams?: ShowInterventionRequestDto;
}

/**
 * Hook pour récupérer les données d'un logement et ses données associées
 * Utilise le cache pour éviter les requêtes inutiles
 */
export function useLogement(options: UseLogementOptions): UseLogementReturn {
  const {
    pkLogement,
    enabled = true,
    loadCapteur = false,
    loadCet = false,
    loadEc = false,
    loadEf = false,
    loadRepart = false,
    loadAnomalies = false,
    loadDysfonctionnements = false,
    loadFuites = false,
    loadInterventions = false,
    pkImmeuble,
    interventionParams,
  } = options;

  const showRequest: ShowRequestDto = { pkLogement };

  // Main logement data (always loaded)
  const {
    data: logement,
    loading: logementLoading,
    error: logementError,
    refetch: refetchLogement,
  } = useCachedQuery<LogementResponseDto>(
    () => getLogementApiService.getLogement(showRequest),
    {
      cacheKey: `logement-${pkLogement}`,
      enabled,
    }
  );

  // Capteur data
  const {
    data: capteur,
    loading: capteurLoading,
    error: capteurError,
    refetch: refetchCapteur,
  } = useCachedQuery<any>(
    () => getLogementCapteurApiService.getLogementCapteur(showRequest),
    {
      cacheKey: `logement-${pkLogement}-capteur`,
      enabled: enabled && loadCapteur,
    }
  );

  // CET data
  const {
    data: cet,
    loading: cetLoading,
    error: cetError,
    refetch: refetchCet,
  } = useCachedQuery<any>(
    () => getLogementCETApiService.getLogementCET(showRequest),
    {
      cacheKey: `logement-${pkLogement}-cet`,
      enabled: enabled && loadCet,
    }
  );

  // EC data
  const {
    data: ec,
    loading: ecLoading,
    error: ecError,
    refetch: refetchEc,
  } = useCachedQuery<any>(
    () => getLogementECApiService.getLogementEC(showRequest),
    {
      cacheKey: `logement-${pkLogement}-ec`,
      enabled: enabled && loadEc,
    }
  );

  // EF data
  const {
    data: ef,
    loading: efLoading,
    error: efError,
    refetch: refetchEf,
  } = useCachedQuery<any>(
    () => getLogementEFApiService.getLogementEF(showRequest),
    {
      cacheKey: `logement-${pkLogement}-ef`,
      enabled: enabled && loadEf,
    }
  );

  // Repart data (requires pkImmeuble)
  const repartRequest: ShowRepartReleveRequestDto | null = pkImmeuble
    ? { pkLogement, pkImmeuble }
    : null;
  const {
    data: repart,
    loading: repartLoading,
    error: repartError,
    refetch: refetchRepart,
  } = useCachedQuery<any>(
    () => {
      if (!repartRequest) {
        throw new Error("pkImmeuble is required for repart data");
      }
      return getLogementRepartApiService.getLogementRepart(repartRequest);
    },
    {
      cacheKey: `logement-${pkLogement}-repart-${pkImmeuble || "none"}`,
      enabled: enabled && loadRepart && !!pkImmeuble,
    }
  );

  // Anomalies data
  const anomaliesRequest: AnomaliesRequestDto = { pkLogement };
  const {
    data: anomalies,
    loading: anomaliesLoading,
    error: anomaliesError,
    refetch: refetchAnomalies,
  } = useCachedQuery<ListAnomaliesResponseDto>(
    () =>
      listAnomaliesByLogementApiService.listAnomaliesByLogement(
        anomaliesRequest
      ),
    {
      cacheKey: `logement-${pkLogement}-anomalies`,
      enabled: enabled && loadAnomalies,
    }
  );

  // Dysfonctionnements data
  const dysfonctionnementsRequest: DysfunctionsRequestDto = { pkLogement };
  const {
    data: dysfonctionnements,
    loading: dysfonctionnementsLoading,
    error: dysfonctionnementsError,
    refetch: refetchDysfonctionnements,
  } = useCachedQuery<ListDysfonctionnementsResponseDto>(
    () =>
      listDysfonctionnementsByLogementApiService.listDysfonctionnementsByLogement(
        dysfonctionnementsRequest
      ),
    {
      cacheKey: `logement-${pkLogement}-dysfonctionnements`,
      enabled: enabled && loadDysfonctionnements,
    }
  );

  // Fuites data
  const fuitesRequest: LeaksRequestDto = { pkLogement };
  const {
    data: fuites,
    loading: fuitesLoading,
    error: fuitesError,
    refetch: refetchFuites,
  } = useCachedQuery<ListFuitesResponseDto>(
    () => listFuitesByLogementApiService.listFuitesByLogement(fuitesRequest),
    {
      cacheKey: `logement-${pkLogement}-fuites`,
      enabled: enabled && loadFuites,
    }
  );

  // Interventions data
  const interventionsRequest: ShowInterventionRequestDto =
    interventionParams || { pkLogement, pkIntervention: "" };
  const {
    data: interventions,
    loading: interventionsLoading,
    error: interventionsError,
    refetch: refetchInterventions,
  } = useCachedQuery<ListInterventionsResponseDto>(
    () =>
      listInterventionsByLogementApiService.listInterventionsByLogement(
        interventionsRequest
      ),
    {
      cacheKey: `logement-${pkLogement}-interventions`,
      enabled: enabled && loadInterventions,
    }
  );

  // Combined states
  const loading =
    logementLoading ||
    capteurLoading ||
    cetLoading ||
    ecLoading ||
    efLoading ||
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
    repartError ||
    anomaliesError ||
    dysfonctionnementsError ||
    fuitesError ||
    interventionsError;

  return {
    // Main logement
    logement,
    logementLoading,
    logementError,
    refetchLogement,

    // Capteur
    capteur,
    capteurLoading,
    capteurError,
    refetchCapteur,

    // CET
    cet,
    cetLoading,
    cetError,
    refetchCet,

    // EC
    ec,
    ecLoading,
    ecError,
    refetchEc,

    // EF
    ef,
    efLoading,
    efError,
    refetchEf,

    // Repart
    repart,
    repartLoading,
    repartError,
    refetchRepart,

    // Anomalies
    anomalies,
    anomaliesLoading,
    anomaliesError,
    refetchAnomalies,

    // Dysfonctionnements
    dysfonctionnements,
    dysfonctionnementsLoading,
    dysfonctionnementsError,
    refetchDysfonctionnements,

    // Fuites
    fuites,
    fuitesLoading,
    fuitesError,
    refetchFuites,

    // Interventions
    interventions,
    interventionsLoading,
    interventionsError,
    refetchInterventions,

    // Combined
    loading,
    error,
  };
}

