"use client";

import { useExternalApiMutation } from "@/src/shared/hooks/useExternalApiMutation";
import { loginApiService } from "@/src/features/security/services/LoginApiService";
import type { LoginRequestDto } from "@/src/features/security/types/request/LoginRequestDto";
import type { LoginResponseDto } from "@/src/features/security/types/response/LoginResponseDto";
import type { ApiResponse } from "@/src/shared/types/api";

export interface UseLoginReturn {
  login: {
    mutate: (data: LoginRequestDto) => Promise<void>;
    mutateAsync: (data: LoginRequestDto) => Promise<LoginResponseDto | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };
}

export interface UseLoginOptions {
  onSuccess?: (data: LoginResponseDto) => void;
  onError?: (error: string) => void;
}

/**
 * Hook pour l'authentification (login) sans JWT
 * Utilise useExternalApiMutation car le login ne nécessite pas d'authentification
 * @param options Options de configuration du hook
 */
export function useLogin(options?: UseLoginOptions): UseLoginReturn {
  const { onSuccess, onError } = options || {};

  // Login mutation (POST)
  const loginMutation = useExternalApiMutation<LoginResponseDto, LoginRequestDto>(
    (data) => loginApiService.login(data),
    {
      onSuccess: (data) => onSuccess?.(data),
      onError: (error, variables) => onError?.(error),
    }
  );

  // Helper function to convert ApiResponse<T> to T | null
  const createMutateAsync = (
    mutateAsync: (variables: LoginRequestDto) => Promise<ApiResponse<LoginResponseDto>>
  ) => {
    return async (variables: LoginRequestDto): Promise<LoginResponseDto | null> => {
      const response = await mutateAsync(variables);
      return response.success && response.data ? response.data : null;
    };
  };

  return {
    login: {
      mutate: loginMutation.mutate,
      mutateAsync: createMutateAsync(loginMutation.mutateAsync),
      loading: loginMutation.loading,
      error: loginMutation.error,
      isSuccess: loginMutation.isSuccess,
      isError: loginMutation.isError,
      reset: loginMutation.reset,
    },
  };
}

