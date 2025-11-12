"use client";

import { useApiMutation } from "../shared/useApiMutation";
import { postOccupantApiService } from "@/services/api/Occupant/PostOccupantApiService";
import { patchOccupantApiService } from "@/services/api/Occupant/PatchOccupantApiService";
import type { ApiResponse } from "@/types/api";
import type { PostOccupantRequestDto } from "@/types/api/request/Occupant/PostOccupantRequestDto";
import type { PatchOccupantRequestDto } from "@/types/api/request/Occupant/PatchOccupantRequestDto";
import type { SuccessResponseDto } from "@/types/api/response/shared/SuccessResponseDto";

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

