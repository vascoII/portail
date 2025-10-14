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

export interface LogementsCache {
  logements: CachedData<any[]> | null;
  indicators: CachedData<any[]> | null;
}

export interface SingleImmeubleCache {
  immeuble: CachedData<any> | null;
  capteur: CachedData<any> | null;
  cet: CachedData<any> | null;
  ec: CachedData<any> | null;
  ef: CachedData<any> | null;
  elect: CachedData<any> | null;
  gaz: CachedData<any> | null;
  indicators: CachedData<any> | null;
  repart: CachedData<any> | null;
  serieConsosCompteurGeneral: CachedData<any> | null;
  serieConsosEau: CachedData<any> | null;
  anomalies: CachedData<any> | null;
  dysfonctionnements: CachedData<any> | null;
  fuites: CachedData<any> | null;
  interventions: CachedData<any> | null;
  [key: string]: CachedData<any> | null;
}

export interface SingleLogementCache {
  logement: CachedData<any> | null;
  capteur: CachedData<any> | null;
  cet: CachedData<any> | null;
  ec: CachedData<any> | null;
  ef: CachedData<any> | null;
  elect: CachedData<any> | null;
  gaz: CachedData<any> | null;
  indicators: CachedData<any> | null;
  repart: CachedData<any> | null;
  anomalies: CachedData<any> | null;
  dysfonctionnements: CachedData<any> | null;
  fuites: CachedData<any> | null;
  interventions: CachedData<any> | null;
  [key: string]: CachedData<any> | null;
}

interface DataStoreState {
  loginData: LoginOutputDto | null;
  setLoginData: (data: LoginOutputDto) => void;
  clearLoginData: () => void;

  // Cache management
  immeublesCache: ImmeublesCache;
  logementsCache: LogementsCache;
  singleImmeubleCache: { [key: string]: SingleImmeubleCache };
  singleLogementCache: { [key: string]: SingleLogementCache };

  // Immeubles cache functions
  setImmeublesBuildings: (data: any[]) => void;
  setImmeublesIndicators: (data: any[]) => void;
  clearImmeublesCache: () => void;

  // Logements cache functions
  setLogementsLogements: (data: any[]) => void;
  setLogementsIndicators: (data: any[]) => void;
  clearLogementsCache: () => void;

  // Single Immeuble cache functions
  setSingleImmeubleData: (
    immeubleId: string,
    dataType: string,
    data: any
  ) => void;
  clearSingleImmeubleCache: (immeubleId: string) => void;

  // Single Logement cache functions
  setSingleLogementData: (
    logementId: string,
    dataType: string,
    data: any
  ) => void;
  clearSingleLogementCache: (logementId: string) => void;

  // Clear all caches
  clearAllCaches: () => void;
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
      logementsCache: {
        logements: null,
        indicators: null,
      },
      singleImmeubleCache: {},
      singleLogementCache: {},

      setLoginData: (data: LoginOutputDto) => set({ loginData: data }),

      clearLoginData: () =>
        set({
          loginData: null,
          immeublesCache: { buildings: null, indicators: null },
          logementsCache: { logements: null, indicators: null },
          singleImmeubleCache: {},
          singleLogementCache: {},
        }),

      // Immeubles cache functions
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

      // Logements cache functions
      setLogementsLogements: (data: any[]) => {
        const { loginData } = get();
        if (!loginData?.loginId) return;

        const cachedData: CachedData<any[]> = {
          data,
          loginId: loginData.loginId,
          cachedAt: Date.now(),
          expiresAt: getEndOfDayTimestamp(),
        };

        set((state) => ({
          logementsCache: {
            ...state.logementsCache,
            logements: cachedData,
          },
        }));
      },

      setLogementsIndicators: (data: any[]) => {
        const { loginData } = get();
        if (!loginData?.loginId) return;

        const cachedData: CachedData<any[]> = {
          data,
          loginId: loginData.loginId,
          cachedAt: Date.now(),
          expiresAt: getEndOfDayTimestamp(),
        };

        set((state) => ({
          logementsCache: {
            ...state.logementsCache,
            indicators: cachedData,
          },
        }));
      },

      clearLogementsCache: () =>
        set({
          logementsCache: { logements: null, indicators: null },
        }),

      // Single Immeuble cache functions
      setSingleImmeubleData: (
        immeubleId: string,
        dataType: string,
        data: any
      ) => {
        const { loginData } = get();
        if (!loginData?.loginId) return;

        const cachedData: CachedData<any> = {
          data,
          loginId: loginData.loginId,
          cachedAt: Date.now(),
          expiresAt: getEndOfDayTimestamp(),
        };

        set((state) => ({
          singleImmeubleCache: {
            ...state.singleImmeubleCache,
            [immeubleId]: {
              ...state.singleImmeubleCache[immeubleId],
              [dataType]: cachedData,
            },
          },
        }));
      },

      clearSingleImmeubleCache: (immeubleId: string) =>
        set((state) => {
          const newCache = { ...state.singleImmeubleCache };
          delete newCache[immeubleId];
          return { singleImmeubleCache: newCache };
        }),

      // Single Logement cache functions
      setSingleLogementData: (
        logementId: string,
        dataType: string,
        data: any
      ) => {
        const { loginData } = get();
        if (!loginData?.loginId) return;

        const cachedData: CachedData<any> = {
          data,
          loginId: loginData.loginId,
          cachedAt: Date.now(),
          expiresAt: getEndOfDayTimestamp(),
        };

        set((state) => ({
          singleLogementCache: {
            ...state.singleLogementCache,
            [logementId]: {
              ...state.singleLogementCache[logementId],
              [dataType]: cachedData,
            },
          },
        }));
      },

      clearSingleLogementCache: (logementId: string) =>
        set((state) => {
          const newCache = { ...state.singleLogementCache };
          delete newCache[logementId];
          return { singleLogementCache: newCache };
        }),

      // Clear all caches
      clearAllCaches: () =>
        set({
          immeublesCache: { buildings: null, indicators: null },
          logementsCache: { logements: null, indicators: null },
          singleImmeubleCache: {},
          singleLogementCache: {},
        }),
    }),
    {
      name: "data-store", // unique name for localStorage key
    }
  )
);
