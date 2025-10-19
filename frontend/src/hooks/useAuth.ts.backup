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
} from "../types/auth";

// Configuration SWR
const SWR_CONFIG = {
  revalidateOnFocus: false,
  revalidateOnReconnect: true,
  dedupingInterval: 2000,
};

// Fetcher pour SWR
const fetcher = async (url: string): Promise<User | null> => {
  const token = localStorage.getItem("auth_token");
  if (!token) return null;

  const response = await fetch(url, {
    headers: {
      Authorization: `Bearer ${token}`,
      "Content-Type": "application/json",
    },
  });

  if (!response.ok) {
    if (response.status === 401) {
      localStorage.removeItem("auth_token");
      localStorage.removeItem("refresh_token");
      return null;
    }
    throw new Error("Failed to fetch user data");
  }

  return response.json();
};

// Hook principal d'authentification
export const useAuth = () => {
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
    authState.isAuthenticated ? "/api/auth/me" : null,
    fetcher,
    SWR_CONFIG
  );

  // Fonction de login
  const login = useCallback(
    async (credentials: LoginFormData): Promise<void> => {
      setAuthState((prev) => ({ ...prev, isLoading: true, error: null }));

      try {
        const response = await fetch("/api/auth/login", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({
            username: credentials.username,
            password: credentials.password,
            rememberMe: credentials.rememberMe,
          }),
        });

        const data: LoginResponse = await response.json();

        if (!response.ok) {
          throw new Error(data.message || "Login failed");
        }

        // Stocker les tokens
        localStorage.setItem("auth_token", data.token);
        if (data.refreshToken) {
          localStorage.setItem("refresh_token", data.refreshToken);
        }

        // Mettre à jour l'état
        setAuthState({
          user: data.user,
          token: data.token,
          isAuthenticated: true,
          isLoading: false,
          error: null,
        });

        // Invalider le cache SWR pour forcer la revalidation
        mutate();
      } catch (error) {
        const authError: AuthError = {
          message: error instanceof Error ? error.message : "Login failed",
          code: "LOGIN_FAILED",
        };

        setAuthState((prev) => ({
          ...prev,
          isLoading: false,
          error: authError,
        }));

        throw error;
      }
    },
    [mutate]
  );

  // Fonction de logout
  const logout = useCallback(async (): Promise<void> => {
    try {
      // Appeler l'API de logout
      await fetch("/api/auth/logout", {
        method: "POST",
        headers: {
          Authorization: `Bearer ${authState.token}`,
        },
      });
    } catch (error) {
      console.error("Logout error:", error);
    } finally {
      // Nettoyer le localStorage
      localStorage.removeItem("auth_token");
      localStorage.removeItem("refresh_token");

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
  }, [authState.token, mutate]);

  // Fonction de refresh token
  const refreshToken = useCallback(async (): Promise<boolean> => {
    const refreshTokenValue = localStorage.getItem("refresh_token");
    if (!refreshTokenValue) return false;

    try {
      const response = await fetch("/api/auth/refresh", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ refreshToken: refreshTokenValue }),
      });

      if (!response.ok) return false;

      const data: LoginResponse = await response.json();

      localStorage.setItem("auth_token", data.token);
      if (data.refreshToken) {
        localStorage.setItem("refresh_token", data.refreshToken);
      }

      setAuthState((prev) => ({
        ...prev,
        token: data.token,
        isAuthenticated: true,
      }));

      return true;
    } catch (error) {
      console.error("Token refresh failed:", error);
      return false;
    }
  }, []);

  // Initialisation au chargement
  useEffect(() => {
    const initAuth = async () => {
      const token = localStorage.getItem("auth_token");
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
