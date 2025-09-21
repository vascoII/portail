export interface ConsumptionData {
  period: string;
  value: number;
  unit: string;
  trend: "up" | "down" | "stable";
  percentage: number;
}

export interface WaterConsumptionData extends ConsumptionData {
  type: "eau_froide" | "eau_chaude";
}

export interface HeatingConsumptionData extends ConsumptionData {
  type: "cet" | "repartiteur";
}

export interface ElectricityConsumptionData extends ConsumptionData {
  type: "electricite";
}

export interface GasConsumptionData extends ConsumptionData {
  type: "gaz";
}

export interface TemperatureData {
  period: string;
  temperature: number;
  humidity: number;
  trend: "up" | "down" | "stable";
  percentage: number;
}

export interface ConsumptionFilters {
  period: "day" | "week" | "month" | "year";
  startDate?: string;
  endDate?: string;
  energyType?: "eau" | "chauffage" | "electricite" | "gaz" | "temperature";
}

export interface ConsumptionStats {
  current: number;
  previous: number;
  trend: "up" | "down" | "stable";
  percentage: number;
  unit: string;
}

export type EnergyType =
  | "eau"
  | "chauffage"
  | "electricite"
  | "gaz"
  | "temperature";
export type ConsumptionPeriod = "day" | "week" | "month" | "year";
