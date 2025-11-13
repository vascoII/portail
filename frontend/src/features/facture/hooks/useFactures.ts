"use client";

import { useCachedQuery } from "@/src/shared/hooks/useCachedQuery";
import { listFacturesApiService } from "@/src/features/facture/services/ListFacturesApiService";
import type { ListFacturesResponseDto } from "@/src/features/facture/types/response/ListFacturesResponseDto";

export interface UseFacturesReturn {
  data: ListFacturesResponseDto | null;
  loading: boolean;
  error: string | null;
  lastUpdated?: string;
  refetch: (force?: boolean) => Promise<void>;
  isSuccess: boolean;
  isError: boolean;
  isStale: boolean;
}

export interface UseFacturesOptions {
  enabled?: boolean;
  filters?: Record<string, string | number>;
  cacheKey?: string;
}

/**
 * Hook pour récupérer la liste des factures
 * Utilise le cache pour éviter les requêtes inutiles
 * @param options Options de configuration du hook
 */
export function useFactures(
  options?: UseFacturesOptions
): UseFacturesReturn {
  const {
    enabled = true,
    filters,
    cacheKey = "factures-list",
  } = options || {};

  const {
    data,
    loading,
    error,
    lastUpdated,
    refetch,
    isSuccess,
    isError,
    isStale,
  } = useCachedQuery<ListFacturesResponseDto>(
    () => listFacturesApiService.listFactures(filters),
    {
      cacheKey,
      enabled,
    }
  );

  return {
    data,
    loading,
    error,
    lastUpdated,
    refetch,
    isSuccess,
    isError,
    isStale,
  };
}

