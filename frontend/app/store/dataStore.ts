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

interface DataStoreState {
  loginData: LoginOutputDto | null;
  setLoginData: (data: LoginOutputDto) => void;
  clearLoginData: () => void;
}

export const useDataStore = create<DataStoreState>()(
  persist(
    (set) => ({
      loginData: null,
      setLoginData: (data: LoginOutputDto) => set({ loginData: data }),
      clearLoginData: () => set({ loginData: null }),
    }),
    {
      name: "data-store", // unique name for localStorage key
    }
  )
);
