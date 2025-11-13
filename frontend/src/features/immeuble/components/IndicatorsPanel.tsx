"use client";

import React from "react";
import IndicatorsSkeleton from "./IndicatorsSkeleton";
import { Indicator } from "@/src/shared/hooks/useImmeubles";

interface IndicatorsPanelProps {
  indicators: Indicator[];
  loading: boolean;
  error: string | null;
  onRefresh?: () => void;
}

const IndicatorsPanel: React.FC<IndicatorsPanelProps> = ({
  indicators,
  loading,
  error,
  onRefresh,
}) => {
  if (loading) {
    return <IndicatorsSkeleton count={3} />;
  }

  if (error) {
    return (
      <div className="bg-red-50 border border-red-200 rounded-lg p-6">
        <div className="flex items-center justify-between">
          <div>
            <h3 className="text-lg font-medium text-red-800 mb-2">
              Erreur lors du chargement des indicateurs
            </h3>
            <p className="text-red-600 text-sm">{error}</p>
          </div>
          {onRefresh && (
            <button
              onClick={onRefresh}
              className="px-4 py-2 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition-colors"
            >
              Réessayer
            </button>
          )}
        </div>
      </div>
    );
  }

  if (indicators.length === 0) {
    return (
      <div className="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
        <div className="text-gray-400 mb-2">
          <i className="fas fa-chart-line text-3xl"></i>
        </div>
        <h3 className="text-lg font-medium text-gray-600 mb-2">
          Aucun indicateur disponible
        </h3>
        <p className="text-gray-500 text-sm">
          Les indicateurs seront chargés une fois les données disponibles
        </p>
      </div>
    );
  }

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="flex items-center justify-between">
        <h3 className="text-xl font-semibold text-gray-800">
          Indicateurs de performance
        </h3>
        <div className="flex items-center space-x-2">
          <span className="text-sm text-gray-500">
            {indicators.length} indicateur{indicators.length > 1 ? "s" : ""}
          </span>
          {onRefresh && (
            <button
              onClick={onRefresh}
              className="p-2 text-gray-400 hover:text-gray-600 transition-colors"
              title="Actualiser les indicateurs"
            >
              <i className="fas fa-sync-alt"></i>
            </button>
          )}
        </div>
      </div>

      {/* Indicators Grid */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {indicators.map((indicator, index) => (
          <div
            key={`${indicator.pkImmeuble}-${index}`}
            className="bg-white rounded-lg shadow-md p-6 border border-gray-200"
          >
            <div className="flex items-center justify-between mb-4">
              <h4 className="text-lg font-medium text-gray-800">
                Immeuble #{indicator.pkImmeuble}
              </h4>
              <div className="h-2 w-2 bg-green-400 rounded-full"></div>
            </div>

            {/* Indicator content - this will be customized based on actual data structure */}
            <div className="space-y-3">
              {Object.entries(indicator)
                .filter(([key]) => key !== "pkImmeuble")
                .slice(0, 4) // Show first 4 properties
                .map(([key, value]) => (
                  <div key={key} className="flex justify-between items-center">
                    <span className="text-sm text-gray-600 capitalize">
                      {key.replace(/([A-Z])/g, " $1").trim()}:
                    </span>
                    <span className="text-sm font-medium text-gray-800">
                      {typeof value === "object"
                        ? JSON.stringify(value).substring(0, 20) + "..."
                        : String(value)}
                    </span>
                  </div>
                ))}
            </div>

            {/* View details button */}
            <div className="mt-4 pt-4 border-t border-gray-100">
              <button className="w-full text-sm text-blue-600 hover:text-blue-800 transition-colors">
                Voir les détails
              </button>
            </div>
          </div>
        ))}
      </div>
    </div>
  );
};

export default IndicatorsPanel;
