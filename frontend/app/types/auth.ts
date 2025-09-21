// Types pour l'authentification
export interface User {
  loginId: string;
  userName: string;
  email: string;
  userType: string;
  firstName: string;
  userRole: string;
  clientId: string;
  clientName: string;
  showImmeublesArc: boolean;
  showFactures: boolean;
  showChgtOccupant: boolean;
  showChantiers: boolean;
}

export type UserRole = "admin" | "operator" | "occupant" | "client";

export interface LoginCredentials {
  username: string;
  password: string;
  rememberMe?: boolean;
}

export interface LoginResponse {
  success: boolean;
  jwt: string;
  userName: string;
  error?: string;
}

export interface AuthError {
  message: string;
  code: string;
  field?: string;
}

export interface AuthState {
  user: User | null;
  token: string | null;
  isAuthenticated: boolean;
  isLoading: boolean;
  error: AuthError | null;
}

export interface LoginFormData {
  username: string;
  password: string;
  rememberMe: boolean;
}

export interface ResetPasswordRequest {
  email: string;
}

export interface UpdatePasswordRequest {
  currentPassword: string;
  newPassword: string;
  confirmPassword: string;
}

// Types pour les réponses API
export interface ApiResponse<T> {
  data: T;
  success: boolean;
  message?: string;
}

export interface ApiError {
  message: string;
  code: string;
  details?: Record<string, any>;
}
