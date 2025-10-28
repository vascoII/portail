import type {
  ParcData,
  UserData,
  DashboardData,
  ConstructionStats,
} from "@/types/api";

// Transform backend data to match frontend component expectations
export const transformParcData = (
  parcData: ParcData,
  userData?: UserData
): DashboardData => {
  return {
    // Parc overview data - map backend field names to frontend expectations
    NbImmeubles: parcData.nbImmeubles,
    NbCompteurs: parcData.nbCompteurs,
    NbCompteursEF: parcData.nbCompteursEf,
    NbCompteursEC: parcData.nbCompteursEc,
    NbCompteursRepart: parcData.nbCompteursRepart,
    NbCompteursCET: parcData.nbCompteursCet,
    NbCompteursElect: parcData.nbCompteursElect,
    NbCompteursGaz: parcData.nbCompteursGaz,
    PcImmeublesTransfertFichiers: parcData.pcImmeublesTransfertFichiers,
    showChgtOccupant: userData?.showChgtOccupant ?? false,

    // Status data
    NbFuites: parcData.nbFuites,
    NbDysfonctionnements: parcData.nbDysfonctionnements,
    NbAnomalies: parcData.nbAnomalies,
    NbDepannages: parcData.nbDepannages,

    // Construction data
    NbChantiers: parcData.nbChantiers,
    NbCompteursCommandes: parcData.nbCompteursCommandes,
    NbCompteursPoses: parcData.nbCompteursPoses,
    DateEntreeChantier: null, // Not available in current API response

    // Demo mode - determine based on environment or user data
    isDemo:
      userData?.isDemo ?? (process.env.NODE_ENV === "development" || false),
  };
};

// Calculate construction percentages with proper error handling
export const calculateConstructionStats = (
  data: DashboardData
): ConstructionStats => {
  const total = data.NbCompteursCommandes;
  const installed = data.NbCompteursPoses;
  const remaining = Math.max(0, total - installed);

  if (total > 0) {
    return {
      installed,
      installed_percent: Math.round((100 * installed) / total),
      remaining,
      remaining_percent: Math.round((100 * remaining) / total),
      total,
    };
  }

  return {
    installed: 0,
    installed_percent: 100,
    remaining: 0,
    remaining_percent: 0,
    total: 0,
  };
};

// Calculate telemetry statistics
export const calculateTelemetryStats = (parcData: ParcData) => {
  const totalToRead = parcData.nbCompteursARelever;
  const read = parcData.nbCompteursReleves;
  const notRead = Math.max(0, totalToRead - read);

  if (totalToRead > 0) {
    return {
      total: totalToRead,
      read,
      notRead,
      readPercentage: Math.round((100 * read) / totalToRead),
      notReadPercentage: Math.round((100 * notRead) / totalToRead),
    };
  }

  return {
    total: 0,
    read: 0,
    notRead: 0,
    readPercentage: 100,
    notReadPercentage: 0,
  };
};

// Calculate alert statistics with severity levels
export const calculateAlertStats = (parcData: ParcData) => {
  return {
    fuites: {
      count: parcData.nbFuites,
      severity:
        parcData.degresFuites === -1
          ? "unknown"
          : getSeverityLevel(parcData.degresFuites),
      percentage:
        parcData.nbCompteurs > 0
          ? Math.round((100 * parcData.nbFuites) / parcData.nbCompteurs)
          : 0,
    },
    depannages: {
      count: parcData.nbDepannages,
      severity:
        parcData.degresDepannages === -1
          ? "unknown"
          : getSeverityLevel(parcData.degresDepannages),
      percentage:
        parcData.nbCompteurs > 0
          ? Math.round((100 * parcData.nbDepannages) / parcData.nbCompteurs)
          : 0,
    },
    dysfonctionnements: {
      count: parcData.nbDysfonctionnements,
      severity:
        parcData.degresDysfonctionnements === -1
          ? "unknown"
          : getSeverityLevel(parcData.degresDysfonctionnements),
      percentage:
        parcData.nbCompteurs > 0
          ? Math.round(
              (100 * parcData.nbDysfonctionnements) / parcData.nbCompteurs
            )
          : 0,
    },
    anomalies: {
      count: parcData.nbAnomalies,
      severity:
        parcData.degresAnomalies === -1
          ? "unknown"
          : getSeverityLevel(parcData.degresAnomalies),
      percentage:
        parcData.nbCompteurs > 0
          ? Math.round((100 * parcData.nbAnomalies) / parcData.nbCompteurs)
          : 0,
    },
  };
};

// Helper function to determine severity level based on degree value
const getSeverityLevel = (
  degree: number
): "low" | "medium" | "high" | "critical" => {
  if (degree <= 25) return "low";
  if (degree <= 50) return "medium";
  if (degree <= 75) return "high";
  return "critical";
};

// Calculate building statistics
export const calculateBuildingStats = (parcData: ParcData) => {
  return {
    total: parcData.nbImmeubles,
    withTelemetry: parcData.nbImmeublesTelereleve,
    withFileTransfer: parcData.nbImmeublesTransfertFichiers,
    telemetryPercentage:
      parcData.nbImmeubles > 0
        ? Math.round(
            (100 * parcData.nbImmeublesTelereleve) / parcData.nbImmeubles
          )
        : 0,
    fileTransferPercentage:
      parcData.nbImmeubles > 0
        ? Math.round(
            (100 * parcData.nbImmeublesTransfertFichiers) / parcData.nbImmeubles
          )
        : 0,
  };
};

// Calculate counter statistics by type
export const calculateCounterStats = (parcData: ParcData) => {
  const total = parcData.nbCompteurs;

  return {
    total,
    byType: {
      eauFroide: {
        count: parcData.nbCompteursEf,
        percentage:
          total > 0 ? Math.round((100 * parcData.nbCompteursEf) / total) : 0,
        available: parcData.nbCompteursEf !== -1,
      },
      eauChaude: {
        count: parcData.nbCompteursEc,
        percentage:
          total > 0 ? Math.round((100 * parcData.nbCompteursEc) / total) : 0,
        available: parcData.nbCompteursEc !== -1,
      },
      repartiteurs: {
        count: parcData.nbCompteursRepart,
        percentage:
          total > 0
            ? Math.round((100 * parcData.nbCompteursRepart) / total)
            : 0,
        available: parcData.nbCompteursRepart !== -1,
      },
      cet: {
        count: parcData.nbCompteursCet,
        percentage:
          total > 0 ? Math.round((100 * parcData.nbCompteursCet) / total) : 0,
        available: parcData.nbCompteursCet !== -1,
      },
      capteurs: {
        count: parcData.nbCompteursCapteur,
        percentage:
          total > 0
            ? Math.round((100 * parcData.nbCompteursCapteur) / total)
            : 0,
        available: parcData.nbCompteursCapteur !== -1,
      },
      electricite: {
        count: parcData.nbCompteursElect,
        percentage:
          total > 0 ? Math.round((100 * parcData.nbCompteursElect) / total) : 0,
        available: parcData.nbCompteursElect !== -1,
      },
      gaz: {
        count: parcData.nbCompteursGaz,
        percentage:
          total > 0 ? Math.round((100 * parcData.nbCompteursGaz) / total) : 0,
        available: parcData.nbCompteursGaz !== -1,
      },
    },
  };
};

// Format numbers for display
export const formatNumber = (
  value: number,
  options?: Intl.NumberFormatOptions
): string => {
  return new Intl.NumberFormat("fr-FR", options).format(value);
};

// Format percentages for display
export const formatPercentage = (
  value: number,
  decimals: number = 0
): string => {
  return `${formatNumber(value, {
    minimumFractionDigits: decimals,
    maximumFractionDigits: decimals,
  })}%`;
};

// Format dates for display
export const formatDate = (
  date: string | Date,
  options?: Intl.DateTimeFormatOptions
): string => {
  const dateObj = typeof date === "string" ? new Date(date) : date;
  return new Intl.DateTimeFormat("fr-FR", options).format(dateObj);
};

// Validate data integrity
export const validateParcData = (
  data: ParcData
): { isValid: boolean; errors: string[] } => {
  const errors: string[] = [];

  // Check for negative values where they shouldn't be
  if (data.nbImmeubles < 0)
    errors.push("Number of buildings cannot be negative");
  if (data.nbCompteurs < 0)
    errors.push("Number of counters cannot be negative");
  if (data.nbLogements < 0)
    errors.push("Number of dwellings cannot be negative");

  // Check for logical inconsistencies
  if (data.nbCompteursCommandes < data.nbCompteursPoses) {
    errors.push("Number of installed counters cannot exceed ordered counters");
  }

  if (data.nbCompteursARelever < data.nbCompteursReleves) {
    errors.push("Number of read counters cannot exceed counters to read");
  }

  // Check percentage values
  if (data.pcImmeublesTelereleve < 0 || data.pcImmeublesTelereleve > 100) {
    errors.push("Telemetry percentage must be between 0 and 100");
  }

  if (
    data.pcImmeublesTransfertFichiers < 0 ||
    data.pcImmeublesTransfertFichiers > 100
  ) {
    errors.push("File transfer percentage must be between 0 and 100");
  }

  return {
    isValid: errors.length === 0,
    errors,
  };
};
