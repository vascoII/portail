"use client";

import { useCachedQuery } from "../shared/useCachedQuery";
import { getImmeubleApiService } from "@/services/api/Immeuble/GetImmeubleApiService";
import { getImmeubleCapteurApiService } from "@/services/api/Immeuble/GetImmeubleCapteurApiService";
import { getImmeubleCETApiService } from "@/services/api/Immeuble/GetImmeubleCETApiService";
import { getImmeubleECApiService } from "@/services/api/Immeuble/GetImmeubleECApiService";
import { getImmeubleEFApiService } from "@/services/api/Immeuble/GetImmeubleEFApiService";
import { getImmeubleRepartApiService } from "@/services/api/Immeuble/GetImmeubleRepartApiService";
import { getImmeubleSerieConsosEAUApiService } from "@/services/api/Immeuble/GetImmeubleSerieConsosEAUApiService";
import { listAnomaliesByImmeubleApiService } from "@/services/api/Immeuble/ListAnomaliesByImmeubleApiService";
import { listDysfonctionnementsByImmeubleApiService } from "@/services/api/Immeuble/ListDysfonctionnementsByImmeubleApiService";
import { listFuitesByImmeubleApiService } from "@/services/api/Immeuble/ListFuitesByImmeubleApiService";
import { listInterventionsByImmeubleApiService } from "@/services/api/Immeuble/ListInterventionsByImmeubleApiService";
import type { GetImmeubleResponseDto } from "@/types/api/response/immeuble/GetImmeubleResponseDto";
import type { ShowRequestDto } from "@/types/api/request/Immeuble/ShowRequestDto";
import type { ShowInterventionRequestDto } from "@/types/api/request/Immeuble/ShowInterventionRequestDto";
import type { ShowRepartReleveRequestDto } from "@/types/api/request/Logement/ShowRepartReleveRequestDto";
import type { GetInfosAnomaliesByImmeubleRequestDto } from "@/types/api/request/Immeuble/GetInfosAnomaliesByImmeubleRequestDto";
import type { GetInfosDysfonctionnementsByImmeubleRequestDto } from "@/types/api/request/Immeuble/GetInfosDysfonctionnementsByImmeubleRequestDto";
import type { GetInfosFuitesByImmeubleRequestDto } from "@/types/api/request/Immeuble/GetInfosFuitesByImmeubleRequestDto";
import type { ListAnomaliesResponseDto } from "@/types/api/response/shared/ListAnomaliesResponseDto";
import type { ListDysfonctionnementsResponseDto } from "@/types/api/response/shared/ListDysfonctionnementsResponseDto";
import type { ListFuitesResponseDto } from "@/types/api/response/shared/ListFuitesResponseDto";
import type { ListInterventionsResponseDto } from "@/types/api/response/shared/ListInterventionsResponseDto";

export interface UseImmeubleReturn {
  // Main immeuble data
  immeuble: GetImmeubleResponseDto | null;
  immeubleLoading: boolean;
  immeubleError: string | null;
  refetchImmeuble: (force?: boolean) => Promise<void>;

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

  // Serie Consos EAU data
  serieConsosEAU: any | null;
  serieConsosEAULoading: boolean;
  serieConsosEAUError: string | null;
  refetchSerieConsosEAU: (force?: boolean) => Promise<void>;

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

export interface UseImmeubleOptions {
  pkImmeuble: string;
  enabled?: boolean;
  // Options pour activer/désactiver chaque section
  loadCapteur?: boolean;
  loadCet?: boolean;
  loadEc?: boolean;
  loadEf?: boolean;
  loadRepart?: boolean;
  loadSerieConsosEAU?: boolean;
  loadAnomalies?: boolean;
  loadDysfonctionnements?: boolean;
  loadFuites?: boolean;
  loadInterventions?: boolean;
  // Paramètres optionnels pour certains services
  pkLogement?: string; // Pour repart
  anomaliesParams?: GetInfosAnomaliesByImmeubleRequestDto;
  dysfonctionnementsParams?: GetInfosDysfonctionnementsByImmeubleRequestDto;
  fuitesParams?: GetInfosFuitesByImmeubleRequestDto;
  interventionParams?: ShowInterventionRequestDto;
}

/**
 * Hook pour récupérer les données d'un immeuble et ses données associées
 * Utilise le cache pour éviter les requêtes inutiles
 */
export function useImmeuble(options: UseImmeubleOptions): UseImmeubleReturn {
  const {
    pkImmeuble,
    enabled = true,
    loadCapteur = false,
    loadCet = false,
    loadEc = false,
    loadEf = false,
    loadRepart = false,
    loadSerieConsosEAU = false,
    loadAnomalies = false,
    loadDysfonctionnements = false,
    loadFuites = false,
    loadInterventions = false,
    pkLogement,
    anomaliesParams,
    dysfonctionnementsParams,
    fuitesParams,
    interventionParams,
  } = options;

  const showRequest: ShowRequestDto = { pkImmeuble };

  // Main immeuble data (always loaded)
  const {
    data: immeuble,
    loading: immeubleLoading,
    error: immeubleError,
    refetch: refetchImmeuble,
  } = useCachedQuery<GetImmeubleResponseDto>(
    () => getImmeubleApiService.getImmeuble(showRequest),
    {
      cacheKey: `immeuble-${pkImmeuble}`,
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
    () => getImmeubleCapteurApiService.getImmeubleCapteur(showRequest),
    {
      cacheKey: `immeuble-${pkImmeuble}-capteur`,
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
    () => getImmeubleCETApiService.getImmeubleCET(showRequest),
    {
      cacheKey: `immeuble-${pkImmeuble}-cet`,
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
    () => getImmeubleECApiService.getImmeubleEC(showRequest),
    {
      cacheKey: `immeuble-${pkImmeuble}-ec`,
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
    () => getImmeubleEFApiService.getImmeubleEF(showRequest),
    {
      cacheKey: `immeuble-${pkImmeuble}-ef`,
      enabled: enabled && loadEf,
    }
  );

  // Repart data (requires pkLogement)
  const repartRequest: ShowRepartReleveRequestDto | null = pkLogement
    ? { pkImmeuble, pkLogement }
    : null;
  const {
    data: repart,
    loading: repartLoading,
    error: repartError,
    refetch: refetchRepart,
  } = useCachedQuery<any>(
    () => {
      if (!repartRequest) {
        throw new Error("pkLogement is required for repart data");
      }
      return getImmeubleRepartApiService.getImmeubleRepart(repartRequest);
    },
    {
      cacheKey: `immeuble-${pkImmeuble}-repart-${pkLogement || "none"}`,
      enabled: enabled && loadRepart && !!pkLogement,
    }
  );

  // Serie Consos EAU data
  const {
    data: serieConsosEAU,
    loading: serieConsosEAULoading,
    error: serieConsosEAUError,
    refetch: refetchSerieConsosEAU,
  } = useCachedQuery<any>(
    () =>
      getImmeubleSerieConsosEAUApiService.getImmeubleSerieConsosEAU(
        showRequest
      ),
    {
      cacheKey: `immeuble-${pkImmeuble}-serie-consos-eau`,
      enabled: enabled && loadSerieConsosEAU,
    }
  );

  // Anomalies data
  const anomaliesRequest: GetInfosAnomaliesByImmeubleRequestDto =
    anomaliesParams || { pkImmeuble, paramsFiltres: "" };
  const {
    data: anomalies,
    loading: anomaliesLoading,
    error: anomaliesError,
    refetch: refetchAnomalies,
  } = useCachedQuery<ListAnomaliesResponseDto>(
    () =>
      listAnomaliesByImmeubleApiService.listAnomaliesByImmeuble(
        anomaliesRequest
      ),
    {
      cacheKey: `immeuble-${pkImmeuble}-anomalies-${anomaliesRequest.paramsFiltres}`,
      enabled: enabled && loadAnomalies,
    }
  );

  // Dysfonctionnements data
  const dysfonctionnementsRequest: GetInfosDysfonctionnementsByImmeubleRequestDto =
    dysfonctionnementsParams || { pkImmeuble, paramsFiltres: "" };
  const {
    data: dysfonctionnements,
    loading: dysfonctionnementsLoading,
    error: dysfonctionnementsError,
    refetch: refetchDysfonctionnements,
  } = useCachedQuery<ListDysfonctionnementsResponseDto>(
    () =>
      listDysfonctionnementsByImmeubleApiService.listDysfonctionnementsByImmeuble(
        dysfonctionnementsRequest
      ),
    {
      cacheKey: `immeuble-${pkImmeuble}-dysfonctionnements-${dysfonctionnementsRequest.paramsFiltres}`,
      enabled: enabled && loadDysfonctionnements,
    }
  );

  // Fuites data
  const fuitesRequest: GetInfosFuitesByImmeubleRequestDto = fuitesParams || {
    pkImmeuble,
    paramsFiltres: "",
  };
  const {
    data: fuites,
    loading: fuitesLoading,
    error: fuitesError,
    refetch: refetchFuites,
  } = useCachedQuery<ListFuitesResponseDto>(
    () => listFuitesByImmeubleApiService.listFuitesByImmeuble(fuitesRequest),
    {
      cacheKey: `immeuble-${pkImmeuble}-fuites-${fuitesRequest.paramsFiltres}`,
      enabled: enabled && loadFuites,
    }
  );

  // Interventions data
  const interventionsRequest: ShowInterventionRequestDto =
    interventionParams || { pkImmeuble, pkIntervention: "" };
  const {
    data: interventions,
    loading: interventionsLoading,
    error: interventionsError,
    refetch: refetchInterventions,
  } = useCachedQuery<ListInterventionsResponseDto>(
    () =>
      listInterventionsByImmeubleApiService.listInterventionsByImmeuble(
        interventionsRequest
      ),
    {
      cacheKey: `immeuble-${pkImmeuble}-interventions`,
      enabled: enabled && loadInterventions,
    }
  );

  // Combined states
  const loading =
    immeubleLoading ||
    capteurLoading ||
    cetLoading ||
    ecLoading ||
    efLoading ||
    repartLoading ||
    serieConsosEAULoading ||
    anomaliesLoading ||
    dysfonctionnementsLoading ||
    fuitesLoading ||
    interventionsLoading;

  const error =
    immeubleError ||
    capteurError ||
    cetError ||
    ecError ||
    efError ||
    repartError ||
    serieConsosEAUError ||
    anomaliesError ||
    dysfonctionnementsError ||
    fuitesError ||
    interventionsError;

  return {
    // Main immeuble
    immeuble,
    immeubleLoading,
    immeubleError,
    refetchImmeuble,

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

    // Serie Consos EAU
    serieConsosEAU,
    serieConsosEAULoading,
    serieConsosEAUError,
    refetchSerieConsosEAU,

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
