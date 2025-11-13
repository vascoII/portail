"use client";

import React from "react";
import {
  ImmeubleCapteurData,
  ImmeubleRepartData,
} from "@/src/shared/hooks/useImmeuble";

interface CapteurRepartPanelProps {
  capteur: ImmeubleCapteurData | null;
  capteurLoading: boolean;
  capteurError: string | null;
  repart: ImmeubleRepartData | null;
  repartLoading: boolean;
  repartError: string | null;
}

const CapteurRepartPanel: React.FC<CapteurRepartPanelProps> = ({
  capteur,
  capteurLoading,
  capteurError,
  repart,
  repartLoading,
  repartError,
}) => {
  const renderSkeleton = () => (
    <div className="animate-pulse">
      <div className="h-6 bg-gray-200 rounded w-1/3 mb-4"></div>
      <div className="space-y-3">
        <div className="h-4 bg-gray-200 rounded"></div>
        <div className="h-4 bg-gray-200 rounded w-2/3"></div>
        <div className="h-4 bg-gray-200 rounded w-1/2"></div>
      </div>
    </div>
  );

  const renderError = (error: string) => (
    <div className="text-center py-4">
      <i className="fas fa-exclamation-triangle text-red-500 text-xl mb-2"></i>
      <p className="text-red-600 text-sm">{error}</p>
    </div>
  );

  return (
    <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
      {/* Left Column - Capteur */}
      <div className="bg-white rounded-lg shadow-md p-6">
        <h3 className="text-xl font-semibold text-gray-800 mb-4 flex items-center">
          <i className="fas fa-thermometer-half text-blue-600 mr-2"></i>
          Capteurs
        </h3>

        {capteurLoading ? (
          renderSkeleton()
        ) : capteurError ? (
          renderError(capteurError)
        ) : capteur?.immeubleCapteur ? (
          <div className="space-y-4">
            {/* Temperature Data */}
            <div>
              <h4 className="text-sm font-medium text-gray-700 mb-2">
                Température
              </h4>
              <div className="bg-gray-50 rounded-lg p-3">
                <div className="grid grid-cols-3 gap-2 text-sm">
                  <div>
                    <span className="text-gray-600">Moyenne:</span>
                    <div className="font-medium">
                      {capteur.immeubleCapteur.IndexRecapTemperature.moy ===
                      "-1"
                        ? "N/A"
                        : `${capteur.immeubleCapteur.IndexRecapTemperature.moy}°C`}
                    </div>
                  </div>
                  <div>
                    <span className="text-gray-600">Max:</span>
                    <div className="font-medium">
                      {capteur.immeubleCapteur.IndexRecapTemperature.max ===
                      "-1"
                        ? "N/A"
                        : `${capteur.immeubleCapteur.IndexRecapTemperature.max}°C`}
                    </div>
                  </div>
                  <div>
                    <span className="text-gray-600">Min:</span>
                    <div className="font-medium">
                      {capteur.immeubleCapteur.IndexRecapTemperature.min ===
                      "-1"
                        ? "N/A"
                        : `${capteur.immeubleCapteur.IndexRecapTemperature.min}°C`}
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {/* Humidity Data */}
            <div>
              <h4 className="text-sm font-medium text-gray-700 mb-2">
                Humidité
              </h4>
              <div className="bg-gray-50 rounded-lg p-3">
                <div className="grid grid-cols-3 gap-2 text-sm">
                  <div>
                    <span className="text-gray-600">Moyenne:</span>
                    <div className="font-medium">
                      {capteur.immeubleCapteur.indexRecapHumidite.moy === "-1"
                        ? "N/A"
                        : `${capteur.immeubleCapteur.indexRecapHumidite.moy}%`}
                    </div>
                  </div>
                  <div>
                    <span className="text-gray-600">Max:</span>
                    <div className="font-medium">
                      {capteur.immeubleCapteur.indexRecapHumidite.max === "-1"
                        ? "N/A"
                        : `${capteur.immeubleCapteur.indexRecapHumidite.max}%`}
                    </div>
                  </div>
                  <div>
                    <span className="text-gray-600">Min:</span>
                    <div className="font-medium">
                      {capteur.immeubleCapteur.indexRecapHumidite.min === "-1"
                        ? "N/A"
                        : `${capteur.immeubleCapteur.indexRecapHumidite.min}%`}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        ) : (
          <div className="text-center py-4 text-gray-500">
            <i className="fas fa-thermometer-half text-2xl mb-2"></i>
            <p>Aucune donnée de capteur disponible</p>
          </div>
        )}
      </div>

      {/* Right Column - Repart */}
      <div className="bg-white rounded-lg shadow-md p-6">
        <h3 className="text-xl font-semibold text-gray-800 mb-4 flex items-center">
          <i className="fas fa-fire text-orange-600 mr-2"></i>
          Répartiteurs
        </h3>

        {repartLoading ? (
          renderSkeleton()
        ) : repartError ? (
          renderError(repartError)
        ) : repart?.immeubleRepart ? (
          <div className="space-y-4">
            {/* Meter Status */}
            <div>
              <h4 className="text-sm font-medium text-gray-700 mb-2">
                Compteurs
              </h4>
              <div className="bg-gray-50 rounded-lg p-3">
                <div className="grid grid-cols-2 gap-2 text-sm">
                  <div>
                    <span className="text-gray-600">À relever:</span>
                    <div className="font-medium">
                      {repart.immeubleRepart.nbCompteursARelever === -1
                        ? "N/A"
                        : repart.immeubleRepart.nbCompteursARelever}
                    </div>
                  </div>
                  <div>
                    <span className="text-gray-600">Relevés:</span>
                    <div className="font-medium">
                      {repart.immeubleRepart.nbCompteursReleves === -1
                        ? "N/A"
                        : repart.immeubleRepart.nbCompteursReleves}
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {/* Financial Data */}
            <div>
              <h4 className="text-sm font-medium text-gray-700 mb-2">
                Répartition
              </h4>
              <div className="bg-gray-50 rounded-lg p-3">
                <div className="space-y-2 text-sm">
                  <div className="flex justify-between">
                    <span className="text-gray-600">Total U. Répart:</span>
                    <span className="font-medium">
                      {repart.immeubleRepart.totURepart === "-1"
                        ? "N/A"
                        : repart.immeubleRepart.totURepart}
                    </span>
                  </div>
                  <div className="flex justify-between">
                    <span className="text-gray-600">Total Tant Chauff:</span>
                    <span className="font-medium">
                      {repart.immeubleRepart.totTantChauff === "-1"
                        ? "N/A"
                        : repart.immeubleRepart.totTantChauff}
                    </span>
                  </div>
                  <div className="flex justify-between">
                    <span className="text-gray-600">Prix U. Répart:</span>
                    <span className="font-medium">
                      {repart.immeubleRepart.prixURepart === "-1"
                        ? "N/A"
                        : repart.immeubleRepart.prixURepart}
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        ) : (
          <div className="text-center py-4 text-gray-500">
            <i className="fas fa-fire text-2xl mb-2"></i>
            <p>Aucune donnée de répartiteur disponible</p>
          </div>
        )}
      </div>
    </div>
  );
};

export default CapteurRepartPanel;
