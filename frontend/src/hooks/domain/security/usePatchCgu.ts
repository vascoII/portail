"use client";

import { useApiMutation } from "../../shared/useApiMutation";
import { patchCguApiService } from "@/services/api/Security/PatchCguApiService";
import type { UpdateCGUFromPKUserRequestDto } from "@/types/api/request/Security/UpdateCGUFromPKUserRequestDto";
import type { SuccessResponseDto } from "@/types/api/response/shared/SuccessResponseDto";
import type { ApiResponse } from "@/types/api";

export interface UsePatchCguReturn {
  patchCgu: {
    mutate: (data: UpdateCGUFromPKUserRequestDto) => Promise<void>;
    mutateAsync: (data: UpdateCGUFromPKUserRequestDto) => Promise<SuccessResponseDto | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };
}

export interface UsePatchCguOptions {
  onSuccess?: (data: SuccessResponseDto) => void;
  onError?: (error: string) => void;
}

/**
 * Hook pour mettre à jour les CGU (Conditions Générales d'Utilisation) avec JWT
 * Utilise useApiMutation car le endpoint nécessite une authentification
 * @param options Options de configuration du hook
 */
export function usePatchCgu(options?: UsePatchCguOptions): UsePatchCguReturn {
  const { onSuccess, onError } = options || {};

  // Patch CGU mutation (PATCH)
  const patchCguMutation = useApiMutation<
    SuccessResponseDto,
    UpdateCGUFromPKUserRequestDto
  >(
    (data) => patchCguApiService.patchCgu(data),
    {
      onSuccess: (data) => onSuccess?.(data),
      onError: (error, variables) => onError?.(error),
    }
  );

  // Helper function to convert ApiResponse<T> to T | null
  const createMutateAsync = (
    mutateAsync: (
      variables: UpdateCGUFromPKUserRequestDto
    ) => Promise<ApiResponse<SuccessResponseDto>>
  ) => {
    return async (
      variables: UpdateCGUFromPKUserRequestDto
    ): Promise<SuccessResponseDto | null> => {
      const response = await mutateAsync(variables);
      return response.success && response.data ? response.data : null;
    };
  };

  return {
    patchCgu: {
      mutate: patchCguMutation.mutate,
      mutateAsync: createMutateAsync(patchCguMutation.mutateAsync),
      loading: patchCguMutation.loading,
      error: patchCguMutation.error,
      isSuccess: patchCguMutation.isSuccess,
      isError: patchCguMutation.isError,
      reset: patchCguMutation.reset,
    },
  };
}

