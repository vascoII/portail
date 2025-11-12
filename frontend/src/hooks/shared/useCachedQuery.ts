"use client";

import { useState, useEffect, useCallback, useRef } from "react";
import { useDataStore } from "@/store/dataStore";
import { getEndOfCurrentWeekTimestamp } from "@/store/helperStore";
import type { ApiResponse } from "@/types/api";
import type { CachedData } from "@/store/dataStore";

export interface UseCachedQueryOptions {
  enabled?: boolean;
  cacheKey: string; // Clé unique pour le cache
  cacheExpiration?: number; // Durée de validité en millisecondes (par défaut: fin de la semaine)
  onSuccess?: (data: any) => void;
  onError?: (error: string) => void;
  staleTime?: number; // Temps avant que les données soient considérées comme "stale" (ms)
}

export interface UseCachedQueryReturn<T> {
  data: T | null;
  loading: boolean;
  error: string | null;
  lastUpdated?: string;
  refetch: (force?: boolean) => Promise<void>;
  isSuccess: boolean;
  isError: boolean;
  isStale: boolean; // Indique si les données sont "stale"
}

/**
 * Vérifie si le cache est valide
 */
function isCacheValid<T>(
  cachedData: CachedData<T> | null,
  currentLoginId: string | null,
  expiresAt?: number
): boolean {
  if (!cachedData || !currentLoginId) return false;

  // Vérifie si le cache appartient à l'utilisateur actuel
  if (cachedData.loginId !== currentLoginId) return false;

  // Vérifie si le cache n'a pas expiré
  const expirationTime = expiresAt || cachedData.expiresAt;
  return Date.now() < expirationTime;
}

/**
 * Hook générique pour les requêtes GET avec cache
 * Utilise un cache en mémoire simple (peut être étendu pour utiliser le store)
 * @param queryFn Fonction qui retourne une Promise<ApiResponse<T>>
 * @param options Options de configuration incluant la clé de cache
 * @returns État de la requête avec gestion du cache
 */
export function useCachedQuery<T>(
  queryFn: () => Promise<ApiResponse<T>>,
  options: UseCachedQueryOptions
): UseCachedQueryReturn<T> {
  const {
    enabled = true,
    cacheKey,
    cacheExpiration,
    onSuccess,
    onError,
    staleTime = 0, // Par défaut, les données ne sont jamais "stale"
  } = options;

  const { loginData } = useDataStore();
  const [data, setData] = useState<T | null>(null);
  const [loading, setLoading] = useState<boolean>(enabled);
  const [error, setError] = useState<string | null>(null);
  const [lastUpdated, setLastUpdated] = useState<string | undefined>(undefined);
  const [isSuccess, setIsSuccess] = useState<boolean>(false);
  const [isError, setIsError] = useState<boolean>(false);
  const [isStale, setIsStale] = useState<boolean>(false);

  // Cache en mémoire (peut être remplacé par le store global si nécessaire)
  const cacheRef = useRef<Map<string, CachedData<T>>>(new Map());

  // Calcule l'expiration par défaut (fin de semaine)
  const defaultExpiration = cacheExpiration || getEndOfCurrentWeekTimestamp();

  // Vérifie le cache et retourne les données si valides
  const getCachedData = useCallback((): T | null => {
    const cached = cacheRef.current.get(cacheKey);
    const currentLoginId = loginData?.loginId || null;

    if (isCacheValid(cached || null, currentLoginId, defaultExpiration)) {
      // Vérifie si les données sont "stale"
      if (staleTime > 0 && cached) {
        const age = Date.now() - cached.cachedAt;
        setIsStale(age > staleTime);
      }

      return cached?.data || null;
    }

    // Cache invalide, on le supprime
    if (cached) {
      cacheRef.current.delete(cacheKey);
    }

    return null;
  }, [cacheKey, loginData?.loginId, defaultExpiration, staleTime]);

  // Met à jour le cache
  const setCachedData = useCallback(
    (newData: T) => {
      const currentLoginId = loginData?.loginId;
      if (!currentLoginId) return;

      const cachedData: CachedData<T> = {
        data: newData,
        loginId: currentLoginId,
        cachedAt: Date.now(),
        expiresAt: defaultExpiration,
      };

      cacheRef.current.set(cacheKey, cachedData);
    },
    [cacheKey, loginData?.loginId, defaultExpiration]
  );

  const executeQuery = useCallback(
    async (force = false) => {
      // Vérifie le cache si on ne force pas le refetch
      if (!force) {
        const cached = getCachedData();
        if (cached !== null) {
          setData(cached);
          setIsSuccess(true);
          setLoading(false);
          setIsStale(false);
          return;
        }
      }

      try {
        setLoading(true);
        setError(null);
        setIsSuccess(false);
        setIsError(false);
        setIsStale(false);

        const response = await queryFn();

        if (response.success && response.data !== undefined) {
          setData(response.data);
          setCachedData(response.data);
          setIsSuccess(true);
          setLastUpdated(new Date().toISOString());
          onSuccess?.(response.data);
        } else {
          const errorMessage =
            response.error || response.message || "Unknown error occurred";
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
    },
    [queryFn, getCachedData, setCachedData, onSuccess, onError]
  );

  // Initial load
  useEffect(() => {
    if (enabled) {
      // Essaie d'abord le cache
      const cached = getCachedData();
      if (cached !== null) {
        setData(cached);
        setIsSuccess(true);
        setLoading(false);
        setIsStale(false);
      } else {
        executeQuery(false);
      }
    }
  }, [enabled, executeQuery, getCachedData]);

  // Nettoie le cache si l'utilisateur change
  useEffect(() => {
    const currentLoginId = loginData?.loginId;
    if (currentLoginId) {
      // Supprime les entrées de cache qui n'appartiennent pas à l'utilisateur actuel
      cacheRef.current.forEach((cached, key) => {
        if (cached.loginId !== currentLoginId) {
          cacheRef.current.delete(key);
        }
      });
    }
  }, [loginData?.loginId]);

  return {
    data,
    loading,
    error,
    lastUpdated,
    refetch: (force = false) => executeQuery(force),
    isSuccess,
    isError,
    isStale,
  };
}
