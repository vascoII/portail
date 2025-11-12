"use client";

import { useState, useCallback } from "react";
import type { ApiResponse } from "@/types/api";

export interface UseExternalApiMutationOptions<TData, TVariables> {
  onSuccess?: (data: TData, variables: TVariables) => void;
  onError?: (error: string, variables: TVariables) => void;
}

export interface UseExternalApiMutationReturn<TData, TVariables> {
  mutate: (variables: TVariables) => Promise<void>;
  mutateAsync: (variables: TVariables) => Promise<ApiResponse<TData>>;
  data: TData | null;
  loading: boolean;
  error: string | null;
  isSuccess: boolean;
  isError: boolean;
  reset: () => void;
}

/**
 * Hook générique pour les mutations externes (POST, PUT, PATCH, DELETE) sans JWT
 * Utilisé pour les endpoints externes qui ne nécessitent pas d'authentification
 * @param mutationFn Fonction qui prend des variables et retourne une Promise<ApiResponse<TData>>
 * @param options Options de configuration
 * @returns Fonctions de mutation et état
 */
export function useExternalApiMutation<TData, TVariables = void>(
  mutationFn: (variables: TVariables) => Promise<ApiResponse<TData>>,
  options: UseExternalApiMutationOptions<TData, TVariables> = {}
): UseExternalApiMutationReturn<TData, TVariables> {
  const { onSuccess, onError } = options;

  const [data, setData] = useState<TData | null>(null);
  const [loading, setLoading] = useState<boolean>(false);
  const [error, setError] = useState<string | null>(null);
  const [isSuccess, setIsSuccess] = useState<boolean>(false);
  const [isError, setIsError] = useState<boolean>(false);

  const mutateAsync = useCallback(
    async (variables: TVariables): Promise<ApiResponse<TData>> => {
      try {
        setLoading(true);
        setError(null);
        setIsSuccess(false);
        setIsError(false);

        const response = await mutationFn(variables);

        if (response.success && response.data !== undefined) {
          setData(response.data);
          setIsSuccess(true);
          onSuccess?.(response.data, variables);
        } else {
          const errorMessage =
            response.error || response.message || "Unknown error occurred";
          setError(errorMessage);
          setIsError(true);
          onError?.(errorMessage, variables);
        }

        return response;
      } catch (err) {
        const errorMessage =
          err instanceof Error ? err.message : "Unknown error occurred";
        setError(errorMessage);
        setIsError(true);
        onError?.(errorMessage, variables);

        return {
          success: false,
          error: errorMessage,
        };
      } finally {
        setLoading(false);
      }
    },
    [mutationFn, onSuccess, onError]
  );

  const mutate = useCallback(
    async (variables: TVariables): Promise<void> => {
      await mutateAsync(variables);
    },
    [mutateAsync]
  );

  const reset = useCallback(() => {
    setData(null);
    setError(null);
    setIsSuccess(false);
    setIsError(false);
    setLoading(false);
  }, []);

  return {
    mutate,
    mutateAsync,
    data,
    loading,
    error,
    isSuccess,
    isError,
    reset,
  };
}

