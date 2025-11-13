"use client";

import React from "react";
import { GaugeComponent } from "react-gauge-component";
import type { GetParcResponseDto } from "@/src/features/parc/types/response/GetParcResponseDto";

interface DepanageGaugeProps {
  data: GetParcResponseDto;
  maxValue?: number;
  href?: string;
}

const DepanageGauge: React.FC<DepanageGaugeProps> = ({
  data,
  maxValue = 10,
  href = "/immeubles?depannages=1",
}) => {
  const nbDepannages = data.nbDepannages ?? 0;
  const displayValue = nbDepannages === -1 ? 0 : nbDepannages;

  // Couleur du gauge basée sur le nombre de dépannages
  const getGaugeColor = () => {
    if (displayValue === 0) return "#8e98a2"; // Gris si aucun dépannage
    if (displayValue <= maxValue * 0.3) return "#10b981"; // Vert si peu de dépannages
    if (displayValue <= maxValue * 0.7) return "#f59e0b"; // Orange si modéré
    return "#ef4444"; // Rouge si beaucoup
  };

  const gaugeColor = getGaugeColor();

  return (
    <div className="panel-default p-6 border-2 border-black rounded-lg">
      <a
        href={href}
        className="block hover:bg-gray-50 transition-colors duration-200"
      >
        <div className="panel-body">
          {/* Title */}
          <div className="intitule mb-4">
            <span className="text-sm font-medium text-dashboard-textSecondary">
              Dépannages en cours
            </span>
          </div>

          {/* Gauge */}
          <div className="canvas flex justify-center mb-4">
            <GaugeComponent
              value={displayValue}
              minValue={0}
              maxValue={maxValue}
              arc={{
                colorArray: [gaugeColor],
                padding: 0.02,
                subArcs: [
                  { limit: maxValue * 0.3, color: "#10b981" },
                  { limit: maxValue * 0.7, color: "#f59e0b" },
                  { limit: maxValue, color: "#ef4444" },
                ],
              }}
              pointer={{
                type: "arrow",
                color: gaugeColor,
                length: 0.8,
                width: 0.08,
              }}
              labels={{
                valueLabel: {
                  formatTextValue: (value) => Math.round(value).toString(),
                  style: {
                    fontSize: 24,
                    fontWeight: "bold",
                    fill: "#333333",
                  },
                },
                tickLabels: {
                  type: "inner",
                  ticks: [
                    { value: 0 },
                    { value: maxValue * 0.25 },
                    { value: maxValue * 0.5 },
                    { value: maxValue * 0.75 },
                    { value: maxValue },
                  ],
                  defaultTickValueConfig: {
                    formatTextValue: (value) => Math.round(value).toString(),
                    style: {
                      fontSize: 10,
                      fill: "#666666",
                    },
                  },
                },
              }}
            />
          </div>

          {/* Count display */}
          <div className="taux text-center">
            <div className="text-2xl font-bold text-dashboard-textPrimary">
              {displayValue}
            </div>
          </div>
        </div>
      </a>
    </div>
  );
};

export default DepanageGauge;
