"use client";

import React from "react";
import Link from "next/link";
import type { GetParcResponseDto } from "@/src/features/parc/types/response/GetParcResponseDto";

interface AlerteProps {
  data: GetParcResponseDto;
  isDemo?: boolean;
}

const Alerte: React.FC<AlerteProps> = ({ data, isDemo = false }) => {
  const nbFuites = data.nbFuites ?? 0;
  const nbAnomalies = data.nbAnomalies ?? 0;
  const displayFuites = nbFuites === -1 ? 0 : nbFuites;
  const displayAnomalies = nbAnomalies === -1 ? 0 : nbAnomalies;

  return (
    <div
      className="panel border-2 border-black rounded-lg p-4"
      style={{
        borderColor: "#606060",
        borderStyle: "solid",
        borderWidth: "1px",
        borderRadius: "10px",
      }}
    >
      {/* Title */}
      <div className="block-title text-lg font-bold text-gray-900 mb-6 uppercase">
        ALERTES CLIENT
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
        {/* Fuites Alert Card */}
        <div className="flex flex-col">
          <Link
            href="/immeubles?fuites=1"
            className="block bg-gray-100 hover:bg-gray-200 rounded-xl p-6 transition-all duration-200 hover:shadow-md"
          >
            <div className="flex items-center justify-between">
              {/* Left: Icon */}
              <div className="flex items-center gap-4">
                <div className="w-12 h-12 bg-blue-500 rounded-full flex items-center justify-center flex-shrink-0">
                  <i className="fas fa-tint text-white text-xl"></i>
                </div>
                <div className="text-sm font-medium text-gray-700">
                  Nombre de fuites
                </div>
              </div>

              {/* Right: Value in red circle */}
              <div className="flex-shrink-0">
                <div className="w-16 h-16 rounded-full border-2 border-red-200 bg-red-50 flex items-center justify-center">
                  <span className="text-2xl font-bold text-red-600">
                    {displayFuites}
                  </span>
                </div>
              </div>
            </div>
          </Link>

          {/* Download Button */}
          {isDemo && (
            <a
              href="/xlsx/export-fuites-global.xlsx"
              className="mt-3 bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-lg text-sm transition-colors duration-200 text-center flex items-center justify-center gap-2"
            >
              <i className="fas fa-download"></i>
              <span>Synthèse patrimoine</span>
            </a>
          )}
        </div>

        {/* Anomalies Alert Card */}
        <div className="flex flex-col">
          <Link
            href="/immeubles?anomalies=1"
            className="block bg-gray-100 hover:bg-gray-200 rounded-xl p-6 transition-all duration-200 hover:shadow-md"
          >
            <div className="flex items-center justify-between">
              {/* Left: Icon */}
              <div className="flex items-center gap-4">
                <div className="w-12 h-12 bg-orange-500 rounded-lg transform rotate-45 flex items-center justify-center flex-shrink-0">
                  <i className="fas fa-exclamation text-white text-xl transform -rotate-45"></i>
                </div>
                <div className="text-sm font-medium text-gray-700">
                  Nombre d&apos;anomalies de consommation
                </div>
              </div>

              {/* Right: Value in red circle */}
              <div className="flex-shrink-0">
                <div className="w-16 h-16 rounded-full border-2 border-red-200 bg-red-50 flex items-center justify-center">
                  <span className="text-2xl font-bold text-red-600">
                    {displayAnomalies}
                  </span>
                </div>
              </div>
            </div>
          </Link>

          {/* Download Button */}
          {isDemo && (
            <a
              href="/xlsx/export-anomalies-global.xlsx"
              className="mt-3 bg-gray-200 hover:bg-gray-300 text-gray-800 py-2 px-4 rounded-lg text-sm transition-colors duration-200 text-center flex items-center justify-center gap-2"
            >
              <i className="fas fa-download"></i>
              <span>Synthèse patrimoine</span>
            </a>
          )}
        </div>
      </div>
    </div>
  );
};

export default Alerte;
