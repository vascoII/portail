"use client";

import { useApiMutation } from "../shared/useApiMutation";
import { createTicketApiService } from "@/services/api/Ticket/CreateTicketApiService";
import { patchTicketApiService } from "@/services/api/Ticket/PatchTicketApiService";
import type { ApiResponse } from "@/types/api";
import type { CreateTicketInterRequestDto } from "@/types/api/request/Ticket/CreateTicketInterRequestDto";
import type { SetTicketStatusRequestDto } from "@/types/api/request/Ticket/SetTicketStatusRequestDto";
import type { SuccessResponseDto } from "@/types/api/response/shared/SuccessResponseDto";

export interface UseTicketMutationReturn {
  // Create Ticket (POST)
  createTicket: {
    mutate: (data: CreateTicketInterRequestDto) => Promise<void>;
    mutateAsync: (
      data: CreateTicketInterRequestDto
    ) => Promise<SuccessResponseDto | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };

  // Update Ticket Status (PATCH)
  updateTicketStatus: {
    mutate: (data: SetTicketStatusRequestDto) => Promise<void>;
    mutateAsync: (
      data: SetTicketStatusRequestDto
    ) => Promise<SuccessResponseDto | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };
}

export interface UseTicketMutationOptions {
  onSuccess?: (data: SuccessResponseDto, type: "create" | "updateStatus") => void;
  onError?: (error: string, type: "create" | "updateStatus") => void;
}

/**
 * Hook pour les mutations de ticket (création et mise à jour du statut)
 * Utilise useApiMutation pour chaque type de mutation
 * @param options Options de configuration du hook
 */
export function useTicketMutation(
  options?: UseTicketMutationOptions
): UseTicketMutationReturn {
  const { onSuccess, onError } = options || {};

  // Create Ticket (POST)
  const createMutation = useApiMutation<
    SuccessResponseDto,
    CreateTicketInterRequestDto
  >(
    (data) => createTicketApiService.createTicket(data),
    {
      onSuccess: (data) => onSuccess?.(data, "create"),
      onError: (error, variables) => onError?.(error, "create"),
    }
  );

  // Update Ticket Status (PATCH)
  const updateStatusMutation = useApiMutation<
    SuccessResponseDto,
    SetTicketStatusRequestDto
  >(
    (data) => patchTicketApiService.patchTicket(data),
    {
      onSuccess: (data) => onSuccess?.(data, "updateStatus"),
      onError: (error, variables) => onError?.(error, "updateStatus"),
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
    createTicket: {
      mutate: createMutation.mutate,
      mutateAsync: createMutateAsync(createMutation.mutateAsync),
      loading: createMutation.loading,
      error: createMutation.error,
      isSuccess: createMutation.isSuccess,
      isError: createMutation.isError,
      reset: createMutation.reset,
    },
    updateTicketStatus: {
      mutate: updateStatusMutation.mutate,
      mutateAsync: createMutateAsync(updateStatusMutation.mutateAsync),
      loading: updateStatusMutation.loading,
      error: updateStatusMutation.error,
      isSuccess: updateStatusMutation.isSuccess,
      isError: updateStatusMutation.isError,
      reset: updateStatusMutation.reset,
    },
  };
}

