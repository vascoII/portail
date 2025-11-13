"use client";

import { useCachedQuery } from "../../shared/useCachedQuery";
import { getParcApiService } from "@/services/api/Parc/GetParcApiService";
import type { GetParcResponseDto } from "@/types/api/response/parc/GetParcResponseDto";

export interface UseParcReturn {
  data: GetParcResponseDto | null;
  loading: boolean;
  error: string | null;
  lastUpdated?: string;
  refetch: (force?: boolean) => Promise<void>;
  isSuccess: boolean;
  isError: boolean;
  isStale: boolean;
}

export interface UseParcOptions {
  enabled?: boolean;
  cacheKey?: string;
}

/**
 * Hook pour récupérer les données du parc (portfolio)
 * Utilise le cache pour éviter les requêtes inutiles
 * @param options Options de configuration du hook
 */
export function useParc(options?: UseParcOptions): UseParcReturn {
  const { enabled = true, cacheKey = "parc-data" } = options || {};

  const {
    data,
    loading,
    error,
    lastUpdated,
    refetch,
    isSuccess,
    isError,
    isStale,
  } = useCachedQuery<GetParcResponseDto>(() => getParcApiService.getParc(), {
    cacheKey,
    enabled,
  });

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
