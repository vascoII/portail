"use client";

import { useCachedQuery } from "@/src/shared//hooks/useCachedQuery";
import { meApiService } from "@/src/features/security/services/MeApiService";
import type { UserResponseDto } from "@/src/shared/types/response/UserResponseDto";

export interface UseUserReturn {
  user: UserResponseDto | null;
  loading: boolean;
  error: string | null;
  lastUpdated?: string;
  refetch: (force?: boolean) => Promise<void>;
  isSuccess: boolean;
  isError: boolean;
  isStale: boolean;
}

/**
 * Hook pour récupérer les données de l'utilisateur connecté
 * Utilise le cache pour éviter les requêtes inutiles
 */
export function useUser(): UseUserReturn {
  const {
    data: user,
    loading,
    error,
    lastUpdated,
    refetch,
    isSuccess,
    isError,
    isStale,
  } = useCachedQuery<UserResponseDto>(() => meApiService.me(), {
    cacheKey: "user-data",
    enabled: true,
  });

  return {
    user,
    loading,
    error,
    lastUpdated,
    refetch,
    isSuccess,
    isError,
    isStale,
  };
}
