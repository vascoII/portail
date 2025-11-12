"use client";

import { useState, useEffect, useCallback } from "react";
import type { ApiResponse } from "@/types/api";

export interface UseApiQueryOptions {
  enabled?: boolean; // Si false, la requête ne s'exécute pas automatiquement
  onSuccess?: (data: any) => void;
  onError?: (error: string) => void;
}

export interface UseApiQueryReturn<T> {
  data: T | null;
  loading: boolean;
  error: string | null;
  lastUpdated?: string;
  refetch: () => Promise<void>;
  isSuccess: boolean;
  isError: boolean;
}

/**
 * Hook générique pour les requêtes GET
 * @param queryFn Fonction qui retourne une Promise<ApiResponse<T>>
 * @param options Options de configuration
 * @returns État de la requête et fonction de refetch
 */
export function useApiQuery<T>(
  queryFn: () => Promise<ApiResponse<T>>,
  options: UseApiQueryOptions = {}
): UseApiQueryReturn<T> {
  const { enabled = true, onSuccess, onError } = options;

  const [data, setData] = useState<T | null>(null);
  const [loading, setLoading] = useState<boolean>(enabled);
  const [error, setError] = useState<string | null>(null);
  const [lastUpdated, setLastUpdated] = useState<string | undefined>(undefined);
  const [isSuccess, setIsSuccess] = useState<boolean>(false);
  const [isError, setIsError] = useState<boolean>(false);

  const executeQuery = useCallback(async () => {
    try {
      setLoading(true);
      setError(null);
      setIsSuccess(false);
      setIsError(false);

      const response = await queryFn();

      if (response.success && response.data !== undefined) {
        setData(response.data);
        setIsSuccess(true);
        setLastUpdated(new Date().toISOString());
        onSuccess?.(response.data);
      } else {
        const errorMessage = response.error || response.message || "Unknown error occurred";
        setError(errorMessage);
        setIsError(true);
        onError?.(errorMessage);
      }
    } catch (err) {
      const errorMessage =
        err instanceof Error ? err.message : "Unknown error occurred";
      setError(errorMessage);
      setIsError(true);
      onError?.(errorMessage);
    } finally {
      setLoading(false);
    }
  }, [queryFn, onSuccess, onError]);

  useEffect(() => {
    if (enabled) {
      executeQuery();
    }
  }, [enabled, executeQuery]);

  return {
    data,
    loading,
    error,
    lastUpdated,
    refetch: executeQuery,
    isSuccess,
    isError,
  };
}
