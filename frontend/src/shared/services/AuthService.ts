/**
 * Service d'authentification pour le frontend
 * Simule les appels API vers le backend
 */

import {
  User,
  LoginCredentials,
  LoginResponse,
  SoapLoginResponse,
  SoapUserResponse,
  JWTPayload,
} from "@/src/shared/types/auth";

// Configuration JWT (simulation)
const JWT_CONFIG = {
  secret: process.env.NEXT_PUBLIC_JWT_SECRET || "techem-secret-key",
  expiresIn: "1h",
  refreshExpiresIn: "7d",
  issuer: "techem-api",
  audience: "techem-frontend",
};

// Configuration Redis (simulation)
const REDIS_CONFIG = {
  ttl: 3600, // 1 hour in seconds
  keyPrefix: "techem:session:",
};

// Interface pour les données Redis
interface RedisSessionData {
  sessionId: string;
  pkUser: number;
  user: SoapUserResponse;
  soapResponse: {
    connected: boolean;
    error: string;
    info: string;
  };
  createdAt: string;
  expiresAt: string;
  lastAccessedAt: string;
}

export class AuthService {
  private static instance: AuthService;
  private sessionCache: Map<string, RedisSessionData> = new Map();

  static getInstance(): AuthService {
    if (!AuthService.instance) {
      AuthService.instance = new AuthService();
    }
    return AuthService.instance;
  }

  /**
   * Simule l'appel SOAP pour l'authentification
   */
  private async callSoapService(
    credentials: LoginCredentials
  ): Promise<SoapLoginResponse> {
    // Simulation d'un appel SOAP
    // En réalité, ceci serait un appel HTTP vers votre service SOAP

    // Simulation d'un délai réseau
    await new Promise((resolve) => setTimeout(resolve, 1000));

    // Simulation d'une réponse SOAP basée sur les données fournies
    const mockSoapResponse: SoapLoginResponse = {
      Erreur: "",
      Info: "",
      Connected:
        credentials.username === "DEMOCLIENT" &&
        credentials.password === "Techem92",
      SessionID: "128b6158-f027-44cf-89e1-51391c54e99b",
      User: {
        Erreur: "",
        Info: "",
        LoginID: "DEMOCLIENT",
        UserName: "Demo",
        Password: "Techem92",
        EMail: "noreply@techem.fr",
        UserType: "C",
        PKUser: 1043,
        Adresse: "",
        CP: "",
        Ville: "",
        FK: 38227,
        PhoneNumber: "",
        FirstName: "Client",
        UserRole: "MAISON MERE",
        ClientName: "",
        ClientID: "C00892",
        ExpirationDate: "0001-01-01T00:00:00",
        PasswordExpirationDate: "2025-11-18T14:53:44",
        CGU: "O",
        FKClient: 38227,
        FKClientTop: 38227,
        NbImmeubles: -1,
        Seuil_Conso_EF: -1,
        Seuil_Conso_EC: -1,
        Seuil_Conso_Repart: -1,
        Seuil_Conso_CET: -1,
        Seuil_Conso_Actif: true,
        Seuil_Conso_Email: "",
        showImmeublesArc: false,
        showFactures: true,
        showChgtOccupant: true,
        showChantiers: true,
      },
    };

    if (!mockSoapResponse.Connected) {
      mockSoapResponse.Erreur = "Identifiants invalides";
      mockSoapResponse.Info =
        "Vérifiez votre nom d'utilisateur et mot de passe";
    }

    return mockSoapResponse;
  }

  /**
   * Génère un JWT token
   */
  private generateJWT(payload: JWTPayload): string {
    // Simulation d'un JWT (en réalité, utilisez une librairie comme jsonwebtoken)
    const header = {
      alg: "HS256",
      typ: "JWT",
    };

    const encodedHeader = btoa(JSON.stringify(header));
    const encodedPayload = btoa(JSON.stringify(payload));
    const signature = btoa(
      `${encodedHeader}.${encodedPayload}.${JWT_CONFIG.secret}`
    );

    return `${encodedHeader}.${encodedPayload}.${signature}`;
  }

  /**
   * Valide un JWT token
   */
  private validateJWT(token: string): JWTPayload | null {
    try {
      const parts = token.split(".");
      if (parts.length !== 3) return null;

      const payload = JSON.parse(atob(parts[1]));

      // Vérifier l'expiration
      if (payload.exp && payload.exp < Math.floor(Date.now() / 1000)) {
        return null;
      }

      return payload as JWTPayload;
    } catch (error) {
      return null;
    }
  }

  /**
   * Convertit les données SOAP en format User
   */
  private mapUserData(soapUser: SoapUserResponse): User {
    return {
      id: soapUser.PKUser,
      loginId: soapUser.LoginID,
      userName: soapUser.UserName,
      email: soapUser.EMail,
      firstName: soapUser.FirstName,
      lastName: soapUser.UserName,
      userType: soapUser.UserType,
      userRole: soapUser.UserRole,
      clientId: soapUser.ClientID,
      fkClient: soapUser.FKClient,
      phoneNumber: soapUser.PhoneNumber || undefined,
      address: soapUser.Adresse || undefined,
      postalCode: soapUser.CP || undefined,
      city: soapUser.Ville || undefined,
      isActive: true,
      lastLoginAt: new Date().toISOString(),
      passwordExpirationDate: soapUser.PasswordExpirationDate,
      cguAccepted: soapUser.CGU === "O",
      nbImmeubles: soapUser.NbImmeubles,
      seuilConsoEF: soapUser.Seuil_Conso_EF,
      seuilConsoEC: soapUser.Seuil_Conso_EC,
      seuilConsoRepart: soapUser.Seuil_Conso_Repart,
      seuilConsoCET: soapUser.Seuil_Conso_CET,
      seuilConsoActif: soapUser.Seuil_Conso_Actif,
      seuilConsoEmail: soapUser.Seuil_Conso_Email || undefined,
      showImmeublesArc: soapUser.showImmeublesArc,
      showFactures: soapUser.showFactures,
      showChgtOccupant: soapUser.showChgtOccupant,
      showChantiers: soapUser.showChantiers,
      createdAt: new Date().toISOString(),
      updatedAt: new Date().toISOString(),
    };
  }

  /**
   * Authentifie un utilisateur
   */
  async login(credentials: LoginCredentials): Promise<LoginResponse> {
    try {
      // 1. Appel SOAP
      const soapResponse = await this.callSoapService(credentials);

      if (!soapResponse.Connected) {
        throw new Error(soapResponse.Erreur || "Identifiants invalides");
      }

      // 2. Stocker en Redis (simulation avec Map)
      const sessionData: RedisSessionData = {
        sessionId: soapResponse.SessionID,
        pkUser: soapResponse.User.PKUser,
        user: soapResponse.User,
        soapResponse: {
          connected: soapResponse.Connected,
          error: soapResponse.Erreur,
          info: soapResponse.Info,
        },
        createdAt: new Date().toISOString(),
        expiresAt: new Date(Date.now() + 3600000).toISOString(), // 1 hour
        lastAccessedAt: new Date().toISOString(),
      };

      // Simulation Redis avec Map
      this.sessionCache.set(
        `${REDIS_CONFIG.keyPrefix}${soapResponse.SessionID}`,
        sessionData
      );

      // 3. Générer JWT
      const jwtPayload: JWTPayload = {
        sub: soapResponse.User.PKUser.toString(),
        sessionId: soapResponse.SessionID,
        pkUser: soapResponse.User.PKUser,
        userType: soapResponse.User.UserType,
        clientId: soapResponse.User.ClientID,
        fkClient: soapResponse.User.FKClient,
        iat: Math.floor(Date.now() / 1000),
        exp: Math.floor(Date.now() / 1000) + 3600,
        jti: this.generateUUID(),
      };

      const token = this.generateJWT(jwtPayload);
      const refreshToken = this.generateJWT({
        ...jwtPayload,
        exp: Math.floor(Date.now() / 1000) + 604800, // 7 days
      });

      return {
        token,
        refreshToken,
        user: this.mapUserData(soapResponse.User),
        expiresIn: 3600,
        sessionId: soapResponse.SessionID,
      };
    } catch (error) {
      throw new Error(
        error instanceof Error ? error.message : "Erreur d'authentification"
      );
    }
  }

  /**
   * Valide un token JWT et récupère les données de session
   */
  async validateToken(token: string): Promise<RedisSessionData> {
    // 1. Valider JWT
    const payload = this.validateJWT(token);
    if (!payload) {
      throw new Error("Token invalide ou expiré");
    }

    // 2. Récupérer depuis Redis (simulation)
    const sessionData = this.sessionCache.get(
      `${REDIS_CONFIG.keyPrefix}${payload.sessionId}`
    );
    if (!sessionData) {
      throw new Error("Session expirée");
    }

    // 3. Vérifier l'expiration
    if (new Date(sessionData.expiresAt) < new Date()) {
      this.sessionCache.delete(`${REDIS_CONFIG.keyPrefix}${payload.sessionId}`);
      throw new Error("Session expirée");
    }

    // 4. Mettre à jour lastAccessedAt
    sessionData.lastAccessedAt = new Date().toISOString();
    this.sessionCache.set(
      `${REDIS_CONFIG.keyPrefix}${payload.sessionId}`,
      sessionData
    );

    return sessionData;
  }

  /**
   * Déconnecte un utilisateur
   */
  async logout(token: string): Promise<void> {
    try {
      const payload = this.validateJWT(token);
      if (payload) {
        this.sessionCache.delete(
          `${REDIS_CONFIG.keyPrefix}${payload.sessionId}`
        );
      }
    } catch (error) {
      // Ignorer les erreurs de déconnexion
      console.warn("Erreur lors de la déconnexion:", error);
    }
  }

  /**
   * Rafraîchit un token
   */
  async refreshToken(refreshToken: string): Promise<LoginResponse> {
    try {
      const payload = this.validateJWT(refreshToken);
      if (!payload) {
        throw new Error("Refresh token invalide");
      }

      // Récupérer les données de session
      const sessionData = await this.validateToken(refreshToken);

      // Générer un nouveau token
      const newJwtPayload: JWTPayload = {
        sub: payload.sub,
        sessionId: payload.sessionId,
        pkUser: payload.pkUser,
        userType: payload.userType,
        clientId: payload.clientId,
        fkClient: payload.fkClient,
        iat: Math.floor(Date.now() / 1000),
        exp: Math.floor(Date.now() / 1000) + 3600,
        jti: this.generateUUID(),
      };

      const newToken = this.generateJWT(newJwtPayload);
      const newRefreshToken = this.generateJWT({
        ...newJwtPayload,
        exp: Math.floor(Date.now() / 1000) + 604800,
      });

      return {
        token: newToken,
        refreshToken: newRefreshToken,
        user: this.mapUserData(sessionData.user),
        expiresIn: 3600,
        sessionId: payload.sessionId,
      };
    } catch (error) {
      throw new Error("Impossible de rafraîchir le token");
    }
  }

  /**
   * Génère un UUID simple
   */
  private generateUUID(): string {
    return "xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx".replace(
      /[xy]/g,
      function (c) {
        const r = (Math.random() * 16) | 0;
        const v = c === "x" ? r : (r & 0x3) | 0x8;
        return v.toString(16);
      }
    );
  }

  /**
   * Nettoie les sessions expirées
   */
  cleanupExpiredSessions(): void {
    const now = new Date();
    for (const [key, sessionData] of this.sessionCache.entries()) {
      if (new Date(sessionData.expiresAt) < now) {
        this.sessionCache.delete(key);
      }
    }
  }
}

