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
