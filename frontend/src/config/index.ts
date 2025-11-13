// Configuration for the application
export const config = {
  // API Configuration
  apiUrl: process.env.NEXT_PUBLIC_API_URL || "http://localhost:8000",

  // Environment
  isDevelopment: process.env.NODE_ENV === "development",
  isProduction: process.env.NODE_ENV === "production",

  // Feature flags
  features: {
    demoMode: process.env.NODE_ENV === "development",
    /**
     * Mode mock : utilise les fichiers JSON depuis /public/data/ au lieu des vraies API
     * Activé via la variable d'environnement NEXT_PUBLIC_USE_MOCK_DATA=true
     */
    mockData: process.env.NEXT_PUBLIC_USE_MOCK_DATA === "true",
  },

  // Mock configuration
  mock: {
    /**
     * Délai minimum de simulation réseau en millisecondes (défaut: 1000ms = 1 seconde)
     * Configurable via NEXT_PUBLIC_MOCK_DELAY_MIN dans .env.local
     */
    delayMin: parseInt(process.env.NEXT_PUBLIC_MOCK_DELAY_MIN || "1000", 10),
    /**
     * Délai maximum de simulation réseau en millisecondes (défaut: 10000ms = 10 secondes)
     * Configurable via NEXT_PUBLIC_MOCK_DELAY_MAX dans .env.local
     * Permet de voir le skeleton pendant le chargement des données mockées
     */
    delayMax: parseInt(process.env.NEXT_PUBLIC_MOCK_DELAY_MAX || "10000", 10),
  },
};

/**
 * Vérifie si le mode mock est activé
 * @returns true si NEXT_PUBLIC_USE_MOCK_DATA est défini à "true"
 */
export function isMockModeEnabled(): boolean {
  return config.features.mockData;
}

/**
 * Vérifie si on doit utiliser les données mockées
 * @returns true si le mode mock est activé
 */
export function shouldUseMockData(): boolean {
  return isMockModeEnabled();
}

export default config;
