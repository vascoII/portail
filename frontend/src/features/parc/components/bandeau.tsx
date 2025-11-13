"use client";

import React from "react";
import Link from "next/link";
import type { GetParcResponseDto } from "@/src/features/parc/types/response/GetParcResponseDto";

interface BandeauProps {
  data: GetParcResponseDto;
}

const Bandeau: React.FC<BandeauProps> = ({ data }) => {
  const nbFuites = data.nbFuites === -1 ? 0 : data.nbFuites ?? 0;
  const nbDysfonctionnements =
    data.nbDysfonctionnements === -1 ? 0 : data.nbDysfonctionnements ?? 0;
  const nbAnomalies = data.nbAnomalies === -1 ? 0 : data.nbAnomalies ?? 0;
  const nbDepannages = data.nbDepannages === -1 ? 0 : data.nbDepannages ?? 0;

  const indicators = [
    {
      label: "Fuites",
      value: nbFuites,
      href: "/immeubles?fuites=1",
      color: "bg-blue-100 text-blue-800 border-blue-300",
      icon: "fa-tint",
    },
    {
      label: "Alarmes techniques",
      value: nbDysfonctionnements,
      href: "/immeubles?dysfonctionnements=1",
      color: "bg-orange-100 text-orange-800 border-orange-300",
      icon: "fa-bell",
    },
    {
      label: "Anomalies de consommation",
      value: nbAnomalies,
      href: "/immeubles?anomalies=1",
      color: "bg-red-100 text-red-800 border-red-300",
      icon: "fa-exclamation-triangle",
    },
    {
      label: "Dépannages en cours",
      value: nbDepannages,
      href: "/immeubles?depannages=1",
      color: "bg-yellow-100 text-yellow-800 border-yellow-300",
      icon: "fa-wrench",
    },
  ];

  return (
    <div className="w-full flex justify-center mb-6">
      <div
        className="flex flex-wrap items-center justify-center gap-4 max-w-7xl mx-auto px-4 border-2 border-black rounded-lg py-4"
        style={{
          borderColor: "#606060",
          borderStyle: "solid",
          borderWidth: "1px",
          borderRadius: "10px",
          padding: "1%",
          width: "100%",
          display: "flex",
          justifyContent: "center",
          alignItems: "center",
          flexDirection: "row",
          flexWrap: "wrap",
          flexGrow: 1,
          flexShrink: 1,
          flexBasis: "100%",
        }}
      >
        {indicators.map((indicator, index) => (
          <Link
            key={index}
            href={indicator.href}
            className={`flex items-center gap-3 px-4 py-2 rounded-lg border-2 ${indicator.color} hover:shadow-md transition-all duration-200`}
          >
            <i className={`fas ${indicator.icon} text-lg`}></i>
            <div
              className="flex flex-col"
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
              }}
            >
              <span className="text-xs font-medium">{indicator.label}</span>
              <span className="text-lg font-bold">{indicator.value}</span>
            </div>
          </Link>
        ))}
      </div>
    </div>
  );
};

export default Bandeau;
