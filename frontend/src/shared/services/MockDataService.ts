/**
 * Mock Data Service
 * Service pour charger les fichiers JSON de simulation depuis /public/data/
 * Utilisé pour simuler les appels API backend en mode développement
 */

import config from "@/src/config";

/**
 * Charge un fichier JSON de mock depuis /public/data/
 * @param filename Nom du fichier JSON (ex: "LoginAction.json")
 * @param delay Délai de simulation réseau en millisecondes (défaut: entre config.mock.delayMin et config.mock.delayMax)
 * @returns Promise avec les données parsées
 */
export async function loadMockData<T>(
  filename: string,
  delay?: number
): Promise<T> {
  // Génère un délai aléatoire entre delayMin et delayMax si non spécifié
  // Par défaut : entre 1 et 3 secondes (configurable via variables d'environnement)
  const delayMin = config.mock.delayMin;
  const delayMax = config.mock.delayMax;
  const delayRange = delayMax - delayMin;
  const networkDelay =
    delay ?? Math.floor(Math.random() * delayRange) + delayMin;

  try {
    // Simule un délai réseau
    await new Promise((resolve) => setTimeout(resolve, networkDelay));

    // Charge le fichier JSON depuis /public/data/
    const response = await fetch(`/data/${filename}`);

    if (!response.ok) {
      throw new Error(
        `Failed to load mock data: ${filename} (HTTP ${response.status})`
      );
    }

    const data: T = await response.json();
    return data;
  } catch (error) {
    console.error(`Error loading mock data from ${filename}:`, error);
    throw new Error(
      `Failed to load mock data from ${filename}: ${
        error instanceof Error ? error.message : "Unknown error"
      }`
    );
  }
}

/**
 * Vérifie si un fichier mock existe
 * @param filename Nom du fichier JSON
 * @returns Promise<boolean> true si le fichier existe
 */
export async function mockDataExists(filename: string): Promise<boolean> {
  try {
    const response = await fetch(`/data/${filename}`, { method: "HEAD" });
    return response.ok;
  } catch {
    return false;
  }
}

/**
 * Classe singleton pour gérer les données mock
 */
export class MockDataService {
  private static instance: MockDataService;
  private cache: Map<string, unknown> = new Map();

  private constructor() {}

  static getInstance(): MockDataService {
    if (!MockDataService.instance) {
      MockDataService.instance = new MockDataService();
    }
    return MockDataService.instance;
  }

  /**
   * Charge un fichier mock avec cache
   * @param filename Nom du fichier JSON
   * @param useCache Si true, utilise le cache (défaut: true)
   * @param delay Délai de simulation réseau en millisecondes
   * @returns Promise avec les données
   */
  async load<T>(
    filename: string,
    useCache: boolean = true,
    delay?: number
  ): Promise<T> {
    // Vérifie le cache
    if (useCache && this.cache.has(filename)) {
      // Simule quand même un petit délai même avec le cache
      await new Promise((resolve) => setTimeout(resolve, 100));
      return this.cache.get(filename) as T;
    }

    // Charge les données
    const data = await loadMockData<T>(filename, delay);

    // Met en cache
    if (useCache) {
      this.cache.set(filename, data);
    }

    return data;
  }

  /**
   * Vide le cache
   */
  clearCache(): void {
    this.cache.clear();
  }

  /**
   * Supprime un fichier spécifique du cache
   * @param filename Nom du fichier à supprimer du cache
   */
  clearCacheEntry(filename: string): void {
    this.cache.delete(filename);
  }
}

// Export de l'instance singleton
export const mockDataService = MockDataService.getInstance();
