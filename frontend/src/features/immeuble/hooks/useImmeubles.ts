"use client";

import { useCachedQuery } from "@/src/shared/hooks/useCachedQuery";
import { listImmeublesApiService } from "@/src/features/immeuble/services/ListImmeublesApiService";
import type { ListImmeublesResponseDto } from "@/src/features/immeuble/types/response/ListImmeublesResponseDto";
import type { IndexRequestDto } from "@/src/features/immeuble/types/request/IndexRequestDto";

export interface UseImmeublesReturn {
  data: ListImmeublesResponseDto | null;
  loading: boolean;
  error: string | null;
  lastUpdated?: string;
  refetch: (force?: boolean) => Promise<void>;
  isSuccess: boolean;
  isError: boolean;
  isStale: boolean;
}

export interface UseImmeublesOptions {
  enabled?: boolean;
  filters?: IndexRequestDto;
  cacheKey?: string;
}

/**
 * Hook pour récupérer la liste des immeubles
 * Utilise le cache pour éviter les requêtes inutiles
 * @param options Options de configuration du hook
 */
export function useImmeubles(
  options?: UseImmeublesOptions
): UseImmeublesReturn {
  const {
    enabled = true,
    filters,
    cacheKey = "immeubles-list",
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
  } = useCachedQuery<ListImmeublesResponseDto>(
    () => listImmeublesApiService.listImmeubles(filters),
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

