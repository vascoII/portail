"use client";

import { useCachedQuery } from "../shared/useCachedQuery";
import { listLogementsByImmeubleApiService } from "@/services/api/Immeuble/ListLogementsByImmeubleApiService";
import type { ListLogementsResponseDto } from "@/types/api/response/immeuble/ListLogementsResponseDto";
import type { GetInfosLogementsByImmeubleRequestDto } from "@/types/api/request/Immeuble/GetInfosLogementsByImmeubleRequestDto";

export interface UseLogementsReturn {
  data: ListLogementsResponseDto | null;
  loading: boolean;
  error: string | null;
  lastUpdated?: string;
  refetch: (force?: boolean) => Promise<void>;
  isSuccess: boolean;
  isError: boolean;
  isStale: boolean;
}

export interface UseLogementsOptions {
  pkImmeuble: string;
  enabled?: boolean;
  paramsFiltres?: string;
  paramsInfos?: string;
  cacheKey?: string;
}

/**
 * Hook pour récupérer la liste des logements d'un immeuble
 * Utilise le cache pour éviter les requêtes inutiles
 * @param options Options de configuration du hook
 */
export function useLogements(
  options: UseLogementsOptions
): UseLogementsReturn {
  const {
    pkImmeuble,
    enabled = true,
    paramsFiltres = "",
    paramsInfos = "",
    cacheKey,
  } = options;

  const requestDto: GetInfosLogementsByImmeubleRequestDto = {
    pkImmeuble,
    paramsFiltres,
    paramsInfos,
  };

  const {
    data,
    loading,
    error,
    lastUpdated,
    refetch,
    isSuccess,
    isError,
    isStale,
  } = useCachedQuery<ListLogementsResponseDto>(
    () =>
      listLogementsByImmeubleApiService.listLogementsByImmeuble(requestDto),
    {
      cacheKey: cacheKey || `logements-by-immeuble-${pkImmeuble}`,
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
