"use client";

import { create } from "zustand";
import { persist } from "zustand/middleware";

// Interface matching the backend LoginOutputDto
export interface LoginOutputDto {
  tokenJwt: string;
  loginId?: string | null;
  userName?: string | null;
  email?: string | null;
  userType?: string | null;
  adresse?: string | null;
  cp?: string | null;
  ville?: string | null;
  phoneNumber?: string | null;
  firstName?: string | null;
  userRole?: string | null;
  clientName?: string | null;
  nbImmeubles?: number | null;
  seuilConsoEf?: number | null;
  seuilConsoEc?: number | null;
  seuilConsoRepart?: number | null;
  seuilConsoCet?: number | null;
  seuilConsoActif?: boolean | null;
  seuilConsoEmail?: string | null;
  showImmeublesArc?: boolean | null;
  showFactures?: boolean | null;
  showChgtOccupant?: boolean | null;
  showChantiers?: boolean | null;
}

// Cache interfaces
export interface CachedData<T> {
  data: T;
  loginId: string;
  cachedAt: number;
  expiresAt: number; // Timestamp for 23:59:59 of the current day
}

export interface ImmeublesCache {
  buildings: CachedData<any[]> | null;
  indicators: CachedData<any[]> | null;
}

interface DataStoreState {
  loginData: LoginOutputDto | null;
  setLoginData: (data: LoginOutputDto) => void;
  clearLoginData: () => void;

  // Cache management
  immeublesCache: ImmeublesCache;
  setImmeublesBuildings: (data: any[]) => void;
  setImmeublesIndicators: (data: any[]) => void;
  clearImmeublesCache: () => void;
  isImmeublesCacheValid: () => boolean;
}

// Helper function to get end of day timestamp (23:59:59)
const getEndOfDayTimestamp = (): number => {
  const now = new Date();
  const endOfDay = new Date(
    now.getFullYear(),
    now.getMonth(),
    now.getDate(),
    23,
    59,
    59,
    999
  );
  return endOfDay.getTime();
};

// Helper function to check if cache is valid
const isCacheValid = (
  cachedData: CachedData<any> | null,
  currentLoginId: string | null
): boolean => {
  if (!cachedData || !currentLoginId) return false;

  // Check if cache belongs to current user
  if (cachedData.loginId !== currentLoginId) return false;

  // Check if cache hasn't expired
  const now = Date.now();
  return now < cachedData.expiresAt;
};

export const useDataStore = create<DataStoreState>()(
  persist(
    (set, get) => ({
      loginData: null,
      immeublesCache: {
        buildings: null,
        indicators: null,
      },

      setLoginData: (data: LoginOutputDto) => set({ loginData: data }),

      clearLoginData: () =>
        set({
          loginData: null,
          immeublesCache: { buildings: null, indicators: null },
        }),

      setImmeublesBuildings: (data: any[]) => {
        const { loginData } = get();
        if (!loginData?.loginId) return;

        const cachedData: CachedData<any[]> = {
          data,
          loginId: loginData.loginId,
          cachedAt: Date.now(),
          expiresAt: getEndOfDayTimestamp(),
        };

        set((state) => ({
          immeublesCache: {
            ...state.immeublesCache,
            buildings: cachedData,
          },
        }));
      },

      setImmeublesIndicators: (data: any[]) => {
        const { loginData } = get();
        if (!loginData?.loginId) return;

        const cachedData: CachedData<any[]> = {
          data,
          loginId: loginData.loginId,
          cachedAt: Date.now(),
          expiresAt: getEndOfDayTimestamp(),
        };

        set((state) => ({
          immeublesCache: {
            ...state.immeublesCache,
            indicators: cachedData,
          },
        }));
      },

      clearImmeublesCache: () =>
        set({
          immeublesCache: { buildings: null, indicators: null },
        }),

      isImmeublesCacheValid: () => {
        const { immeublesCache, loginData } = get();
        return (
          isCacheValid(immeublesCache.buildings, loginData?.loginId || null) &&
          isCacheValid(immeublesCache.indicators, loginData?.loginId || null)
        );
      },
    }),
    {
      name: "data-store", // unique name for localStorage key
    }
  )
);
