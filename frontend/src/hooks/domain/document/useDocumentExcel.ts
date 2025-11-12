"use client";

import { useApiMutation } from "../shared/useApiMutation";
import type { ApiResponse } from "@/types/api";
import { generateAnomaliesExcelApiService } from "@/services/api/Document/Excel/GenerateAnomaliesExcelApiService";
import { generateDysfonctionnementsExcelApiService } from "@/services/api/Document/Excel/GenerateDysfonctionnementsExcelApiService";
import { generateFuitesExcelApiService } from "@/services/api/Document/Excel/GenerateFuitesExcelApiService";
import { generateInterventionsExcelApiService } from "@/services/api/Document/Excel/GenerateInterventionsExcelApiService";
import { generateImmeubleInterventionsExcelApiService } from "@/services/api/Document/Excel/GenerateImmeubleInterventionsExcelApiService";
import type { GenerateAnomaliesDocumentRequestDto } from "@/types/api/request/Document/GenerateAnomaliesDocumentRequestDto";
import type { GenerateDysfonctionnementsDocumentRequestDto } from "@/types/api/request/Document/GenerateDysfonctionnementsDocumentRequestDto";
import type { GenerateFuitesDocumentRequestDto } from "@/types/api/request/Document/GenerateFuitesDocumentRequestDto";
import type { GenerateInterventionDocumentRequestDto } from "@/types/api/request/Document/GenerateInterventionDocumentRequestDto";
import type { GenerateInterventionsDocumentRequestDto } from "@/types/api/request/Document/GenerateInterventionsDocumentRequestDto";

export interface UseDocumentExcelReturn {
  // Generate Anomalies Excel
  generateAnomaliesExcel: {
    mutate: (
      data: GenerateAnomaliesDocumentRequestDto
    ) => Promise<void>;
    mutateAsync: (
      data: GenerateAnomaliesDocumentRequestDto
    ) => Promise<Blob | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };

  // Generate Dysfonctionnements Excel
  generateDysfonctionnementsExcel: {
    mutate: (
      data: GenerateDysfonctionnementsDocumentRequestDto
    ) => Promise<void>;
    mutateAsync: (
      data: GenerateDysfonctionnementsDocumentRequestDto
    ) => Promise<Blob | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };

  // Generate Fuites Excel
  generateFuitesExcel: {
    mutate: (data: GenerateFuitesDocumentRequestDto) => Promise<void>;
    mutateAsync: (data: GenerateFuitesDocumentRequestDto) => Promise<Blob | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };

  // Generate Interventions Excel
  generateInterventionsExcel: {
    mutate: (
      data: GenerateInterventionDocumentRequestDto
    ) => Promise<void>;
    mutateAsync: (
      data: GenerateInterventionDocumentRequestDto
    ) => Promise<Blob | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };

  // Generate Immeuble Interventions Excel
  generateImmeubleInterventionsExcel: {
    mutate: (
      data: GenerateInterventionsDocumentRequestDto
    ) => Promise<void>;
    mutateAsync: (
      data: GenerateInterventionsDocumentRequestDto
    ) => Promise<Blob | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };
}

export interface UseDocumentExcelOptions {
  onSuccess?: (blob: Blob, type: string) => void;
  onError?: (error: string, type: string) => void;
}

/**
 * Hook pour générer des documents Excel
 * Utilise useApiMutation pour chaque type de génération
 * @param options Options de configuration du hook
 */
export function useDocumentExcel(
  options?: UseDocumentExcelOptions
): UseDocumentExcelReturn {
  const { onSuccess, onError } = options || {};

  // Generate Anomalies Excel
  const anomaliesMutation = useApiMutation<Blob, GenerateAnomaliesDocumentRequestDto>(
    (data) => generateAnomaliesExcelApiService.generateAnomaliesExcel(data),
    {
      onSuccess: (blob) => onSuccess?.(blob, "anomalies"),
      onError: (error, variables) => onError?.(error, "anomalies"),
    }
  );

  // Generate Dysfonctionnements Excel
  const dysfonctionnementsMutation = useApiMutation<
    Blob,
    GenerateDysfonctionnementsDocumentRequestDto
  >(
    (data) =>
      generateDysfonctionnementsExcelApiService.generateDysfonctionnementsExcel(
        data
      ),
    {
      onSuccess: (blob) => onSuccess?.(blob, "dysfonctionnements"),
      onError: (error, variables) => onError?.(error, "dysfonctionnements"),
    }
  );

  // Generate Fuites Excel
  const fuitesMutation = useApiMutation<Blob, GenerateFuitesDocumentRequestDto>(
    (data) => generateFuitesExcelApiService.generateFuitesExcel(data),
    {
      onSuccess: (blob) => onSuccess?.(blob, "fuites"),
      onError: (error, variables) => onError?.(error, "fuites"),
    }
  );

  // Generate Interventions Excel
  const interventionsMutation = useApiMutation<
    Blob,
    GenerateInterventionDocumentRequestDto
  >(
    (data) =>
      generateInterventionsExcelApiService.generateInterventionsExcel(data),
    {
      onSuccess: (blob) => onSuccess?.(blob, "interventions"),
      onError: (error, variables) => onError?.(error, "interventions"),
    }
  );

  // Generate Immeuble Interventions Excel
  const immeubleInterventionsMutation = useApiMutation<
    Blob,
    GenerateInterventionsDocumentRequestDto
  >(
    (data) =>
      generateImmeubleInterventionsExcelApiService.generateImmeubleInterventionsExcel(
        data
      ),
    {
      onSuccess: (blob) => onSuccess?.(blob, "immeuble-interventions"),
      onError: (error, variables) => onError?.(error, "immeuble-interventions"),
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
    generateAnomaliesExcel: {
      mutate: anomaliesMutation.mutate,
      mutateAsync: createMutateAsync(anomaliesMutation.mutateAsync),
      loading: anomaliesMutation.loading,
      error: anomaliesMutation.error,
      isSuccess: anomaliesMutation.isSuccess,
      isError: anomaliesMutation.isError,
      reset: anomaliesMutation.reset,
    },
    generateDysfonctionnementsExcel: {
      mutate: dysfonctionnementsMutation.mutate,
      mutateAsync: createMutateAsync(dysfonctionnementsMutation.mutateAsync),
      loading: dysfonctionnementsMutation.loading,
      error: dysfonctionnementsMutation.error,
      isSuccess: dysfonctionnementsMutation.isSuccess,
      isError: dysfonctionnementsMutation.isError,
      reset: dysfonctionnementsMutation.reset,
    },
    generateFuitesExcel: {
      mutate: fuitesMutation.mutate,
      mutateAsync: createMutateAsync(fuitesMutation.mutateAsync),
      loading: fuitesMutation.loading,
      error: fuitesMutation.error,
      isSuccess: fuitesMutation.isSuccess,
      isError: fuitesMutation.isError,
      reset: fuitesMutation.reset,
    },
    generateInterventionsExcel: {
      mutate: interventionsMutation.mutate,
      mutateAsync: createMutateAsync(interventionsMutation.mutateAsync),
      loading: interventionsMutation.loading,
      error: interventionsMutation.error,
      isSuccess: interventionsMutation.isSuccess,
      isError: interventionsMutation.isError,
      reset: interventionsMutation.reset,
    },
    generateImmeubleInterventionsExcel: {
      mutate: immeubleInterventionsMutation.mutate,
      mutateAsync: createMutateAsync(immeubleInterventionsMutation.mutateAsync),
      loading: immeubleInterventionsMutation.loading,
      error: immeubleInterventionsMutation.error,
      isSuccess: immeubleInterventionsMutation.isSuccess,
      isError: immeubleInterventionsMutation.isError,
      reset: immeubleInterventionsMutation.reset,
    },
  };
}

