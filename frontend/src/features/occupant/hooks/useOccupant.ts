"use client";

import { useCachedQuery } from "@/src/shared/hooks/useCachedQuery";
import { getOccupantApiService } from "@/src/features/occupant/services/GetOccupantApiService";
import { getOccupantAccountApiService } from "@/src/features/occupant/services/GetOccupantAccountApiService";
import { getOccupantInterventionApiService } from "@/src/features/occupant/services/GetOccupantInterventionApiService";
import { listAnomaliesByOccupantApiService } from "@/src/features/occupant/services/ListAnomaliesByOccupantApiService";
import { listDysfonctionnementsByOccupantApiService } from "@/src/features/occupant/services/ListDysfonctionnementsByOccupantApiService";
import { listFuitesByOccupantApiService } from "@/src/features/occupant/services/ListFuitesByOccupantApiService";
import { listInterventionsByOccupantApiService } from "@/src/features/occupant/services/ListInterventionsByOccupantApiService";
import { listAlertesByOccupantApiService } from "@/src/features/occupant/services/ListAlertesByOccupantApiService";
import type { GetOccupantResponseDto } from "@/src/features/occupant/types/response/GetOccupantResponseDto";
import type { GetOccupantAccountResponseDto } from "@/src/features/occupant/types/response/GetOccupantAccountResponseDto";
import type { ShowRequestDto } from "@/src/features/occupant/types/request/ShowRequestDto";
import type { ShowInterventionRequestDto } from "@/src/features/occupant/types/request/ShowInterventionRequestDto";
import type { AnomaliesRequestDto } from "@/src/features/occupant/types/request/AnomaliesRequestDto";
import type { DysfunctionsRequestDto } from "@/src/features/occupant/types/request/DysfunctionsRequestDto";
import type { LeaksRequestDto } from "@/src/features/occupant/types/request/LeaksRequestDto";
import type { InterventionsRequestDto } from "@/src/features/occupant/types/request/InterventionsRequestDto";
import type { MyAccountRequestDto } from "@/src/features/occupant/types/request/MyAccountRequestDto";
import type { ListAnomaliesResponseDto } from "@/src/shared/types/response/ListAnomaliesResponseDto";
import type { ListDysfonctionnementsResponseDto } from "@/src/shared/types/response/ListDysfonctionnementsResponseDto";
import type { ListFuitesResponseDto } from "@/src/shared/types/response/ListFuitesResponseDto";
import type { ListInterventionsResponseDto } from "@/src/shared/types/response/ListInterventionsResponseDto";
import type { ListAlertesResponseDto } from "@/src/shared/types/response/ListAlertesResponseDto";

export interface UseOccupantReturn {
  // Main occupant data
  occupant: GetOccupantResponseDto | null;
  occupantLoading: boolean;
  occupantError: string | null;
  refetchOccupant: (force?: boolean) => Promise<void>;

  // Account data
  account: GetOccupantAccountResponseDto | null;
  accountLoading: boolean;
  accountError: string | null;
  refetchAccount: (force?: boolean) => Promise<void>;

  // Intervention data
  intervention: ListInterventionsResponseDto | null;
  interventionLoading: boolean;
  interventionError: string | null;
  refetchIntervention: (force?: boolean) => Promise<void>;

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

  // Interventions list data
  interventions: ListInterventionsResponseDto | null;
  interventionsLoading: boolean;
  interventionsError: string | null;
  refetchInterventions: (force?: boolean) => Promise<void>;

  // Alertes data
  alertes: ListAlertesResponseDto | null;
  alertesLoading: boolean;
  alertesError: string | null;
  refetchAlertes: (force?: boolean) => Promise<void>;

  // Combined states
  loading: boolean;
  error: string | null;
}

export interface UseOccupantOptions {
  pkOccupant?: string; // Required for most queries
  enabled?: boolean;
  // Options pour activer/désactiver chaque section
  loadOccupant?: boolean;
  loadAccount?: boolean;
  loadIntervention?: boolean;
  loadAnomalies?: boolean;
  loadDysfonctionnements?: boolean;
  loadFuites?: boolean;
  loadInterventions?: boolean;
  loadAlertes?: boolean;
  // Paramètres optionnels pour certains services
  interventionParams?: ShowInterventionRequestDto;
}

/**
 * Hook pour récupérer les données d'un occupant et ses données associées
 * Utilise le cache pour éviter les requêtes inutiles
 */
export function useOccupant(options?: UseOccupantOptions): UseOccupantReturn {
  const {
    pkOccupant,
    enabled = true,
    loadOccupant = false,
    loadAccount = false,
    loadIntervention = false,
    loadAnomalies = false,
    loadDysfonctionnements = false,
    loadFuites = false,
    loadInterventions = false,
    loadAlertes = false,
    interventionParams,
  } = options || {};

  // Main occupant data (requires pkOccupant)
  const showRequest: ShowRequestDto = {} as ShowRequestDto;
  const {
    data: occupant,
    loading: occupantLoading,
    error: occupantError,
    refetch: refetchOccupant,
  } = useCachedQuery<GetOccupantResponseDto>(
    () => {
      if (!pkOccupant) {
        throw new Error("pkOccupant is required for occupant data");
      }
      // Create a request object with pkOccupant
      const request = { pkOccupant } as ShowRequestDto & { pkOccupant: string };
      return getOccupantApiService.getOccupant(request);
    },
    {
      cacheKey: `occupant-${pkOccupant || "none"}`,
      enabled: enabled && loadOccupant && !!pkOccupant,
    }
  );

  // Account data (no pkOccupant required)
  const accountRequest: MyAccountRequestDto = {};
  const {
    data: account,
    loading: accountLoading,
    error: accountError,
    refetch: refetchAccount,
  } = useCachedQuery<GetOccupantAccountResponseDto>(
    () => getOccupantAccountApiService.getOccupantAccount(accountRequest),
    {
      cacheKey: "occupant-account",
      enabled: enabled && loadAccount,
    }
  );

  // Intervention data (requires pkOccupant and pkIntervention)
  const interventionRequest: (ShowInterventionRequestDto & { pkOccupant: string }) | null =
    interventionParams && pkOccupant
      ? { ...interventionParams, pkOccupant }
      : null;
  const {
    data: intervention,
    loading: interventionLoading,
    error: interventionError,
    refetch: refetchIntervention,
  } = useCachedQuery<ListInterventionsResponseDto>(
    () => {
      if (!interventionRequest) {
        throw new Error("pkOccupant and pkIntervention are required for intervention data");
      }
      return getOccupantInterventionApiService.getOccupantIntervention(interventionRequest);
    },
    {
      cacheKey: `occupant-${pkOccupant || "none"}-intervention-${interventionParams?.pkIntervention || "none"}`,
      enabled: enabled && loadIntervention && !!pkOccupant && !!interventionParams?.pkIntervention,
    }
  );

  // Anomalies data (requires pkOccupant)
  const anomaliesRequest: AnomaliesRequestDto = {};
  const {
    data: anomalies,
    loading: anomaliesLoading,
    error: anomaliesError,
    refetch: refetchAnomalies,
  } = useCachedQuery<ListAnomaliesResponseDto>(
    () => {
      if (!pkOccupant) {
        throw new Error("pkOccupant is required for anomalies data");
      }
      const request = { pkOccupant } as AnomaliesRequestDto & { pkOccupant: string };
      return listAnomaliesByOccupantApiService.listAnomaliesByOccupant(request);
    },
    {
      cacheKey: `occupant-${pkOccupant || "none"}-anomalies`,
      enabled: enabled && loadAnomalies && !!pkOccupant,
    }
  );

  // Dysfonctionnements data (requires pkOccupant)
  const dysfonctionnementsRequest: DysfunctionsRequestDto = {};
  const {
    data: dysfonctionnements,
    loading: dysfonctionnementsLoading,
    error: dysfonctionnementsError,
    refetch: refetchDysfonctionnements,
  } = useCachedQuery<ListDysfonctionnementsResponseDto>(
    () => {
      if (!pkOccupant) {
        throw new Error("pkOccupant is required for dysfonctionnements data");
      }
      const request = { pkOccupant } as DysfunctionsRequestDto & { pkOccupant: string };
      return listDysfonctionnementsByOccupantApiService.listDysfonctionnementsByOccupant(request);
    },
    {
      cacheKey: `occupant-${pkOccupant || "none"}-dysfonctionnements`,
      enabled: enabled && loadDysfonctionnements && !!pkOccupant,
    }
  );

  // Fuites data (requires pkOccupant)
  const fuitesRequest: LeaksRequestDto = {};
  const {
    data: fuites,
    loading: fuitesLoading,
    error: fuitesError,
    refetch: refetchFuites,
  } = useCachedQuery<ListFuitesResponseDto>(
    () => {
      if (!pkOccupant) {
        throw new Error("pkOccupant is required for fuites data");
      }
      const request = { pkOccupant } as LeaksRequestDto & { pkOccupant: string };
      return listFuitesByOccupantApiService.listFuitesByOccupant(request);
    },
    {
      cacheKey: `occupant-${pkOccupant || "none"}-fuites`,
      enabled: enabled && loadFuites && !!pkOccupant,
    }
  );

  // Interventions list data (requires pkOccupant)
  const interventionsRequest: InterventionsRequestDto = {};
  const {
    data: interventions,
    loading: interventionsLoading,
    error: interventionsError,
    refetch: refetchInterventions,
  } = useCachedQuery<ListInterventionsResponseDto>(
    () => {
      if (!pkOccupant) {
        throw new Error("pkOccupant is required for interventions data");
      }
      const request = { pkOccupant } as InterventionsRequestDto & { pkOccupant: string };
      return listInterventionsByOccupantApiService.listInterventionsByOccupant(request);
    },
    {
      cacheKey: `occupant-${pkOccupant || "none"}-interventions`,
      enabled: enabled && loadInterventions && !!pkOccupant,
    }
  );

  // Alertes data (requires pkOccupant)
  const {
    data: alertes,
    loading: alertesLoading,
    error: alertesError,
    refetch: refetchAlertes,
  } = useCachedQuery<ListAlertesResponseDto>(
    () => {
      if (!pkOccupant) {
        throw new Error("pkOccupant is required for alertes data");
      }
      const request = { pkOccupant } as ShowRequestDto & { pkOccupant: string };
      return listAlertesByOccupantApiService.listAlertesByOccupant(request);
    },
    {
      cacheKey: `occupant-${pkOccupant || "none"}-alertes`,
      enabled: enabled && loadAlertes && !!pkOccupant,
    }
  );

  // Combined states
  const loading =
    occupantLoading ||
    accountLoading ||
    interventionLoading ||
    anomaliesLoading ||
    dysfonctionnementsLoading ||
    fuitesLoading ||
    interventionsLoading ||
    alertesLoading;

  const error =
    occupantError ||
    accountError ||
    interventionError ||
    anomaliesError ||
    dysfonctionnementsError ||
    fuitesError ||
    interventionsError ||
    alertesError;

  return {
    // Main occupant
    occupant,
    occupantLoading,
    occupantError,
    refetchOccupant,

    // Account
    account,
    accountLoading,
    accountError,
    refetchAccount,

    // Intervention
    intervention,
    interventionLoading,
    interventionError,
    refetchIntervention,

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

    // Alertes
    alertes,
    alertesLoading,
    alertesError,
    refetchAlertes,

    // Combined
    loading,
    error,
  };
}

