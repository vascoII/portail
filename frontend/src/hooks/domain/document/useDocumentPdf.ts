"use client";

import { useApiMutation } from "../shared/useApiMutation";
import type { ApiResponse } from "@/types/api";
import { generateFacturePdfApiService } from "@/services/api/Document/Pdf/GenerateFacturePdfApiService";
import { generateImmeubleDetailPdfApiService } from "@/services/api/Document/Pdf/GenerateImmeubleDetailPdfApiService";
import { generateImmeubleRelevePdfApiService } from "@/services/api/Document/Pdf/GenerateImmeubleRelevePdfApiService";
import { generateImmeubleSynthesePdfApiService } from "@/services/api/Document/Pdf/GenerateImmeubleSynthesePdfApiService";
import { generateInterventionPdfApiService } from "@/services/api/Document/Pdf/GenerateInterventionPdfApiService";
import { generateLogementRepartPdfApiService } from "@/services/api/Document/Pdf/GenerateLogementRepartPdfApiService";
import { generateOccupantNotePdfApiService } from "@/services/api/Document/Pdf/GenerateOccupantNotePdfApiService";
import { generateOccupantRelevePdfApiService } from "@/services/api/Document/Pdf/GenerateOccupantRelevePdfApiService";
import { generateOccupantRepartPdfApiService } from "@/services/api/Document/Pdf/GenerateOccupantRepartPdfApiService";
import type { GenerateFactureDocumentRequestDto } from "@/types/api/request/Document/GenerateFactureDocumentRequestDto";
import type { GenerateImmeubleDetailDocumentRequestDto } from "@/types/api/request/Document/GenerateImmeubleDetailDocumentRequestDto";
import type { GenerateImmeubleReleveDocumentRequestDto } from "@/types/api/request/Document/GenerateImmeubleReleveDocumentRequestDto";
import type { GenerateImmeubleSyntheseDocumentRequestDto } from "@/types/api/request/Document/GenerateImmeubleSyntheseDocumentRequestDto";
import type { GenerateInterventionDocumentRequestDto } from "@/types/api/request/Document/GenerateInterventionDocumentRequestDto";
import type { GenerateLogementRepartDocumentRequestDto } from "@/types/api/request/Document/GenerateLogementRepartDocumentRequestDto";
import type { GenerateOccupantNoteDocumentRequestDto } from "@/types/api/request/Document/GenerateOccupantNoteDocumentRequestDto";
import type { GenerateOccupantReleveDocumentRequestDto } from "@/types/api/request/Document/GenerateOccupantReleveDocumentRequestDto";
import type { GenerateOccupantRepartDocumentRequestDto } from "@/types/api/request/Document/GenerateOccupantRepartDocumentRequestDto";

export interface UseDocumentPdfReturn {
  // Generate Facture PDF
  generateFacturePdf: {
    mutate: (data: GenerateFactureDocumentRequestDto) => Promise<void>;
    mutateAsync: (data: GenerateFactureDocumentRequestDto) => Promise<Blob | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };

  // Generate Immeuble Detail PDF
  generateImmeubleDetailPdf: {
    mutate: (
      data: GenerateImmeubleDetailDocumentRequestDto
    ) => Promise<void>;
    mutateAsync: (
      data: GenerateImmeubleDetailDocumentRequestDto
    ) => Promise<Blob | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };

  // Generate Immeuble Releve PDF
  generateImmeubleRelevePdf: {
    mutate: (
      data: GenerateImmeubleReleveDocumentRequestDto
    ) => Promise<void>;
    mutateAsync: (
      data: GenerateImmeubleReleveDocumentRequestDto
    ) => Promise<Blob | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };

  // Generate Immeuble Synthese PDF
  generateImmeubleSynthesePdf: {
    mutate: (
      data: GenerateImmeubleSyntheseDocumentRequestDto
    ) => Promise<void>;
    mutateAsync: (
      data: GenerateImmeubleSyntheseDocumentRequestDto
    ) => Promise<Blob | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };

  // Generate Intervention PDF
  generateInterventionPdf: {
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

  // Generate Logement Repart PDF
  generateLogementRepartPdf: {
    mutate: (
      data: GenerateLogementRepartDocumentRequestDto
    ) => Promise<void>;
    mutateAsync: (
      data: GenerateLogementRepartDocumentRequestDto
    ) => Promise<Blob | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };

  // Generate Occupant Note PDF
  generateOccupantNotePdf: {
    mutate: (
      data: GenerateOccupantNoteDocumentRequestDto
    ) => Promise<void>;
    mutateAsync: (
      data: GenerateOccupantNoteDocumentRequestDto
    ) => Promise<Blob | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };

  // Generate Occupant Releve PDF
  generateOccupantRelevePdf: {
    mutate: (
      data: GenerateOccupantReleveDocumentRequestDto
    ) => Promise<void>;
    mutateAsync: (
      data: GenerateOccupantReleveDocumentRequestDto
    ) => Promise<Blob | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };

  // Generate Occupant Repart PDF
  generateOccupantRepartPdf: {
    mutate: (
      data: GenerateOccupantRepartDocumentRequestDto
    ) => Promise<void>;
    mutateAsync: (
      data: GenerateOccupantRepartDocumentRequestDto
    ) => Promise<Blob | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };
}

export interface UseDocumentPdfOptions {
  onSuccess?: (blob: Blob, type: string) => void;
  onError?: (error: string, type: string) => void;
}

/**
 * Hook pour générer des documents PDF
 * Utilise useApiMutation pour chaque type de génération
 * @param options Options de configuration du hook
 */
export function useDocumentPdf(
  options?: UseDocumentPdfOptions
): UseDocumentPdfReturn {
  const { onSuccess, onError } = options || {};

  // Generate Facture PDF
  const factureMutation = useApiMutation<Blob, GenerateFactureDocumentRequestDto>(
    (data) => generateFacturePdfApiService.generateFacturePdf(data),
    {
      onSuccess: (blob) => onSuccess?.(blob, "facture"),
      onError: (error, variables) => onError?.(error, "facture"),
    }
  );

  // Generate Immeuble Detail PDF
  const immeubleDetailMutation = useApiMutation<
    Blob,
    GenerateImmeubleDetailDocumentRequestDto
  >(
    (data) =>
      generateImmeubleDetailPdfApiService.generateImmeubleDetailPdf(data),
    {
      onSuccess: (blob) => onSuccess?.(blob, "immeuble-detail"),
      onError: (error, variables) => onError?.(error, "immeuble-detail"),
    }
  );

  // Generate Immeuble Releve PDF
  const immeubleReleveMutation = useApiMutation<
    Blob,
    GenerateImmeubleReleveDocumentRequestDto
  >(
    (data) =>
      generateImmeubleRelevePdfApiService.generateImmeubleRelevePdf(data),
    {
      onSuccess: (blob) => onSuccess?.(blob, "immeuble-releve"),
      onError: (error, variables) => onError?.(error, "immeuble-releve"),
    }
  );

  // Generate Immeuble Synthese PDF
  const immeubleSyntheseMutation = useApiMutation<
    Blob,
    GenerateImmeubleSyntheseDocumentRequestDto
  >(
    (data) =>
      generateImmeubleSynthesePdfApiService.generateImmeubleSynthesePdf(data),
    {
      onSuccess: (blob) => onSuccess?.(blob, "immeuble-synthese"),
      onError: (error, variables) => onError?.(error, "immeuble-synthese"),
    }
  );

  // Generate Intervention PDF
  const interventionMutation = useApiMutation<
    Blob,
    GenerateInterventionDocumentRequestDto
  >(
    (data) => generateInterventionPdfApiService.generateInterventionPdf(data),
    {
      onSuccess: (blob) => onSuccess?.(blob, "intervention"),
      onError: (error, variables) => onError?.(error, "intervention"),
    }
  );

  // Generate Logement Repart PDF
  const logementRepartMutation = useApiMutation<
    Blob,
    GenerateLogementRepartDocumentRequestDto
  >(
    (data) =>
      generateLogementRepartPdfApiService.generateLogementRepartPdf(data),
    {
      onSuccess: (blob) => onSuccess?.(blob, "logement-repart"),
      onError: (error, variables) => onError?.(error, "logement-repart"),
    }
  );

  // Generate Occupant Note PDF
  const occupantNoteMutation = useApiMutation<
    Blob,
    GenerateOccupantNoteDocumentRequestDto
  >(
    (data) => generateOccupantNotePdfApiService.generateOccupantNotePdf(data),
    {
      onSuccess: (blob) => onSuccess?.(blob, "occupant-note"),
      onError: (error, variables) => onError?.(error, "occupant-note"),
    }
  );

  // Generate Occupant Releve PDF
  const occupantReleveMutation = useApiMutation<
    Blob,
    GenerateOccupantReleveDocumentRequestDto
  >(
    (data) =>
      generateOccupantRelevePdfApiService.generateOccupantRelevePdf(data),
    {
      onSuccess: (blob) => onSuccess?.(blob, "occupant-releve"),
      onError: (error, variables) => onError?.(error, "occupant-releve"),
    }
  );

  // Generate Occupant Repart PDF
  const occupantRepartMutation = useApiMutation<
    Blob,
    GenerateOccupantRepartDocumentRequestDto
  >(
    (data) =>
      generateOccupantRepartPdfApiService.generateOccupantRepartPdf(data),
    {
      onSuccess: (blob) => onSuccess?.(blob, "occupant-repart"),
      onError: (error, variables) => onError?.(error, "occupant-repart"),
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
    generateFacturePdf: {
      mutate: factureMutation.mutate,
      mutateAsync: createMutateAsync(factureMutation.mutateAsync),
      loading: factureMutation.loading,
      error: factureMutation.error,
      isSuccess: factureMutation.isSuccess,
      isError: factureMutation.isError,
      reset: factureMutation.reset,
    },
    generateImmeubleDetailPdf: {
      mutate: immeubleDetailMutation.mutate,
      mutateAsync: createMutateAsync(immeubleDetailMutation.mutateAsync),
      loading: immeubleDetailMutation.loading,
      error: immeubleDetailMutation.error,
      isSuccess: immeubleDetailMutation.isSuccess,
      isError: immeubleDetailMutation.isError,
      reset: immeubleDetailMutation.reset,
    },
    generateImmeubleRelevePdf: {
      mutate: immeubleReleveMutation.mutate,
      mutateAsync: createMutateAsync(immeubleReleveMutation.mutateAsync),
      loading: immeubleReleveMutation.loading,
      error: immeubleReleveMutation.error,
      isSuccess: immeubleReleveMutation.isSuccess,
      isError: immeubleReleveMutation.isError,
      reset: immeubleReleveMutation.reset,
    },
    generateImmeubleSynthesePdf: {
      mutate: immeubleSyntheseMutation.mutate,
      mutateAsync: createMutateAsync(immeubleSyntheseMutation.mutateAsync),
      loading: immeubleSyntheseMutation.loading,
      error: immeubleSyntheseMutation.error,
      isSuccess: immeubleSyntheseMutation.isSuccess,
      isError: immeubleSyntheseMutation.isError,
      reset: immeubleSyntheseMutation.reset,
    },
    generateInterventionPdf: {
      mutate: interventionMutation.mutate,
      mutateAsync: createMutateAsync(interventionMutation.mutateAsync),
      loading: interventionMutation.loading,
      error: interventionMutation.error,
      isSuccess: interventionMutation.isSuccess,
      isError: interventionMutation.isError,
      reset: interventionMutation.reset,
    },
    generateLogementRepartPdf: {
      mutate: logementRepartMutation.mutate,
      mutateAsync: createMutateAsync(logementRepartMutation.mutateAsync),
      loading: logementRepartMutation.loading,
      error: logementRepartMutation.error,
      isSuccess: logementRepartMutation.isSuccess,
      isError: logementRepartMutation.isError,
      reset: logementRepartMutation.reset,
    },
    generateOccupantNotePdf: {
      mutate: occupantNoteMutation.mutate,
      mutateAsync: createMutateAsync(occupantNoteMutation.mutateAsync),
      loading: occupantNoteMutation.loading,
      error: occupantNoteMutation.error,
      isSuccess: occupantNoteMutation.isSuccess,
      isError: occupantNoteMutation.isError,
      reset: occupantNoteMutation.reset,
    },
    generateOccupantRelevePdf: {
      mutate: occupantReleveMutation.mutate,
      mutateAsync: createMutateAsync(occupantReleveMutation.mutateAsync),
      loading: occupantReleveMutation.loading,
      error: occupantReleveMutation.error,
      isSuccess: occupantReleveMutation.isSuccess,
      isError: occupantReleveMutation.isError,
      reset: occupantReleveMutation.reset,
    },
    generateOccupantRepartPdf: {
      mutate: occupantRepartMutation.mutate,
      mutateAsync: createMutateAsync(occupantRepartMutation.mutateAsync),
      loading: occupantRepartMutation.loading,
      error: occupantRepartMutation.error,
      isSuccess: occupantRepartMutation.isSuccess,
      isError: occupantRepartMutation.isError,
      reset: occupantRepartMutation.reset,
    },
  };
}

