"use client";

import { useCachedQuery } from "../shared/useCachedQuery";
import { listImmeublesApiService } from "@/services/api/Immeuble/ListImmeublesApiService";
import type { ListImmeublesResponseDto } from "@/types/api/response/immeuble/ListImmeublesResponseDto";
import type { IndexRequestDto } from "@/types/api/request/Immeuble/IndexRequestDto";

export interface UseLogementsReturn {
  data: ListImmeublesResponseDto | null;
  loading: boolean;
  error: string | null;
  lastUpdated?: string;
  refetch: (force?: boolean) => Promise<void>;
  isSuccess: boolean;
  isError: boolean;
  isStale: boolean;
}

export interface UseLogementsOptions {
  enabled?: boolean;
  filters?: IndexRequestDto;
  cacheKey?: string;
}

/**
 * Hook pour récupérer la liste des immeubles
 * Utilise le cache pour éviter les requêtes inutiles
 * @param options Options de configuration du hook
 */
export function useLogements(
  options?: UseLogementsOptions
): UseLogementsReturn {
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

