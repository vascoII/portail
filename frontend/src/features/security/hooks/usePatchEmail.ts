"use client";

import { useApiMutation } from "@/src/shared/hooks/useApiMutation";
import { patchEmailApiService } from "@/src/features/security/services/PatchEmailApiService";
import type { PatchEmailRequestDto } from "@/src/features/security/types/request/PatchEmailRequestDto";
import type { SuccessResponseDto } from "@/src/shared/types/response/SuccessResponseDto";
import type { ApiResponse } from "@/src/shared/types/api";

export interface UsePatchEmailReturn {
  patchEmail: {
    mutate: (data: PatchEmailRequestDto) => Promise<void>;
    mutateAsync: (data: PatchEmailRequestDto) => Promise<SuccessResponseDto | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };
}

export interface UsePatchEmailOptions {
  onSuccess?: (data: SuccessResponseDto) => void;
  onError?: (error: string) => void;
}

/**
 * Hook pour mettre à jour l'email de l'utilisateur avec JWT
 * Utilise useApiMutation car le endpoint nécessite une authentification
 * @param options Options de configuration du hook
 */
export function usePatchEmail(options?: UsePatchEmailOptions): UsePatchEmailReturn {
  const { onSuccess, onError } = options || {};

  // Patch Email mutation (PATCH)
  const patchEmailMutation = useApiMutation<
    SuccessResponseDto,
    PatchEmailRequestDto
  >(
    (data) => patchEmailApiService.patchEmail(data),
    {
      onSuccess: (data) => onSuccess?.(data),
      onError: (error, variables) => onError?.(error),
    }
  );

  // Helper function to convert ApiResponse<T> to T | null
  const createMutateAsync = (
    mutateAsync: (
      variables: PatchEmailRequestDto
    ) => Promise<ApiResponse<SuccessResponseDto>>
  ) => {
    return async (
      variables: PatchEmailRequestDto
    ): Promise<SuccessResponseDto | null> => {
      const response = await mutateAsync(variables);
      return response.success && response.data ? response.data : null;
    };
  };

  return {
    patchEmail: {
      mutate: patchEmailMutation.mutate,
      mutateAsync: createMutateAsync(patchEmailMutation.mutateAsync),
      loading: patchEmailMutation.loading,
      error: patchEmailMutation.error,
      isSuccess: patchEmailMutation.isSuccess,
      isError: patchEmailMutation.isError,
      reset: patchEmailMutation.reset,
    },
  };
}

