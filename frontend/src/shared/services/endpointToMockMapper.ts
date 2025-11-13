/**
 * Mapper pour convertir les endpoints API en noms de fichiers JSON mock
 */

/**
 * Convertit un endpoint API en nom de fichier JSON mock
 * @param endpoint Endpoint API (ex: "/api/parc", "/api/immeuble/123")
 * @param method Méthode HTTP (GET, POST, etc.)
 * @returns Nom du fichier JSON mock ou null si non trouvé
 */
export function endpointToMockFile(
  endpoint: string,
  method: string = "GET"
): string | null {
  // Normaliser l'endpoint (enlever les paramètres de requête et les IDs dynamiques)
  const normalizedEndpoint = endpoint
    .split("?")[0] // Enlever les query params
    .replace(/\/\d+/g, "") // Remplacer les IDs numériques
    .replace(/\/[a-f0-9-]+/g, "") // Remplacer les UUIDs
    .toLowerCase();

  // Mapping des endpoints vers les fichiers JSON
  const endpointMap: Record<string, string> = {
    // Security
    "/api/security/login": "LoginAction.json",
    "/api/security/me": "MeAction.json",
    "/api/security/logout": "LogoutAction.json",
    "/api/security/reset-password": "ResetPasswordAction.json",
    "/api/security/update-password": "UpdatePasswordAction.json",
    "/api/security/create": "CreateAction.json",

    // Parc
    "/api/parc": "GetParcAction.json",

    // Immeuble
    "/api/immeuble": "ListImmeublesAction.json",
    "/api/immeuble/logements": "ListLogementsByImmeubleAction.json",
    "/api/immeuble/capteur": "GetImmeubleCapteurAction.json",
    "/api/immeuble/cet": "GetImmeubleCETAction.json",
    "/api/immeuble/ec": "GetImmeubleECAction.json",
    "/api/immeuble/ef": "GetImmeubleEFAction.json",
    "/api/immeuble/repart": "GetImmeubleRepartAction.json",
    "/api/immeuble/serie-consos-eau": "GetImmeubleSerieConsosEAUAction.json",
    "/api/immeuble/anomalies": "ListAnomaliesByImmeubleAction.json",
    "/api/immeuble/dysfonctionnements":
      "ListDysfonctionnementsByImmeubleAction.json",
    "/api/immeuble/fuites": "ListFuitesByImmeubleAction.json",
    "/api/immeuble/interventions": "ListInterventionsByImmeubleAction.json",

    // Logement
    "/api/logement": "GetLogementAction.json",
    "/api/logement/capteur": "GetLogementCapteursAction.json",
    "/api/logement/cet": "GetLogementCETAction.json",
    "/api/logement/ec": "GetLogementECAction.json",
    "/api/logement/ef": "GetLogementEFAction.json",
    "/api/logement/repart": "GetLogementRespartAction.json",
    "/api/logement/anomalies": "ListAnomaliesByLogementAction.json",
    "/api/logement/dysfonctionnements":
      "ListDysfonctionnementsByLogementAction.json",
    "/api/logement/fuites": "ListFuitesByLogementAction.json",
    "/api/logement/interventions": "ListInterventionsByLogementAction.json",

    // Facture
    "/api/facture": "ListFacturesAction.json",

    // Intervention
    "/api/intervention": "ListCasesOutputDto.json",

    // External
    "/api/external/document": "StoredDocumentOutputDto.json",
    "/api/external/report": "GetReportByTokenOutputDto.json",
    "/api/external/suivi": "GeneratedDocumentOutputDto.json",

    // Document
    "/api/document/report-excel": "GetReportExcelOutputDto.json",
  };

  // Chercher une correspondance exacte
  if (endpointMap[normalizedEndpoint]) {
    return endpointMap[normalizedEndpoint];
  }

  // Gestion spéciale pour les endpoints avec IDs
  // Ex: /api/immeuble/123 -> /api/immeuble -> GetImmeubleAction.json
  // Ex: /api/immeuble/123/ef -> /api/immeuble/ef -> GetImmeubleEFAction.json
  // Ex: /api/logement/456 -> /api/logement -> GetLogementAction.json
  // Ex: /api/logement/456/ec -> /api/logement/ec -> GetLogementECAction.json

  // Patterns pour les endpoints avec IDs
  const patternsWithId = [
    // Immeuble avec ID (singulier)
    { pattern: /^\/api\/immeuble\/[^/]+$/i, file: "GetImmeubleAction.json" },
    {
      pattern: /^\/api\/immeuble\/[^/]+\/logements$/i,
      file: "ListLogementsByImmeubleAction.json",
    },
    {
      pattern: /^\/api\/immeuble\/[^/]+\/capteur$/i,
      file: "GetImmeubleCapteurAction.json",
    },
    {
      pattern: /^\/api\/immeuble\/[^/]+\/cet$/i,
      file: "GetImmeubleCETAction.json",
    },
    {
      pattern: /^\/api\/immeuble\/[^/]+\/ec$/i,
      file: "GetImmeubleECAction.json",
    },
    {
      pattern: /^\/api\/immeuble\/[^/]+\/ef$/i,
      file: "GetImmeubleEFAction.json",
    },
    {
      pattern: /^\/api\/immeuble\/[^/]+\/repart$/i,
      file: "GetImmeubleRepartAction.json",
    },
    {
      pattern: /^\/api\/immeuble\/[^/]+\/serie-consos-eau$/i,
      file: "GetImmeubleSerieConsosEAUAction.json",
    },
    {
      pattern: /^\/api\/immeuble\/[^/]+\/anomalies$/i,
      file: "ListAnomaliesByImmeubleAction.json",
    },
    {
      pattern: /^\/api\/immeuble\/[^/]+\/dysfonctionnements$/i,
      file: "ListDysfonctionnementsByImmeubleAction.json",
    },
    {
      pattern: /^\/api\/immeuble\/[^/]+\/fuites$/i,
      file: "ListFuitesByImmeubleAction.json",
    },
    {
      pattern: /^\/api\/immeuble\/[^/]+\/interventions$/i,
      file: "ListInterventionsByImmeubleAction.json",
    },

    // Immeubles avec ID (pluriel)
    {
      pattern: /^\/api\/immeubles\/[^/]+\/interventions$/i,
      file: "ListInterventionsByImmeubleAction.json",
    },

    // Logement avec ID (singulier)
    { pattern: /^\/api\/logement\/[^/]+$/i, file: "GetLogementAction.json" },
    {
      pattern: /^\/api\/logement\/[^/]+\/capteur$/i,
      file: "GetLogementCapteursAction.json",
    },
    {
      pattern: /^\/api\/logement\/[^/]+\/cet$/i,
      file: "GetLogementCETAction.json",
    },
    {
      pattern: /^\/api\/logement\/[^/]+\/ec$/i,
      file: "GetLogementECAction.json",
    },
    {
      pattern: /^\/api\/logement\/[^/]+\/ef$/i,
      file: "GetLogementEFAction.json",
    },
    {
      pattern: /^\/api\/logement\/[^/]+\/repart$/i,
      file: "GetLogementRespartAction.json",
    },
    {
      pattern: /^\/api\/logement\/[^/]+\/anomalies$/i,
      file: "ListAnomaliesByLogementAction.json",
    },
    {
      pattern: /^\/api\/logement\/[^/]+\/dysfonctionnements$/i,
      file: "ListDysfonctionnementsByLogementAction.json",
    },
    {
      pattern: /^\/api\/logement\/[^/]+\/fuites$/i,
      file: "ListFuitesByLogementAction.json",
    },
    {
      pattern: /^\/api\/logement\/[^/]+\/interventions$/i,
      file: "ListInterventionsByLogementAction.json",
    },

    // Logements avec ID (pluriel)
    {
      pattern: /^\/api\/logements\/[^/]+\/interventions$/i,
      file: "ListInterventionsByLogementAction.json",
    },
  ];

  // Vérifier les patterns avec IDs (sur l'endpoint original, pas normalisé)
  const originalEndpoint = endpoint.split("?")[0].toLowerCase();
  for (const { pattern, file } of patternsWithId) {
    if (pattern.test(originalEndpoint)) {
      return file;
    }
  }

  // Chercher une correspondance partielle (pour les endpoints avec IDs normalisés)
  for (const [pattern, filename] of Object.entries(endpointMap)) {
    // Si l'endpoint normalisé commence par le pattern
    if (normalizedEndpoint.startsWith(pattern)) {
      return filename;
    }
  }

  console.warn(
    `No mock file found for endpoint: ${endpoint} (normalized: ${normalizedEndpoint})`
  );
  return null;
}

/**
 * Extrait les paramètres de l'endpoint pour construire le nom du fichier mock
 * @param endpoint Endpoint complet avec paramètres
 * @returns Endpoint normalisé sans paramètres
 */
export function normalizeEndpoint(endpoint: string): string {
  return endpoint
    .split("?")[0] // Enlever les query params
    .replace(/\/\d+/g, "") // Remplacer les IDs numériques
    .replace(/\/[a-f0-9-]{36}/g, "") // Remplacer les UUIDs
    .toLowerCase();
}
