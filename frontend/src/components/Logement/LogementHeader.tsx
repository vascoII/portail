import React from "react";
import Link from "next/link";
import { Logement, LogementIndicators } from "../../hooks/useLogement";

interface LogementHeaderProps {
  logement: Logement;
  logementLoading: boolean;
  logementError: string | null;
  indicators: LogementIndicators | null;
  indicatorsLoading: boolean;
  indicatorsError: string | null;
}

const LogementHeader: React.FC<LogementHeaderProps> = ({
  logement,
  logementLoading,
  logementError,
  indicators,
  indicatorsLoading,
  indicatorsError,
}) => {
  return (
    <div className="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Logement Info Card */}
        <div className="space-y-4">
          <div className="flex items-center space-x-3">
            <div className="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
              <i className="fas fa-home text-green-600 text-xl"></i>
            </div>
            <div>
              <h1 className="text-2xl font-bold text-gray-800">
                Logement {logement.numOrdre}
              </h1>
              <p className="text-gray-600">
                {logement.type.trim() || "Type non spécifié"}
              </p>
            </div>
          </div>

          <div className="grid grid-cols-2 gap-4 text-sm">
            <div>
              <span className="font-medium text-gray-600">Bâtiment :</span>
              <div className="font-semibold text-gray-800">
                {logement.numBatiment}
              </div>
            </div>
            <div>
              <span className="font-medium text-gray-600">Escalier :</span>
              <div className="font-semibold text-gray-800">
                {logement.numEscalier}
              </div>
            </div>
            <div>
              <span className="font-medium text-gray-600">Étage :</span>
              <div className="font-semibold text-gray-800">
                {logement.numEtage}
              </div>
            </div>
            <div>
              <span className="font-medium text-gray-600">Référence :</span>
              <div className="font-semibold text-gray-800">
                {logement.numOrdre}
              </div>
            </div>
          </div>

          <div className="text-sm text-gray-600">
            <div>{logement.adrBatiment}</div>
            <div>{logement.adrEscalier}</div>
          </div>
        </div>

        {/* Indicators Card */}
        <div className="space-y-4">
          <div className="flex items-center justify-between">
            <h3 className="text-lg font-semibold text-gray-800">Indicateurs</h3>
            {indicatorsLoading && (
              <div className="flex items-center text-blue-600">
                <i className="fas fa-spinner fa-spin mr-2"></i>
                <span className="text-sm">Chargement...</span>
              </div>
            )}
            {indicatorsError && (
              <div className="flex items-center text-red-600">
                <i className="fas fa-exclamation-triangle mr-2"></i>
                <span className="text-sm">Erreur</span>
              </div>
            )}
          </div>

          {indicatorsLoading ? (
            <div className="grid grid-cols-2 gap-4">
              {[...Array(4)].map((_, i) => (
                <div key={i} className="animate-pulse">
                  <div className="h-16 bg-gray-200 rounded-lg"></div>
                </div>
              ))}
            </div>
          ) : indicatorsError ? (
            <div className="bg-red-50 border border-red-200 rounded-lg p-4">
              <div className="flex items-center">
                <i className="fas fa-exclamation-triangle text-red-500 mr-2"></i>
                <span className="text-red-700 text-sm">
                  Erreur de chargement des indicateurs
                </span>
              </div>
            </div>
          ) : indicators ? (
            <div className="grid grid-cols-2 gap-4">
              {/* Appareils */}
              <div className="text-center p-3 bg-blue-50 rounded-lg">
                <div className="text-2xl font-bold text-blue-600">
                  {indicators.NbAppareils}
                </div>
                <div className="text-sm text-blue-800">Appareils</div>
              </div>

              {/* Compteurs EC */}
              <div className="text-center p-3 bg-green-50 rounded-lg">
                <div className="text-2xl font-bold text-green-600">
                  {indicators.NbCompteursEC}
                </div>
                <div className="text-sm text-green-800">Compteurs EC</div>
              </div>

              {/* Compteurs EF */}
              <div className="text-center p-3 bg-orange-50 rounded-lg">
                <div className="text-2xl font-bold text-orange-600">
                  {indicators.NbCompteursEF}
                </div>
                <div className="text-sm text-orange-800">Compteurs EF</div>
              </div>

              {/* Compteurs CET */}
              <div className="text-center p-3 bg-purple-50 rounded-lg">
                <div className="text-2xl font-bold text-purple-600">
                  {indicators.NbCompteursCET}
                </div>
                <div className="text-sm text-purple-800">Compteurs CET</div>
              </div>

              {/* Compteurs Répartition */}
              <div className="text-center p-3 bg-indigo-50 rounded-lg">
                <div className="text-2xl font-bold text-indigo-600">
                  {indicators.NbCompteursRepart}
                </div>
                <div className="text-sm text-indigo-800">Compteurs Répart</div>
              </div>

              {/* Compteurs Capteur */}
              <div className="text-center p-3 bg-cyan-50 rounded-lg">
                <div className="text-2xl font-bold text-cyan-600">
                  {indicators.NbCompteursCapteur}
                </div>
                <div className="text-sm text-cyan-800">Compteurs Capteur</div>
              </div>

              {/* Dépannages */}
              <div className="text-center p-3 bg-yellow-50 rounded-lg">
                <div className="text-2xl font-bold text-yellow-600">
                  {indicators.NbDepannages}
                </div>
                <div className="text-sm text-yellow-800">Dépannages</div>
              </div>

              {/* Tickets Inter */}
              <div className="text-center p-3 bg-pink-50 rounded-lg">
                <div className="text-2xl font-bold text-pink-600">
                  {indicators.NbTicketsInter}
                </div>
                <div className="text-sm text-pink-800">Tickets Inter</div>
              </div>
            </div>
          ) : (
            <div className="text-center text-gray-500 py-8">
              <i className="fas fa-chart-bar text-3xl mb-2"></i>
              <p>Aucun indicateur disponible</p>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default LogementHeader;
