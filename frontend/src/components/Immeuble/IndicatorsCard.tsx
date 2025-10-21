"use client";

import React from "react";
import Link from "next/link";
import { Indicator } from "@/hooks/useImmeubles";
import IndicatorsSkeleton from "./IndicatorsSkeleton";

interface IndicatorsCardProps {
  buildingId: number;
  indicators: Indicator | undefined;
  loading: boolean;
  error: string | null;
}

const IndicatorsCard: React.FC<IndicatorsCardProps> = ({
  buildingId,
  indicators,
  loading,
  error,
}) => {
  if (loading) {
    return (
      <div className="bg-white rounded-lg shadow-md p-6">
        <IndicatorsSkeleton count={1} />
      </div>
    );
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
        </div>
      </div>
    );
  }

  if (!indicators) {
    return (
      <div className="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
        <div className="text-gray-400 mb-2">
          <i className="fas fa-chart-line text-3xl"></i>
        </div>
        <h3 className="text-lg font-medium text-gray-600 mb-2">
          Indicateurs non disponibles
        </h3>
        <p className="text-gray-500 text-sm">
          Les indicateurs pour cet immeuble ne sont pas encore chargés
        </p>
      </div>
    );
  }

  return (
    <div className="bg-white rounded-lg shadow-md p-6">
      {/* Header */}
      <div className="flex items-center justify-between mb-4">
        <h3 className="text-lg font-semibold text-gray-800">
          Indicateurs de performance
        </h3>
        <div className="h-2 w-2 bg-green-400 rounded-full"></div>
      </div>

      {/* Key Metrics Grid */}
      <div className="grid grid-cols-2 gap-4 mb-6">
        <Link
          href={`/immeubles/${buildingId}/logements`}
          className="text-center p-3 bg-blue-50 rounded-lg hover:bg-blue-100 transition-colors duration-200 cursor-pointer"
        >
          <div className="text-2xl font-bold text-blue-600 hover:text-blue-800">
            {indicators.nbLogements}
          </div>
          <div className="text-sm text-blue-800">Logements</div>
        </Link>
        <div className="text-center p-3 bg-green-50 rounded-lg">
          <div className="text-2xl font-bold text-green-600">
            {indicators.nbAppareils}
          </div>
          <div className="text-sm text-green-800">Appareils</div>
        </div>
      </div>

      {/* Water Meters */}
      <div className="mb-4">
        <h4 className="text-sm font-medium text-gray-700 mb-2">
          Compteurs d'eau
        </h4>
        <div className="grid grid-cols-2 gap-2 text-sm">
          <div className="flex justify-between">
            <span className="text-gray-600">Eau froide:</span>
            <span className="font-medium">{indicators.nbCompteursEF}</span>
          </div>
          <div className="flex justify-between">
            <span className="text-gray-600">Eau chaude:</span>
            <span className="font-medium">{indicators.nbCompteursEC}</span>
          </div>
        </div>
      </div>

      {/* Energy Meters */}
      <div className="mb-4">
        <h4 className="text-sm font-medium text-gray-700 mb-2">
          Compteurs d'énergie
        </h4>
        <div className="grid grid-cols-2 gap-2 text-sm">
          <div className="flex justify-between">
            <span className="text-gray-600">Répartiteurs:</span>
            <span className="font-medium">{indicators.nbCompteursRepart}</span>
          </div>
          <div className="flex justify-between">
            <span className="text-gray-600">CET:</span>
            <span className="font-medium">{indicators.nbCompteursCET}</span>
          </div>
          <div className="flex justify-between">
            <span className="text-gray-600">Électricité:</span>
            <span className="font-medium">{indicators.nbCompteursElect}</span>
          </div>
          <div className="flex justify-between">
            <span className="text-gray-600">Gaz:</span>
            <span className="font-medium">{indicators.nbCompteursGaz}</span>
          </div>
        </div>
      </div>

      {/* Alerts */}
      <div className="border-t pt-4">
        <h4 className="text-sm font-medium text-gray-700 mb-2">Alertes</h4>
        <div className="grid grid-cols-2 gap-2 text-sm">
          <div className="flex justify-between">
            <span className="text-gray-600">Fuites:</span>
            <span
              className={`font-medium ${
                indicators.nbFuites > 0 ? "text-red-600" : "text-gray-600"
              }`}
            >
              {indicators.nbFuites}
            </span>
          </div>
          <div className="flex justify-between">
            <span className="text-gray-600">Anomalies:</span>
            <span
              className={`font-medium ${
                indicators.nbAnomalies > 0 ? "text-red-600" : "text-gray-600"
              }`}
            >
              {indicators.nbAnomalies}
            </span>
          </div>
          <div className="flex justify-between">
            <span className="text-gray-600">Dysfonctionnements:</span>
            <span
              className={`font-medium ${
                indicators.nbDysfonctionnements > 0
                  ? "text-orange-600"
                  : "text-gray-600"
              }`}
            >
              {indicators.nbDysfonctionnements}
            </span>
          </div>
          <div className="flex justify-between">
            <span className="text-gray-600">Dépannages:</span>
            <span
              className={`font-medium ${
                indicators.nbDepannages > 0
                  ? "text-yellow-600"
                  : "text-gray-600"
              }`}
            >
              {indicators.nbDepannages}
            </span>
          </div>
        </div>
      </div>

      {/* View Details Button */}
      <div className="mt-4 pt-4 border-t">
        <button className="w-full text-sm text-blue-600 hover:text-blue-800 transition-colors">
          Voir les détails complets
        </button>
      </div>
    </div>
  );
};

export default IndicatorsCard;
