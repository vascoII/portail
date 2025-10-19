import { useState, useEffect } from "react";

interface ConsumptionData {
  period: string;
  value: number;
  unit: string;
  trend: "up" | "down" | "stable";
  percentage: number;
}

interface UseConsumptionReturn {
  data: ConsumptionData[];
  loading: boolean;
  error: string | null;
  refetch: () => void;
  getConsumptionByPeriod: (
    period: "day" | "week" | "month" | "year"
  ) => Promise<ConsumptionData[]>;
}

export const useConsumption = (
  logementId: string,
  energyType: "eau" | "chauffage" | "electricite" | "gaz" | "temperature"
): UseConsumptionReturn => {
  const [data, setData] = useState<ConsumptionData[]>([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  const fetchConsumption = async (period: string = "month") => {
    setLoading(true);
    setError(null);

    try {
      const response = await fetch(
        `/api/logements/${logementId}/consumption/${energyType}?period=${period}`
      );

      if (response.ok) {
        const consumptionData = await response.json();
        setData(consumptionData);
      } else {
        throw new Error("Failed to fetch consumption data");
      }
    } catch (err) {
      setError(err instanceof Error ? err.message : "An error occurred");
    } finally {
      setLoading(false);
    }
  };

  const getConsumptionByPeriod = async (
    period: "day" | "week" | "month" | "year"
  ) => {
    setLoading(true);
    setError(null);

    try {
      const response = await fetch(
        `/api/logements/${logementId}/consumption/${energyType}?period=${period}`
      );

      if (response.ok) {
        const consumptionData = await response.json();
        return consumptionData;
      } else {
        throw new Error("Failed to fetch consumption data");
      }
    } catch (err) {
      setError(err instanceof Error ? err.message : "An error occurred");
      throw err;
    } finally {
      setLoading(false);
    }
  };

  useEffect(() => {
    fetchConsumption();
  }, [logementId, energyType]);

  return {
    data,
    loading,
    error,
    refetch: () => fetchConsumption(),
    getConsumptionByPeriod,
  };
};
