"use client";

import { useState, useEffect, useCallback } from "react";
import useSWR from "swr";
import {
  User,
  AuthState,
  AuthError,
  LoginFormData,
  LoginOutputDto,
} from "@/types/auth";
import { useDataStore } from "@/store/dataStore";
import { AUTH_ENDPOINTS, DEFAULT_HEADERS, handleApiError } from "@/config/api";
import { useLogin } from "@/hooks/domain/security";
import type { LoginRequestDto } from "@/types/api/request/Security/LoginRequestDto";
import type { LoginResponseDto } from "@/types/api/response/security/LoginResponseDto";

// Configuration SWR
const SWR_CONFIG = {
  revalidateOnFocus: false,
  revalidateOnReconnect: true,
  dedupingInterval: 2000,
};

// Fetcher pour SWR
const fetcher = async (url: string): Promise<User | null> => {
  const token = localStorage.getItem("jwt_token");
  if (!token) return null;

  const response = await fetch(url, {
    headers: {
      ...DEFAULT_HEADERS,
      Authorization: `Bearer ${token}`,
    },
  });

  if (!response.ok) {
    if (response.status === 401) {
      localStorage.removeItem("jwt_token");
      return null;
    }
    throw new Error("Failed to fetch user data");
  }

  const data = await response.json();
  return data.success ? data.user : null;
};

// Helper function to convert LoginResponseDto to LoginOutputDto
const convertLoginResponseToOutput = (
  response: LoginResponseDto
): LoginOutputDto => {
  return {
    tokenJwt: response.tokenJwt,
    loginId: response.loginId,
    userName: response.userName,
    email: response.email,
    userType: response.userType,
    adresse: response.adresse,
    cp: response.cp,
    ville: response.ville,
    phoneNumber: response.phoneNumber,
    firstName: response.firstName,
    userRole: response.userRole,
    clientName: response.clientName,
    nbImmeubles: response.nbImmeubles,
    seuilConsoEf: response.seuilConsoEf,
    seuilConsoEc: response.seuilConsoEc,
    seuilConsoRepart: response.seuilConsoRepart,
    seuilConsoCet: response.seuilConsoCet,
    seuilConsoActif: response.seuilConsoActif,
    seuilConsoEmail: response.seuilConsoEmail,
    showImmeublesArc: response.showImmeublesArc,
    showFactures: response.showFactures,
    showChgtOccupant: response.showChgtOccupant,
    showChantiers: response.showChantiers,
  };
};

// Hook principal d'authentification
export const useAuth = () => {
  const { setLoginData, clearLoginData, loginData } = useDataStore();
  const [authState, setAuthState] = useState<AuthState>({
    user: null,
    token: null,
    isAuthenticated: false,
    isLoading: true,
    error: null,
  });

  // SWR pour récupérer les données utilisateur
  const {
    data: user,
    error: swrError,
    mutate,
  } = useSWR(
    authState.isAuthenticated ? AUTH_ENDPOINTS.ME : null,
    fetcher,
    SWR_CONFIG
  );

  // Utiliser le hook useLogin pour gérer l'authentification
  const { login: loginHook } = useLogin({
    onSuccess: (loginResponse: LoginResponseDto) => {
      // Convertir LoginResponseDto en LoginOutputDto
      const loginOutput = convertLoginResponseToOutput(loginResponse);

      // Stocker le JWT token dans localStorage
      localStorage.setItem("jwt_token", loginOutput.tokenJwt);

      // Stocker les données complètes dans le data store
      setLoginData(loginOutput);

      // Mettre à jour l'état
      setAuthState({
        user: null, // Will be fetched by SWR
        token: loginOutput.tokenJwt,
        isAuthenticated: true,
        isLoading: false,
        error: null,
      });

      // Invalider le cache SWR pour forcer la revalidation
      mutate();
    },
    onError: (error: string) => {
      const authError: AuthError = {
        message: error,
        code: "LOGIN_FAILED",
      };

      setAuthState((prev) => ({
        ...prev,
        isLoading: false,
        error: authError,
      }));
    },
  });

  // Fonction de login qui convertit LoginFormData en LoginRequestDto
  const login = useCallback(
    async (credentials: LoginFormData): Promise<void> => {
      // Réinitialiser l'erreur du hook useLogin
      loginHook.reset();

      setAuthState((prev) => ({ ...prev, isLoading: true, error: null }));

      try {
        // Convertir LoginFormData en LoginRequestDto
        const loginRequest: LoginRequestDto = {
          username: credentials.username,
          password: credentials.password,
        };

        // Utiliser le hook useLogin pour effectuer la connexion
        await loginHook.mutateAsync(loginRequest);
      } catch (error) {
        // L'erreur est déjà gérée par le onError du useLogin
        throw error;
      }
    },
    [loginHook]
  );

  // Utiliser l'état de chargement du hook useLogin si on est en train de se connecter
  const isLoading = authState.isLoading || loginHook.loading;

  // Utiliser l'erreur du hook useLogin si elle existe, sinon utiliser celle de authState
  const error = loginHook.error
    ? { message: loginHook.error, code: "LOGIN_FAILED" }
    : authState.error;

  // Fonction de logout
  const logout = useCallback(async (): Promise<void> => {
    try {
      // Appeler l'API de logout
      await fetch(AUTH_ENDPOINTS.LOGOUT, {
        method: "POST",
        headers: {
          ...DEFAULT_HEADERS,
          Authorization: `Bearer ${authState.token}`,
        },
      });
    } catch (error) {
      console.error("Logout error:", error);
    } finally {
      // Nettoyer le localStorage
      localStorage.removeItem("jwt_token");

      // Nettoyer le data store
      clearLoginData();

      // Réinitialiser l'état
      setAuthState({
        user: null,
        token: null,
        isAuthenticated: false,
        isLoading: false,
        error: null,
      });

      // Invalider le cache SWR
      mutate(null);
    }
  }, [authState.token, mutate, clearLoginData]);

  // Fonction de refresh token (non utilisée avec JWT)
  const refreshToken = useCallback(async (): Promise<boolean> => {
    // JWT tokens are stateless, no refresh needed
    return false;
  }, []);

  // Initialisation au chargement
  useEffect(() => {
    const initAuth = async () => {
      const token = localStorage.getItem("jwt_token");
      if (!token) {
        setAuthState((prev) => ({ ...prev, isLoading: false }));
        return;
      }

      // Check if we have valid loginData in the store
      const { loginData } = useDataStore.getState();
      if (!loginData || !loginData.loginId) {
        // Token exists but no valid loginData - clear everything
        localStorage.removeItem("jwt_token");
        clearLoginData();
        setAuthState((prev) => ({ ...prev, isLoading: false }));
        return;
      }

      setAuthState((prev) => ({
        ...prev,
        token,
        isAuthenticated: true,
        isLoading: false,
      }));
    };

    initAuth();
  }, [clearLoginData]);

  // Mise à jour de l'état quand les données SWR changent
  useEffect(() => {
    if (user) {
      setAuthState((prev) => ({
        ...prev,
        user,
        isAuthenticated: true,
        isLoading: false,
        error: null,
      }));
    } else if (swrError) {
      setAuthState((prev) => ({
        ...prev,
        user: null,
        isAuthenticated: false,
        isLoading: false,
        error: {
          message: "Failed to fetch user data",
          code: "FETCH_USER_FAILED",
        },
      }));
    }
  }, [user, swrError]);

  return {
    ...authState,
    isLoading, // Utiliser l'état de chargement combiné
    error, // Utiliser l'erreur combinée
    login,
    logout,
    refreshToken,
    mutate,
  };
};
