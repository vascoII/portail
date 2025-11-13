"use client";

import { useCachedQuery } from "@/src/shared/hooks/useCachedQuery";
import { getOperatorApiService } from "@/src/features/operator/services/GetOperatorApiService";
import { getOperatorStatApiService } from "@/src/features/operator/services/GetOperatorStatApiService";
import { listOperatorsApiService } from "@/src/features/operator/services/ListOperatorsApiService";
import type { GetOperatorResponseDto } from "@/src/features/operator/types/response/GetOperatorResponseDto";
import type { ListOperatorsResponseDto } from "@/src/features/operator/types/response/ListOperatorsResponseDto";
import type { GetByIdIntRequestDto } from "@/src/shared/types/request/GetByIdIntRequestDto";
import type { ListOperatorsRequestDto } from "@/src/features/operator/types/request/ListOperatorsRequestDto";

export interface UseOperatorReturn {
  // Main operator data
  operator: GetOperatorResponseDto | null;
  operatorLoading: boolean;
  operatorError: string | null;
  refetchOperator: (force?: boolean) => Promise<void>;

  // Operator stat data
  stat: any | null;
  statLoading: boolean;
  statError: string | null;
  refetchStat: (force?: boolean) => Promise<void>;

  // Operators list data
  operators: ListOperatorsResponseDto | null;
  operatorsLoading: boolean;
  operatorsError: string | null;
  refetchOperators: (force?: boolean) => Promise<void>;

  // Combined states
  loading: boolean;
  error: string | null;
}

export interface UseOperatorOptions {
  operatorId?: number; // Required for getOperator and getOperatorStat
  enabled?: boolean;
  // Options pour activer/désactiver chaque section
  loadOperator?: boolean;
  loadStat?: boolean;
  loadOperators?: boolean;
  // Paramètres optionnels pour certains services
  operatorsFilters?: ListOperatorsRequestDto;
}

/**
 * Hook pour récupérer les données d'un opérateur et ses données associées
 * Utilise le cache pour éviter les requêtes inutiles
 */
export function useOperator(options?: UseOperatorOptions): UseOperatorReturn {
  const {
    operatorId,
    enabled = true,
    loadOperator = false,
    loadStat = false,
    loadOperators = false,
    operatorsFilters,
  } = options || {};

  // Main operator data (requires operatorId)
  const operatorRequest: GetByIdIntRequestDto | null = operatorId
    ? { id: operatorId }
    : null;
  const {
    data: operator,
    loading: operatorLoading,
    error: operatorError,
    refetch: refetchOperator,
  } = useCachedQuery<GetOperatorResponseDto>(
    () => {
      if (!operatorRequest) {
        throw new Error("operatorId is required for operator data");
      }
      return getOperatorApiService.getOperator(operatorRequest);
    },
    {
      cacheKey: `operator-${operatorId || "none"}`,
      enabled: enabled && loadOperator && !!operatorId,
    }
  );

  // Operator stat data (requires operatorId)
  const statRequest: GetByIdIntRequestDto | null = operatorId
    ? { id: operatorId }
    : null;
  const {
    data: stat,
    loading: statLoading,
    error: statError,
    refetch: refetchStat,
  } = useCachedQuery<any>(
    () => {
      if (!statRequest) {
        throw new Error("operatorId is required for stat data");
      }
      return getOperatorStatApiService.getOperatorStat(statRequest);
    },
    {
      cacheKey: `operator-${operatorId || "none"}-stat`,
      enabled: enabled && loadStat && !!operatorId,
    }
  );

  // Operators list data (no operatorId required)
  const {
    data: operators,
    loading: operatorsLoading,
    error: operatorsError,
    refetch: refetchOperators,
  } = useCachedQuery<ListOperatorsResponseDto>(
    () => listOperatorsApiService.listOperators(operatorsFilters),
    {
      cacheKey: "operators-list",
      enabled: enabled && loadOperators,
    }
  );

  // Combined states
  const loading = operatorLoading || statLoading || operatorsLoading;

  const error = operatorError || statError || operatorsError;

  return {
    // Main operator
    operator,
    operatorLoading,
    operatorError,
    refetchOperator,

    // Stat
    stat,
    statLoading,
    statError,
    refetchStat,

    // Operators list
    operators,
    operatorsLoading,
    operatorsError,
    refetchOperators,

    // Combined
    loading,
    error,
  };
}

