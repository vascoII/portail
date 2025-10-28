"use client";

import { useState, useEffect } from "react";
import { apiService } from "@/services/api";
import type { ParcData, UserData, LoadingState } from "@/types/api";

export interface UseParcDataReturn {
  data: ParcData | null;
  loading: boolean;
  error: string | null;
  lastUpdated?: string;
  refetch: () => Promise<void>;
}

export const useParcData = (): UseParcDataReturn => {
  const [data, setData] = useState<ParcData | null>(null);
  const [loading, setLoading] = useState<LoadingState>({
    isLoading: true,
    error: null,
  });

  const fetchParcData = async () => {
    try {
      setLoading({ isLoading: true, error: null });

      const response = await apiService.getParcData();

      if (response.success && response.data) {
        setData(response.data);
        setLoading({
          isLoading: false,
          error: null,
          lastUpdated: new Date().toISOString(),
        });
      } else {
        setLoading({
          isLoading: false,
          error: response.error || "Failed to fetch park data",
        });
      }
    } catch (err) {
      setLoading({
        isLoading: false,
        error: err instanceof Error ? err.message : "Unknown error occurred",
      });
    }
  };

  useEffect(() => {
    fetchParcData();
  }, []);

  return {
    data,
    loading: loading.isLoading,
    error: loading.error,
    lastUpdated: loading.lastUpdated,
    refetch: fetchParcData,
  };
};

// Hook for user data
export interface UseUserDataReturn {
  user: UserData | null;
  loading: boolean;
  error: string | null;
  lastUpdated?: string;
  refetch: () => Promise<void>;
}

export const useUserData = (): UseUserDataReturn => {
  const [user, setUser] = useState<UserData | null>(null);
  const [loading, setLoading] = useState<LoadingState>({
    isLoading: true,
    error: null,
  });

  const fetchUserData = async () => {
    try {
      setLoading({ isLoading: true, error: null });

      const response = await apiService.getCurrentUser();

      if (response.success && response.data) {
        setUser(response.data);
        setLoading({
          isLoading: false,
          error: null,
          lastUpdated: new Date().toISOString(),
        });
      } else {
        setLoading({
          isLoading: false,
          error: response.error || "Failed to fetch user data",
        });
      }
    } catch (err) {
      setLoading({
        isLoading: false,
        error: err instanceof Error ? err.message : "Unknown error occurred",
      });
    }
  };

  useEffect(() => {
    fetchUserData();
  }, []);

  return {
    user,
    loading: loading.isLoading,
    error: loading.error,
    lastUpdated: loading.lastUpdated,
    refetch: fetchUserData,
  };
};
