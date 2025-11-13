"use client";

import { useExternalApiMutation } from "@/src/shared/hooks/useExternalApiMutation";
import { loginFromParamApiService } from "@/src/features/security/services/LoginFromParamApiService";
import type { LoginFromParamRequestDto } from "@/src/features/security/types/request/LoginFromParamRequestDto";
import type { LoginResponseDto } from "@/src/features/security/types/response/LoginResponseDto";
import type { ApiResponse } from "@/src/shared/types/api";

export interface UseLoginFromParamReturn {
  loginFromParam: {
    mutate: (data: LoginFromParamRequestDto) => Promise<void>;
    mutateAsync: (data: LoginFromParamRequestDto) => Promise<LoginResponseDto | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };
}

export interface UseLoginFromParamOptions {
  onSuccess?: (data: LoginResponseDto) => void;
  onError?: (error: string) => void;
}

/**
 * Hook pour l'authentification avec paramètre (login from param) sans JWT
 * Utilise useExternalApiMutation car le login ne nécessite pas d'authentification
 * @param options Options de configuration du hook
 */
export function useLoginFromParam(
  options?: UseLoginFromParamOptions
): UseLoginFromParamReturn {
  const { onSuccess, onError } = options || {};

  // Login from param mutation (POST)
  const loginFromParamMutation = useExternalApiMutation<
    LoginResponseDto,
    LoginFromParamRequestDto
  >(
    (data) => loginFromParamApiService.loginFromParam(data),
    {
      onSuccess: (data) => onSuccess?.(data),
      onError: (error, variables) => onError?.(error),
    }
  );

  // Helper function to convert ApiResponse<T> to T | null
  const createMutateAsync = (
    mutateAsync: (
      variables: LoginFromParamRequestDto
    ) => Promise<ApiResponse<LoginResponseDto>>
  ) => {
    return async (
      variables: LoginFromParamRequestDto
    ): Promise<LoginResponseDto | null> => {
      const response = await mutateAsync(variables);
      return response.success && response.data ? response.data : null;
    };
  };

  return {
    loginFromParam: {
      mutate: loginFromParamMutation.mutate,
      mutateAsync: createMutateAsync(loginFromParamMutation.mutateAsync),
      loading: loginFromParamMutation.loading,
      error: loginFromParamMutation.error,
      isSuccess: loginFromParamMutation.isSuccess,
      isError: loginFromParamMutation.isError,
      reset: loginFromParamMutation.reset,
    },
  };
}

