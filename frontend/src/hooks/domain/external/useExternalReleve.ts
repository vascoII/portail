"use client";

import { useExternalApiMutation } from "../../shared/useExternalApiMutation";
import { generateReleveApiService } from "@/services/api/External/Releve/GenerateReleveApiService";
import type { GenerateReleveRequestDto } from "@/types/api/request/Releve/GenerateReleveRequestDto";
import type { ApiResponse } from "@/types/api";

export interface UseExternalReleveReturn {
  // Generate Releve (POST)
  generateReleve: {
    mutate: (data: GenerateReleveRequestDto) => Promise<void>;
    mutateAsync: (data: GenerateReleveRequestDto) => Promise<Blob | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };
}

export interface UseExternalReleveOptions {
  onSuccess?: (data: Blob) => void;
  onError?: (error: string) => void;
}

/**
 * Hook pour les opérations de relevé externe (sans JWT)
 * Utilise useExternalApiMutation pour les appels sans authentification
 * @param options Options de configuration du hook
 */
export function useExternalReleve(
  options?: UseExternalReleveOptions
): UseExternalReleveReturn {
  const { onSuccess, onError } = options || {};

  // Generate Releve (POST)
  const generateMutation = useExternalApiMutation<Blob, GenerateReleveRequestDto>(
    (data) => generateReleveApiService.generateReleve(data),
    {
      onSuccess: (data) => onSuccess?.(data),
      onError: (error, variables) => onError?.(error),
    }
  );

  // Helper function to convert ApiResponse<Blob> to Blob | null
  const createMutateAsync = (
    mutateAsync: (
      variables: GenerateReleveRequestDto
    ) => Promise<ApiResponse<Blob>>
  ) => {
    return async (
      variables: GenerateReleveRequestDto
    ): Promise<Blob | null> => {
      const response = await mutateAsync(variables);
      return response.success && response.data ? response.data : null;
    };
  };

  return {
    generateReleve: {
      mutate: generateMutation.mutate,
      mutateAsync: createMutateAsync(generateMutation.mutateAsync),
      loading: generateMutation.loading,
      error: generateMutation.error,
      isSuccess: generateMutation.isSuccess,
      isError: generateMutation.isError,
      reset: generateMutation.reset,
    },
  };
}

