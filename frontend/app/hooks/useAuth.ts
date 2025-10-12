"use client";

import { useState, useEffect, useCallback } from "react";
import useSWR from "swr";
import {
  User,
  LoginCredentials,
  LoginResponse,
  AuthState,
  AuthError,
  LoginFormData,
  LoginOutputDto,
} from "../types/auth";
import { useDataStore } from "../store/dataStore";
import { AUTH_ENDPOINTS, DEFAULT_HEADERS, handleApiError } from "../config/api";

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

// Hook principal d'authentification
export const useAuth = () => {
  const { setLoginData, clearLoginData } = useDataStore();
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

  // Fonction de login
  const login = useCallback(
    async (credentials: LoginFormData): Promise<void> => {
      setAuthState((prev) => ({ ...prev, isLoading: true, error: null }));

      try {
        const response = await fetch(AUTH_ENDPOINTS.LOGIN, {
          method: "POST",
          headers: DEFAULT_HEADERS,
          body: JSON.stringify({
            username: credentials.username,
            password: credentials.password,
          }),
        });

        const loginData: LoginOutputDto = await response.json();

        if (!response.ok) {
          const error = handleApiError({
            response: { data: loginData, status: response.status },
          });
          throw new Error(error.message);
        }

        // Stocker le JWT token
        localStorage.setItem("jwt_token", loginData.tokenJwt);

        // Stocker les données complètes dans le data store
        setLoginData(loginData);

        // Mettre à jour l'état
        setAuthState({
          user: null, // Will be fetched by SWR
          token: loginData.tokenJwt,
          isAuthenticated: true,
          isLoading: false,
          error: null,
        });

        // Invalider le cache SWR pour forcer la revalidation
        mutate();
      } catch (error) {
        const apiError = handleApiError(error);
        const authError: AuthError = {
          message: apiError.message,
          code: apiError.code || "LOGIN_FAILED",
        };

        setAuthState((prev) => ({
          ...prev,
          isLoading: false,
          error: authError,
        }));

        throw error;
      }
    },
    [mutate, setLoginData]
  );

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

      setAuthState((prev) => ({
        ...prev,
        token,
        isAuthenticated: true,
        isLoading: false,
      }));
    };

    initAuth();
  }, []);

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
    login,
    logout,
    refreshToken,
    mutate,
  };
};
