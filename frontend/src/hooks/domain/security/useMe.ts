"use client";

import { useApiQuery } from "../../shared/useApiQuery";
import { meApiService } from "@/services/api/Security/MeApiService";
import type { UserResponseDto } from "@/types/api/response/shared/UserResponseDto";

export interface UseMeReturn {
  user: UserResponseDto | null;
  loading: boolean;
  error: string | null;
  lastUpdated?: string;
  refetch: () => Promise<void>;
  isSuccess: boolean;
  isError: boolean;
}

export interface UseMeOptions {
  enabled?: boolean;
  onSuccess?: (data: UserResponseDto) => void;
  onError?: (error: string) => void;
}

/**
 * Hook pour récupérer les données de l'utilisateur connecté (me) avec JWT
 * Utilise useApiQuery car le endpoint nécessite une authentification
 * @param options Options de configuration du hook
 */
export function useMe(options?: UseMeOptions): UseMeReturn {
  const { enabled = true, onSuccess, onError } = options || {};

  const {
    data: user,
    loading,
    error,
    lastUpdated,
    refetch,
    isSuccess,
    isError,
  } = useApiQuery<UserResponseDto>(
    () => meApiService.me(),
    {
      enabled,
      onSuccess,
      onError,
    }
  );

  return {
    user,
    loading,
    error,
    lastUpdated,
    refetch,
    isSuccess,
    isError,
  };
}

