"use client";

import { useApiMutation } from "@/src/shared/hooks/useApiMutation";
import { postOccupantApiService } from "@/src/features/occupant/services/PostOccupantApiService";
import { patchOccupantApiService } from "@/src/features/occupant/services/PatchOccupantApiService";
import type { ApiResponse } from "@/src/shared/types/api";
import type { PostOccupantRequestDto } from "@/src/features/occupant/types/request/PostOccupantRequestDto";
import type { PatchOccupantRequestDto } from "@/src/features/occupant/types/request/PatchOccupantRequestDto";
import type { SuccessResponseDto } from "@/src/shared/types/response/SuccessResponseDto";

export interface UseOccupantMutationReturn {
  // Create Occupant (POST)
  createOccupant: {
    mutate: (data: PostOccupantRequestDto) => Promise<void>;
    mutateAsync: (data: PostOccupantRequestDto) => Promise<SuccessResponseDto | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };

  // Update Occupant (PATCH)
  updateOccupant: {
    mutate: (data: PatchOccupantRequestDto) => Promise<void>;
    mutateAsync: (data: PatchOccupantRequestDto) => Promise<SuccessResponseDto | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };
}

export interface UseOccupantMutationOptions {
  onSuccess?: (data: SuccessResponseDto, type: "create" | "update") => void;
  onError?: (error: string, type: "create" | "update") => void;
}

/**
 * Hook pour les mutations d'occupant (création et mise à jour)
 * Utilise useApiMutation pour chaque type de mutation
 * @param options Options de configuration du hook
 */
export function useOccupantMutation(
  options?: UseOccupantMutationOptions
): UseOccupantMutationReturn {
  const { onSuccess, onError } = options || {};

  // Create Occupant (POST)
  const createMutation = useApiMutation<SuccessResponseDto, PostOccupantRequestDto>(
    (data) => postOccupantApiService.postOccupant(data),
    {
      onSuccess: (data) => onSuccess?.(data, "create"),
      onError: (error, variables) => onError?.(error, "create"),
    }
  );

  // Update Occupant (PATCH)
  const updateMutation = useApiMutation<SuccessResponseDto, PatchOccupantRequestDto>(
    (data) => patchOccupantApiService.patchOccupant(data),
    {
      onSuccess: (data) => onSuccess?.(data, "update"),
      onError: (error, variables) => onError?.(error, "update"),
    }
  );

  // Helper function to convert ApiResponse<T> to T | null
  const createMutateAsync = <T extends any>(
    mutateAsync: (variables: T) => Promise<ApiResponse<SuccessResponseDto>>
  ) => {
    return async (variables: T): Promise<SuccessResponseDto | null> => {
      const response = await mutateAsync(variables);
      return response.success && response.data ? response.data : null;
    };
  };

  return {
    createOccupant: {
      mutate: createMutation.mutate,
      mutateAsync: createMutateAsync(createMutation.mutateAsync),
      loading: createMutation.loading,
      error: createMutation.error,
      isSuccess: createMutation.isSuccess,
      isError: createMutation.isError,
      reset: createMutation.reset,
    },
    updateOccupant: {
      mutate: updateMutation.mutate,
      mutateAsync: createMutateAsync(updateMutation.mutateAsync),
      loading: updateMutation.loading,
      error: updateMutation.error,
      isSuccess: updateMutation.isSuccess,
      isError: updateMutation.isError,
      reset: updateMutation.reset,
    },
  };
}

