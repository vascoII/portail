"use client";

import { useExternalApiQuery } from "@/src/shared/hooks/useExternalApiQuery";
import { useExternalApiMutation } from "@/shared/hooks/useExternalApiMutation";
import { listWorkOrdersApiService } from "@/src/features/external/services/suivi/ListWorkOrdersApiService";
import { getWorkOrderApiService } from "@/src/features/external/services/suivi/GetWorkOrderApiService";
import { generateWorkOrderDetailsPdfApiService } from "@/src/features/external/services/suivi/GenerateWorkOrderDetailsPdfApiService";
import type { GetDetailsDepannageInpuDto } from "@/src/shared/types/request/GetDetailsDepannageInpuDto";
import type { PaginatedResponse } from "@/src/shared/types/api";
import type { DepannageResponseDto } from "@/src/shared/types/response/DepannageResponseDto";
import type { GetDetailsDepannageResponseDto } from "@/src/shared/types/response/GetDetailsDepannageResponseDto";
import type { ApiResponse } from "@/src/shared/types/api";

export interface UseExternalSuiviReturn {
  // List Work Orders (GET)
  listWorkOrders: {
    data: PaginatedResponse<DepannageResponseDto> | null;
    loading: boolean;
    error: string | null;
    lastUpdated?: string;
    refetch: () => Promise<void>;
    isSuccess: boolean;
    isError: boolean;
  };

  // Get Work Order (GET)
  getWorkOrder: {
    data: GetDetailsDepannageResponseDto | null;
    loading: boolean;
    error: string | null;
    lastUpdated?: string;
    refetch: () => Promise<void>;
    isSuccess: boolean;
    isError: boolean;
  };

  // Generate Work Order Details PDF (POST)
  generateWorkOrderDetailsPdf: {
    mutate: (data: GetDetailsDepannageInpuDto) => Promise<void>;
    mutateAsync: (data: GetDetailsDepannageInpuDto) => Promise<Blob | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };
}

export interface UseExternalSuiviOptions {
  pkDepannage?: string; // Required for getWorkOrder
  enabled?: boolean;
  loadWorkOrders?: boolean;
  loadWorkOrder?: boolean;
  workOrdersParams?: Record<string, string | number>;
  onSuccess?: (data: any, type: "list" | "get" | "generate") => void;
  onError?: (error: string, type: "list" | "get" | "generate") => void;
}

/**
 * Hook pour les opérations de suivi externe (sans JWT)
 * Utilise useExternalApiQuery et useExternalApiMutation pour les appels sans authentification
 * @param options Options de configuration du hook
 */
export function useExternalSuivi(
  options?: UseExternalSuiviOptions
): UseExternalSuiviReturn {
  const {
    pkDepannage,
    enabled = true,
    loadWorkOrders = false,
    loadWorkOrder = false,
    workOrdersParams,
    onSuccess,
    onError,
  } = options || {};

  // List Work Orders (GET)
  const {
    data: workOrdersData,
    loading: workOrdersLoading,
    error: workOrdersError,
    lastUpdated: workOrdersLastUpdated,
    refetch: workOrdersRefetch,
    isSuccess: workOrdersIsSuccess,
    isError: workOrdersIsError,
  } = useExternalApiQuery<PaginatedResponse<DepannageResponseDto>>(
    () => listWorkOrdersApiService.listWorkOrders(workOrdersParams),
    {
      enabled: enabled && loadWorkOrders,
      onSuccess: (data) => onSuccess?.(data, "list"),
      onError: (error) => onError?.(error, "list"),
    }
  );

  // Get Work Order (GET)
  const workOrderRequest: GetDetailsDepannageInpuDto | null = pkDepannage
    ? { pkDepannage }
    : null;
  const {
    data: workOrderData,
    loading: workOrderLoading,
    error: workOrderError,
    lastUpdated: workOrderLastUpdated,
    refetch: workOrderRefetch,
    isSuccess: workOrderIsSuccess,
    isError: workOrderIsError,
  } = useExternalApiQuery<GetDetailsDepannageResponseDto>(
    () => {
      if (!workOrderRequest) {
        throw new Error("pkDepannage is required for getWorkOrder");
      }
      return getWorkOrderApiService.getWorkOrder(workOrderRequest);
    },
    {
      enabled: enabled && loadWorkOrder && !!pkDepannage,
      onSuccess: (data) => onSuccess?.(data, "get"),
      onError: (error) => onError?.(error, "get"),
    }
  );

  // Generate Work Order Details PDF (POST)
  const generateMutation = useExternalApiMutation<
    Blob,
    GetDetailsDepannageInpuDto
  >(
    (data) =>
      generateWorkOrderDetailsPdfApiService.generateWorkOrderDetailsPdf(data),
    {
      onSuccess: (data) => onSuccess?.(data, "generate"),
      onError: (error, variables) => onError?.(error, "generate"),
    }
  );

  // Helper function to convert ApiResponse<Blob> to Blob | null
  const createMutateAsync = (
    mutateAsync: (
      variables: GetDetailsDepannageInpuDto
    ) => Promise<ApiResponse<Blob>>
  ) => {
    return async (
      variables: GetDetailsDepannageInpuDto
    ): Promise<Blob | null> => {
      const response = await mutateAsync(variables);
      return response.success && response.data ? response.data : null;
    };
  };

  return {
    listWorkOrders: {
      data: workOrdersData,
      loading: workOrdersLoading,
      error: workOrdersError,
      lastUpdated: workOrdersLastUpdated,
      refetch: workOrdersRefetch,
      isSuccess: workOrdersIsSuccess,
      isError: workOrdersIsError,
    },
    getWorkOrder: {
      data: workOrderData,
      loading: workOrderLoading,
      error: workOrderError,
      lastUpdated: workOrderLastUpdated,
      refetch: workOrderRefetch,
      isSuccess: workOrderIsSuccess,
      isError: workOrderIsError,
    },
    generateWorkOrderDetailsPdf: {
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

