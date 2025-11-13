"use client";

import React from "react";
import { GaugeComponent } from "react-gauge-component";
import type { GetParcResponseDto } from "@/src/features/parc/types/response/GetParcResponseDto";

interface ReleveProps {
  data: GetParcResponseDto;
}

const Releve: React.FC<ReleveProps> = ({ data }) => {
  const pcImmeublesTelereleve = data.pcImmeublesTelereleve ?? 0;
  const displayValue = Math.max(0, Math.min(100, pcImmeublesTelereleve));

  // Couleur du gauge basée sur le pourcentage
  const getGaugeColor = () => {
    if (displayValue >= 80) return "#10b981"; // Vert si élevé
    if (displayValue >= 50) return "#f59e0b"; // Orange si modéré
    return "#ef4444"; // Rouge si faible
  };

  const gaugeColor = getGaugeColor();

  return (
    <div
      className="panel panel-primary performance-gauge border-2 border-black rounded-lg p-4 "
      style={{
        textAlign: "center",
        justifyContent: "center",
        alignItems: "center",
        display: "flex",
        flexDirection: "column",
        flexWrap: "wrap",
        flexGrow: 1,
        flexShrink: 1,
        flexBasis: "100%",
        borderColor: "#606060",
        borderStyle: "solid",
        borderWidth: "1px",
        borderRadius: "10px",
      }}
    >
      <div className="block-title text-lg font-semibold mb-4">Vos relevés</div>

      <div className="canvas flex justify-center mb-4 relative">
        <GaugeComponent
          value={displayValue}
          minValue={0}
          maxValue={100}
          arc={{
            colorArray: [gaugeColor],
            padding: 0.02,
            subArcs: [
              { limit: 50, color: "#ef4444" },
              { limit: 80, color: "#f59e0b" },
              { limit: 100, color: "#10b981" },
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
              formatTextValue: (value) => `${Math.round(value)}%`,
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
                { value: 25 },
                { value: 50 },
                { value: 75 },
                { value: 100 },
              ],
              defaultTickValueConfig: {
                formatTextValue: (value) => `${Math.round(value)}%`,
                style: {
                  fontSize: 10,
                  fill: "#666666",
                },
              },
            },
          }}
          type="radial"
          style={{ width: "100%", height: "100%" }}
        />
      </div>

      <div className="text text-center">
        <strong className="text-xl font-bold">{displayValue}</strong>
        <sup className="text-lg">%</sup> des appareils relevés
      </div>
    </div>
  );
};

export default Releve;
