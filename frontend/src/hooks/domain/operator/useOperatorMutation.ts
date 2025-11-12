"use client";

import { useApiMutation } from "../shared/useApiMutation";
import { createOperatorApiService } from "@/services/api/Operator/CreateOperatorApiService";
import { putOperatorApiService } from "@/services/api/Operator/PutOperatorApiService";
import { patchOperatorApiService } from "@/services/api/Operator/PatchOperatorApiService";
import { deleteOperatorApiService } from "@/services/api/Operator/DeleteOperatorApiService";
import { addBuildingToOperatorApiService } from "@/services/api/Operator/AddBuildingToOperatorApiService";
import { removeBuildingToOperatorApiService } from "@/services/api/Operator/RemoveBuildingToOperatorApiService";
import type { ApiResponse } from "@/types/api";
import type { CreateOperatorRequestDto } from "@/types/api/request/Operator/CreateOperatorRequestDto";
import type { PutOperatorRequestDto } from "@/types/api/request/Operator/PutOperatorRequestDto";
import type { PatchOperatorRequestDto } from "@/types/api/request/Operator/PatchOperatorRequestDto";
import type { GetByIdIntRequestDto } from "@/types/api/request/Shared/GetByIdIntRequestDto";
import type { CreateOperationImmeubleRequestDto } from "@/types/api/request/Operator/CreateOperationImmeubleRequestDto";
import type { PatchOperatorImmeubleRequestDto } from "@/types/api/request/Operator/PatchOperatorImmeubleRequestDto";
import type { CreateGestionnaireResponseDto } from "@/types/api/response/operator/CreateGestionnaireResponseDto";
import type { UpdateUserResponseDto } from "@/types/api/response/operator/UpdateUserResponseDto";
import type { DeleteUserResponseDto } from "@/types/api/response/operator/DeleteUserResponseDto";
import type { SuccessResponseDto } from "@/types/api/response/shared/SuccessResponseDto";

export interface UseOperatorMutationReturn {
  // Create Operator (POST)
  createOperator: {
    mutate: (data: CreateOperatorRequestDto) => Promise<void>;
    mutateAsync: (
      data: CreateOperatorRequestDto
    ) => Promise<CreateGestionnaireResponseDto | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };

  // Update Operator (PUT)
  updateOperator: {
    mutate: (data: PutOperatorRequestDto) => Promise<void>;
    mutateAsync: (data: PutOperatorRequestDto) => Promise<UpdateUserResponseDto | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };

  // Patch Operator (PATCH)
  patchOperator: {
    mutate: (data: PatchOperatorRequestDto) => Promise<void>;
    mutateAsync: (data: PatchOperatorRequestDto) => Promise<UpdateUserResponseDto | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };

  // Delete Operator (DELETE)
  deleteOperator: {
    mutate: (data: GetByIdIntRequestDto) => Promise<void>;
    mutateAsync: (data: GetByIdIntRequestDto) => Promise<DeleteUserResponseDto | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };

  // Add Building to Operator (POST)
  addBuildingToOperator: {
    mutate: (data: CreateOperationImmeubleRequestDto) => Promise<void>;
    mutateAsync: (
      data: CreateOperationImmeubleRequestDto
    ) => Promise<SuccessResponseDto | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };

  // Remove Building from Operator (DELETE)
  removeBuildingFromOperator: {
    mutate: (data: PatchOperatorImmeubleRequestDto) => Promise<void>;
    mutateAsync: (
      data: PatchOperatorImmeubleRequestDto
    ) => Promise<SuccessResponseDto | null>;
    loading: boolean;
    error: string | null;
    isSuccess: boolean;
    isError: boolean;
    reset: () => void;
  };
}

export interface UseOperatorMutationOptions {
  onSuccess?: (
    data: any,
    type: "create" | "update" | "patch" | "delete" | "addBuilding" | "removeBuilding"
  ) => void;
  onError?: (
    error: string,
    type: "create" | "update" | "patch" | "delete" | "addBuilding" | "removeBuilding"
  ) => void;
}

/**
 * Hook pour les mutations d'opérateur (création, mise à jour, suppression, gestion des immeubles)
 * Utilise useApiMutation pour chaque type de mutation
 * @param options Options de configuration du hook
 */
export function useOperatorMutation(
  options?: UseOperatorMutationOptions
): UseOperatorMutationReturn {
  const { onSuccess, onError } = options || {};

  // Create Operator (POST)
  const createMutation = useApiMutation<
    CreateGestionnaireResponseDto,
    CreateOperatorRequestDto
  >(
    (data) => createOperatorApiService.createOperator(data),
    {
      onSuccess: (data) => onSuccess?.(data, "create"),
      onError: (error, variables) => onError?.(error, "create"),
    }
  );

  // Update Operator (PUT)
  const updateMutation = useApiMutation<UpdateUserResponseDto, PutOperatorRequestDto>(
    (data) => putOperatorApiService.putOperator(data),
    {
      onSuccess: (data) => onSuccess?.(data, "update"),
      onError: (error, variables) => onError?.(error, "update"),
    }
  );

  // Patch Operator (PATCH)
  const patchMutation = useApiMutation<
    UpdateUserResponseDto,
    PatchOperatorRequestDto
  >(
    (data) => patchOperatorApiService.patchOperator(data),
    {
      onSuccess: (data) => onSuccess?.(data, "patch"),
      onError: (error, variables) => onError?.(error, "patch"),
    }
  );

  // Delete Operator (DELETE)
  const deleteMutation = useApiMutation<DeleteUserResponseDto, GetByIdIntRequestDto>(
    (data) => deleteOperatorApiService.deleteOperator(data),
    {
      onSuccess: (data) => onSuccess?.(data, "delete"),
      onError: (error, variables) => onError?.(error, "delete"),
    }
  );

  // Add Building to Operator (POST)
  const addBuildingMutation = useApiMutation<
    SuccessResponseDto,
    CreateOperationImmeubleRequestDto
  >(
    (data) => addBuildingToOperatorApiService.addBuildingToOperator(data),
    {
      onSuccess: (data) => onSuccess?.(data, "addBuilding"),
      onError: (error, variables) => onError?.(error, "addBuilding"),
    }
  );

  // Remove Building from Operator (DELETE)
  const removeBuildingMutation = useApiMutation<
    SuccessResponseDto,
    PatchOperatorImmeubleRequestDto
  >(
    (data) => removeBuildingToOperatorApiService.removeBuildingToOperator(data),
    {
      onSuccess: (data) => onSuccess?.(data, "removeBuilding"),
      onError: (error, variables) => onError?.(error, "removeBuilding"),
    }
  );

  // Helper function to convert ApiResponse<T> to T | null
  const createMutateAsync = <T extends any>(
    mutateAsync: (variables: T) => Promise<ApiResponse<any>>
  ) => {
    return async (variables: T): Promise<any | null> => {
      const response = await mutateAsync(variables);
      return response.success && response.data ? response.data : null;
    };
  };

  return {
    createOperator: {
      mutate: createMutation.mutate,
      mutateAsync: createMutateAsync(createMutation.mutateAsync),
      loading: createMutation.loading,
      error: createMutation.error,
      isSuccess: createMutation.isSuccess,
      isError: createMutation.isError,
      reset: createMutation.reset,
    },
    updateOperator: {
      mutate: updateMutation.mutate,
      mutateAsync: createMutateAsync(updateMutation.mutateAsync),
      loading: updateMutation.loading,
      error: updateMutation.error,
      isSuccess: updateMutation.isSuccess,
      isError: updateMutation.isError,
      reset: updateMutation.reset,
    },
    patchOperator: {
      mutate: patchMutation.mutate,
      mutateAsync: createMutateAsync(patchMutation.mutateAsync),
      loading: patchMutation.loading,
      error: patchMutation.error,
      isSuccess: patchMutation.isSuccess,
      isError: patchMutation.isError,
      reset: patchMutation.reset,
    },
    deleteOperator: {
      mutate: deleteMutation.mutate,
      mutateAsync: createMutateAsync(deleteMutation.mutateAsync),
      loading: deleteMutation.loading,
      error: deleteMutation.error,
      isSuccess: deleteMutation.isSuccess,
      isError: deleteMutation.isError,
      reset: deleteMutation.reset,
    },
    addBuildingToOperator: {
      mutate: addBuildingMutation.mutate,
      mutateAsync: createMutateAsync(addBuildingMutation.mutateAsync),
      loading: addBuildingMutation.loading,
      error: addBuildingMutation.error,
      isSuccess: addBuildingMutation.isSuccess,
      isError: addBuildingMutation.isError,
      reset: addBuildingMutation.reset,
    },
    removeBuildingFromOperator: {
      mutate: removeBuildingMutation.mutate,
      mutateAsync: createMutateAsync(removeBuildingMutation.mutateAsync),
      loading: removeBuildingMutation.loading,
      error: removeBuildingMutation.error,
      isSuccess: removeBuildingMutation.isSuccess,
      isError: removeBuildingMutation.isError,
      reset: removeBuildingMutation.reset,
    },
  };
}

