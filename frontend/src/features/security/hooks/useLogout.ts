"use client";

import { useApiMutation } from "@/src/shared/hooks/useApiMutation";
import { logoutApiService } from "@/src/features/security/services/LogoutApiService";
import type { LogoutRequestDto } from "@/src/features/security/types/request/LogoutRequestDto";
import type { LogoutResponseDto } from "@/src/features/security/types/response/LogoutResponseDto";
import type { ApiResponse } from "@/src/shared/types/api";

export interface UseLogoutReturn {
  logout: {
    mutate: () => Promise<void>;
    mutateAsync: () => Promise<LogoutResponseDto | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };
}

export interface UseLogoutOptions {
  onSuccess?: (data: LogoutResponseDto) => void;
  onError?: (error: string) => void;
}

/**
 * Hook pour la déconnexion (logout) avec JWT
 * Utilise useApiMutation car le logout nécessite une authentification
 * @param options Options de configuration du hook
 */
export function useLogout(options?: UseLogoutOptions): UseLogoutReturn {
  const { onSuccess, onError } = options || {};

  // Logout mutation (POST)
  // LogoutRequestDto est vide, donc on passe un objet vide
  const logoutMutation = useApiMutation<LogoutResponseDto, LogoutRequestDto>(
    () => logoutApiService.logout({}),
    {
      onSuccess: (data) => onSuccess?.(data),
      onError: (error, variables) => onError?.(error),
    }
  );

  // Helper function to convert ApiResponse<T> to T | null
  const createMutateAsync = () => {
    return async (): Promise<LogoutResponseDto | null> => {
      const response = await logoutMutation.mutateAsync({});
      return response.success && response.data ? response.data : null;
    };
  };

  return {
    logout: {
      mutate: async () => {
        await logoutMutation.mutate({});
      },
      mutateAsync: createMutateAsync(),
      loading: logoutMutation.loading,
      error: logoutMutation.error,
      isSuccess: logoutMutation.isSuccess,
      isError: logoutMutation.isError,
      reset: logoutMutation.reset,
    },
  };
}

