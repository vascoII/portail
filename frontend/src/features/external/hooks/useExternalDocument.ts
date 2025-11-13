"use client";

import { useExternalApiQuery } from "@/src/shared/hooks/useExternalApiQuery";
import { useExternalApiMutation } from "@/src/shared/hooks/useExternalApiMutation";
import { generateReportByTokenPdfApiService } from "@/src/features/external/services/document/GenerateReportByTokenPdfApiService";
import { receiveGeneratedDocumentApiService } from "@/src/features/external/services/document/ReceiveGeneratedDocumentApiService";
import type { GenerateReportByTokenDocumentRequestDto } from "@/src/features/external/types/request/GenerateReportByTokenDocumentRequestDto";
import type { GeneratedDocumentResponseDto } from "@/src/features/external/types/response/GeneratedDocumentResponseDto";
import type { ApiResponse } from "@/src/shared/types/api";

export interface UseExternalDocumentReturn {
  // Receive Generated Document (GET)
  receiveGeneratedDocument: {
    data: GeneratedDocumentResponseDto | null;
    loading: boolean;
    error: string | null;
    lastUpdated?: string;
    refetch: () => Promise<void>;
    isSuccess: boolean;
    isError: boolean;
  };

  // Generate Report By Token PDF (POST)
  generateReportByTokenPdf: {
    mutate: (data: GenerateReportByTokenDocumentRequestDto) => Promise<void>;
    mutateAsync: (
      data: GenerateReportByTokenDocumentRequestDto
    ) => Promise<Blob | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };
}

export interface UseExternalDocumentOptions {
  token?: string; // Required for receiveGeneratedDocument
  enabled?: boolean;
  onSuccess?: (data: any, type: "receive" | "generate") => void;
  onError?: (error: string, type: "receive" | "generate") => void;
}

/**
 * Hook pour les opérations de documents externes (sans JWT)
 * Utilise useExternalApiQuery et useExternalApiMutation pour les appels sans authentification
 * @param options Options de configuration du hook
 */
export function useExternalDocument(
  options?: UseExternalDocumentOptions
): UseExternalDocumentReturn {
  const { token, enabled = true, onSuccess, onError } = options || {};

  // Receive Generated Document (GET)
  const {
    data: receiveData,
    loading: receiveLoading,
    error: receiveError,
    lastUpdated: receiveLastUpdated,
    refetch: receiveRefetch,
    isSuccess: receiveIsSuccess,
    isError: receiveIsError,
  } = useExternalApiQuery<GeneratedDocumentResponseDto>(
    () => {
      if (!token) {
        throw new Error("token is required for receiveGeneratedDocument");
      }
      return receiveGeneratedDocumentApiService.receiveGeneratedDocument(token);
    },
    {
      enabled: enabled && !!token,
      onSuccess: (data) => onSuccess?.(data, "receive"),
      onError: (error) => onError?.(error, "receive"),
    }
  );

  // Generate Report By Token PDF (POST)
  const generateMutation = useExternalApiMutation<
    Blob,
    GenerateReportByTokenDocumentRequestDto
  >(
    (data) => generateReportByTokenPdfApiService.generateReportByTokenPdf(data),
    {
      onSuccess: (data) => onSuccess?.(data, "generate"),
      onError: (error, variables) => onError?.(error, "generate"),
    }
  );

  // Helper function to convert ApiResponse<Blob> to Blob | null
  const createMutateAsync = <T extends any>(
    mutateAsync: (variables: T) => Promise<ApiResponse<Blob>>
  ) => {
    return async (variables: T): Promise<Blob | null> => {
      const response = await mutateAsync(variables);
      return response.success && response.data ? response.data : null;
    };
  };

  return {
    receiveGeneratedDocument: {
      data: receiveData,
      loading: receiveLoading,
      error: receiveError,
      lastUpdated: receiveLastUpdated,
      refetch: receiveRefetch,
      isSuccess: receiveIsSuccess,
      isError: receiveIsError,
    },
    generateReportByTokenPdf: {
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

