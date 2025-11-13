"use client";

import { useApiMutation } from "@/src/shared/hooks/useApiMutation";
import { updatePasswordApiService } from "@/src/features/security/services/UpdatePasswordApiService";
import type { UpdatePasswordRequestDto } from "@/src/features/security/types/request/UpdatePasswordRequestDto";
import type { UpdatePasswordResponseDto } from "@/src/features/security/types/response/UpdatePasswordResponseDto";
import type { ApiResponse } from "@/src/shared/types/api";

export interface UseUpdatePasswordReturn {
  updatePassword: {
    mutate: (data: UpdatePasswordRequestDto) => Promise<void>;
    mutateAsync: (data: UpdatePasswordRequestDto) => Promise<UpdatePasswordResponseDto | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };
}

export interface UseUpdatePasswordOptions {
  onSuccess?: (data: UpdatePasswordResponseDto) => void;
  onError?: (error: string) => void;
}

/**
 * Hook pour mettre à jour le mot de passe avec JWT
 * Utilise useApiMutation car le endpoint nécessite une authentification
 * @param options Options de configuration du hook
 */
export function useUpdatePassword(
  options?: UseUpdatePasswordOptions
): UseUpdatePasswordReturn {
  const { onSuccess, onError } = options || {};

  // Update Password mutation (PUT)
  const updatePasswordMutation = useApiMutation<
    UpdatePasswordResponseDto,
    UpdatePasswordRequestDto
  >(
    (data) => updatePasswordApiService.updatePassword(data),
    {
      onSuccess: (data) => onSuccess?.(data),
      onError: (error, variables) => onError?.(error),
    }
  );

  // Helper function to convert ApiResponse<T> to T | null
  const createMutateAsync = (
    mutateAsync: (
      variables: UpdatePasswordRequestDto
    ) => Promise<ApiResponse<UpdatePasswordResponseDto>>
  ) => {
    return async (
      variables: UpdatePasswordRequestDto
    ): Promise<UpdatePasswordResponseDto | null> => {
      const response = await mutateAsync(variables);
      return response.success && response.data ? response.data : null;
    };
  };

  return {
    updatePassword: {
      mutate: updatePasswordMutation.mutate,
      mutateAsync: createMutateAsync(updatePasswordMutation.mutateAsync),
      loading: updatePasswordMutation.loading,
      error: updatePasswordMutation.error,
      isSuccess: updatePasswordMutation.isSuccess,
      isError: updatePasswordMutation.isError,
      reset: updatePasswordMutation.reset,
    },
  };
}

