"use client";

import { useExternalApiMutation } from "../../shared/useExternalApiMutation";
import { resetPasswordApiService } from "@/services/api/Security/ResetPasswordApiService";
import type { ResetPasswordRequestDto } from "@/types/api/request/Security/ResetPasswordRequestDto";
import type { ResetPasswordResponseDto } from "@/types/api/response/security/ResetPasswordResponseDto";
import type { ApiResponse } from "@/types/api";

export interface UseResetPasswordReturn {
  resetPassword: {
    mutate: (data: ResetPasswordRequestDto) => Promise<void>;
    mutateAsync: (data: ResetPasswordRequestDto) => Promise<ResetPasswordResponseDto | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };
}

export interface UseResetPasswordOptions {
  onSuccess?: (data: ResetPasswordResponseDto) => void;
  onError?: (error: string) => void;
}

/**
 * Hook pour réinitialiser le mot de passe sans JWT
 * Utilise useExternalApiMutation car le reset password ne nécessite pas d'authentification
 * @param options Options de configuration du hook
 */
export function useResetPassword(
  options?: UseResetPasswordOptions
): UseResetPasswordReturn {
  const { onSuccess, onError } = options || {};

  // Reset Password mutation (POST)
  const resetPasswordMutation = useExternalApiMutation<
    ResetPasswordResponseDto,
    ResetPasswordRequestDto
  >(
    (data) => resetPasswordApiService.resetPassword(data),
    {
      onSuccess: (data) => onSuccess?.(data),
      onError: (error, variables) => onError?.(error),
    }
  );

  // Helper function to convert ApiResponse<T> to T | null
  const createMutateAsync = (
    mutateAsync: (
      variables: ResetPasswordRequestDto
    ) => Promise<ApiResponse<ResetPasswordResponseDto>>
  ) => {
    return async (
      variables: ResetPasswordRequestDto
    ): Promise<ResetPasswordResponseDto | null> => {
      const response = await mutateAsync(variables);
      return response.success && response.data ? response.data : null;
    };
  };

  return {
    resetPassword: {
      mutate: resetPasswordMutation.mutate,
      mutateAsync: createMutateAsync(resetPasswordMutation.mutateAsync),
      loading: resetPasswordMutation.loading,
      error: resetPasswordMutation.error,
      isSuccess: resetPasswordMutation.isSuccess,
      isError: resetPasswordMutation.isError,
      reset: resetPasswordMutation.reset,
    },
  };
}

