"use client";

import React, { useState } from "react";
import {
  ImmeubleCETData,
  ImmeubleECData,
  ImmeubleEFData,
} from "@/src/shared/hooks/useImmeuble";

interface WaterEnergyTabsProps {
  cet: ImmeubleCETData | null;
  cetLoading: boolean;
  cetError: string | null;
  ec: ImmeubleECData | null;
  ecLoading: boolean;
  ecError: string | null;
  ef: ImmeubleEFData | null;
  efLoading: boolean;
  efError: string | null;
}

const WaterEnergyTabs: React.FC<WaterEnergyTabsProps> = ({
  cet,
  cetLoading,
  cetError,
  ec,
  ecLoading,
  ecError,
  ef,
  efLoading,
  efError,
}) => {
  const [activeTab, setActiveTab] = useState<"ef" | "ec" | "cet">("ef");

  const tabs = [
    {
      id: "ef" as const,
      label: "Eau Froide",
      icon: "fas fa-tint",
      color: "blue",
      data: ef,
      loading: efLoading,
      error: efError,
    },
    {
      id: "ec" as const,
      label: "Eau Chaude",
      icon: "fas fa-thermometer-three-quarters",
      color: "red",
      data: ec,
      loading: ecLoading,
      error: ecError,
    },
    {
      id: "cet" as const,
      label: "Chauffage",
      icon: "fas fa-fire",
      color: "orange",
      data: cet,
      loading: cetLoading,
      error: cetError,
    },
  ];

  const renderSkeleton = () => (
    <div className="animate-pulse space-y-4">
      <div className="h-6 bg-gray-200 rounded w-1/3"></div>
      <div className="space-y-3">
        <div className="h-4 bg-gray-200 rounded"></div>
        <div className="h-4 bg-gray-200 rounded w-2/3"></div>
        <div className="h-4 bg-gray-200 rounded w-1/2"></div>
      </div>
    </div>
  );

  const renderError = (error: string) => (
    <div className="text-center py-8">
      <i className="fas fa-exclamation-triangle text-red-500 text-2xl mb-2"></i>
      <p className="text-red-600 font-medium">Erreur lors du chargement</p>
      <p className="text-red-500 text-sm">{error}</p>
    </div>
  );

  const renderEFContent = () => {
    if (!ef?.immeubleEF) return null;

    const { immeubleEF } = ef;
    return (
      <div className="space-y-6">
        {/* Meter Status */}
        <div>
          <h4 className="text-lg font-semibold text-gray-800 mb-4">
            Compteurs
          </h4>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div className="bg-blue-50 rounded-lg p-4">
              <div className="text-2xl font-bold text-blue-600">
                {immeubleEF.nbCompteursARelever}
              </div>
              <div className="text-sm text-blue-800">À relever</div>
            </div>
            <div className="bg-green-50 rounded-lg p-4">
              <div className="text-2xl font-bold text-green-600">
                {immeubleEF.nbCompteursReleves}
              </div>
              <div className="text-sm text-green-800">Relevés</div>
            </div>
            <div className="bg-gray-50 rounded-lg p-4">
              <div className="text-2xl font-bold text-gray-600">
                {immeubleEF.nbCompteursARelever - immeubleEF.nbCompteursReleves}
              </div>
              <div className="text-sm text-gray-800">Restants</div>
            </div>
          </div>
        </div>

        {/* Issues */}
        <div>
          <h4 className="text-lg font-semibold text-gray-800 mb-4">
            Problèmes
          </h4>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div className="bg-red-50 rounded-lg p-4">
              <div className="flex items-center justify-between">
                <div>
                  <div className="text-2xl font-bold text-red-600">
                    {immeubleEF.nbFuites}
                  </div>
                  <div className="text-sm text-red-800">Fuites</div>
                </div>
                <i className="fas fa-tint text-red-500 text-2xl"></i>
              </div>
            </div>
            <div className="bg-orange-50 rounded-lg p-4">
              <div className="flex items-center justify-between">
                <div>
                  <div className="text-2xl font-bold text-orange-600">
                    {immeubleEF.nbAnomalies}
                  </div>
                  <div className="text-sm text-orange-800">Anomalies</div>
                </div>
                <i className="fas fa-exclamation-triangle text-orange-500 text-2xl"></i>
              </div>
            </div>
          </div>
        </div>

        {/* Top Consumptions */}
        {immeubleEF.topConsos.consosGrandes.length > 0 && (
          <div>
            <h4 className="text-lg font-semibold text-gray-800 mb-4">
              Plus grosses consommations
            </h4>
            <div className="bg-gray-50 rounded-lg p-4">
              <div className="space-y-2">
                {immeubleEF.topConsos.consosGrandes
                  .slice(0, 5)
                  .map((conso, index) => (
                    <div
                      key={conso.pkLogement}
                      className="flex justify-between items-center py-2 border-b border-gray-200 last:border-b-0"
                    >
                      <div>
                        <div className="font-medium text-gray-800">
                          {conso.nomOcc}
                        </div>
                        <div className="text-sm text-gray-600">
                          {conso.refOcc}
                        </div>
                      </div>
                      <div className="text-right">
                        <div className="font-bold text-blue-600">
                          {conso.conso} m³
                        </div>
                      </div>
                    </div>
                  ))}
              </div>
            </div>
          </div>
        )}
      </div>
    );
  };

  const renderECContent = () => {
    if (!ec?.immeubleEC) return null;

    const { immeubleEC } = ec;
    return (
      <div className="space-y-6">
        {/* Meter Status */}
        <div>
          <h4 className="text-lg font-semibold text-gray-800 mb-4">
            Compteurs
          </h4>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div className="bg-red-50 rounded-lg p-4">
              <div className="text-2xl font-bold text-red-600">
                {immeubleEC.nbCompteursARelever}
              </div>
              <div className="text-sm text-red-800">À relever</div>
            </div>
            <div className="bg-green-50 rounded-lg p-4">
              <div className="text-2xl font-bold text-green-600">
                {immeubleEC.nbCompteursReleves}
              </div>
              <div className="text-sm text-green-800">Relevés</div>
            </div>
            <div className="bg-gray-50 rounded-lg p-4">
              <div className="text-2xl font-bold text-gray-600">
                {immeubleEC.nbCompteursARelever - immeubleEC.nbCompteursReleves}
              </div>
              <div className="text-sm text-gray-800">Restants</div>
            </div>
          </div>
        </div>

        {/* Issues */}
        <div>
          <h4 className="text-lg font-semibold text-gray-800 mb-4">
            Problèmes
          </h4>
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div className="bg-red-50 rounded-lg p-4">
              <div className="flex items-center justify-between">
                <div>
                  <div className="text-2xl font-bold text-red-600">
                    {immeubleEC.nbFuites}
                  </div>
                  <div className="text-sm text-red-800">Fuites</div>
                </div>
                <i className="fas fa-tint text-red-500 text-2xl"></i>
              </div>
            </div>
            <div className="bg-orange-50 rounded-lg p-4">
              <div className="flex items-center justify-between">
                <div>
                  <div className="text-2xl font-bold text-orange-600">
                    {immeubleEC.nbAnomalies}
                  </div>
                  <div className="text-sm text-orange-800">Anomalies</div>
                </div>
                <i className="fas fa-exclamation-triangle text-orange-500 text-2xl"></i>
              </div>
            </div>
          </div>
        </div>

        {/* Top Consumptions */}
        {immeubleEC.topConsos.consosGrandes.length > 0 && (
          <div>
            <h4 className="text-lg font-semibold text-gray-800 mb-4">
              Plus grosses consommations
            </h4>
            <div className="bg-gray-50 rounded-lg p-4">
              <div className="space-y-2">
                {immeubleEC.topConsos.consosGrandes
                  .slice(0, 5)
                  .map((conso, index) => (
                    <div
                      key={conso.pkLogement}
                      className="flex justify-between items-center py-2 border-b border-gray-200 last:border-b-0"
                    >
                      <div>
                        <div className="font-medium text-gray-800">
                          {conso.nomOcc}
                        </div>
                        <div className="text-sm text-gray-600">
                          {conso.refOcc}
                        </div>
                      </div>
                      <div className="text-right">
                        <div className="font-bold text-red-600">
                          {conso.conso} m³
                        </div>
                      </div>
                    </div>
                  ))}
              </div>
            </div>
          </div>
        )}
      </div>
    );
  };

  const renderCETContent = () => {
    if (!cet?.immeubleCET) return null;

    const { immeubleCET } = cet;
    return (
      <div className="space-y-6">
        {/* Meter Status */}
        <div>
          <h4 className="text-lg font-semibold text-gray-800 mb-4">
            Compteurs
          </h4>
          <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div className="bg-orange-50 rounded-lg p-4">
              <div className="text-2xl font-bold text-orange-600">
                {immeubleCET.nbCompteursARelever === -1
                  ? "N/A"
                  : immeubleCET.nbCompteursARelever}
              </div>
              <div className="text-sm text-orange-800">À relever</div>
            </div>
            <div className="bg-green-50 rounded-lg p-4">
              <div className="text-2xl font-bold text-green-600">
                {immeubleCET.nbCompteursReleves === -1
                  ? "N/A"
                  : immeubleCET.nbCompteursReleves}
              </div>
              <div className="text-sm text-green-800">Relevés</div>
            </div>
            <div className="bg-gray-50 rounded-lg p-4">
              <div className="text-2xl font-bold text-gray-600">
                {immeubleCET.nbCompteursARelever === -1 ||
                immeubleCET.nbCompteursReleves === -1
                  ? "N/A"
                  : immeubleCET.nbCompteursARelever -
                    immeubleCET.nbCompteursReleves}
              </div>
              <div className="text-sm text-gray-800">Restants</div>
            </div>
          </div>
        </div>

        {/* Financial Data */}
        <div>
          <h4 className="text-lg font-semibold text-gray-800 mb-4">
            Données financières
          </h4>
          <div className="bg-gray-50 rounded-lg p-4">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div className="space-y-2">
                <div className="flex justify-between">
                  <span className="text-gray-600">Total U. Répart:</span>
                  <span className="font-medium">
                    {immeubleCET.totURepart === "-1"
                      ? "N/A"
                      : immeubleCET.totURepart}
                  </span>
                </div>
                <div className="flex justify-between">
                  <span className="text-gray-600">Total Tant Chauff:</span>
                  <span className="font-medium">
                    {immeubleCET.totTantChauff === "-1"
                      ? "N/A"
                      : immeubleCET.totTantChauff}
                  </span>
                </div>
                <div className="flex justify-between">
                  <span className="text-gray-600">Prix U. Répart:</span>
                  <span className="font-medium">
                    {immeubleCET.prixURepart === "-1"
                      ? "N/A"
                      : immeubleCET.prixURepart}
                  </span>
                </div>
              </div>
              <div className="space-y-2">
                <div className="flex justify-between">
                  <span className="text-gray-600">Prix Abonnement:</span>
                  <span className="font-medium">
                    {immeubleCET.prixAbonn === "-1"
                      ? "N/A"
                      : immeubleCET.prixAbonn}
                  </span>
                </div>
                <div className="flex justify-between">
                  <span className="text-gray-600">Montant A. Répart:</span>
                  <span className="font-medium">
                    {immeubleCET.montARepartTant === "-1"
                      ? "N/A"
                      : immeubleCET.montARepartTant}
                  </span>
                </div>
                <div className="flex justify-between">
                  <span className="text-gray-600">Coût Combustible:</span>
                  <span className="font-medium">
                    {immeubleCET.ctCombust === "-1"
                      ? "N/A"
                      : immeubleCET.ctCombust}
                  </span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    );
  };

  const renderTabContent = () => {
    const activeTabData = tabs.find((tab) => tab.id === activeTab);
    if (!activeTabData) return null;

    if (activeTabData.loading) {
      return renderSkeleton();
    }

    if (activeTabData.error) {
      return renderError(activeTabData.error);
    }

    if (!activeTabData.data) {
      return (
        <div className="text-center py-8 text-gray-500">
          <i className={`${activeTabData.icon} text-3xl mb-2`}></i>
          <p>Aucune donnée disponible</p>
        </div>
      );
    }

    switch (activeTab) {
      case "ef":
        return renderEFContent();
      case "ec":
        return renderECContent();
      case "cet":
        return renderCETContent();
      default:
        return null;
    }
  };

  return (
    <div className="bg-white rounded-lg shadow-md">
      {/* Tab Headers */}
      <div className="border-b border-gray-200">
        <nav className="flex space-x-8 px-6" aria-label="Tabs">
          {tabs.map((tab) => {
            const isActive = activeTab === tab.id;
            const colorClasses = {
              blue: isActive
                ? "text-blue-600 border-blue-600"
                : "text-gray-500 hover:text-gray-700",
              red: isActive
                ? "text-red-600 border-red-600"
                : "text-gray-500 hover:text-red-700",
              orange: isActive
                ? "text-orange-600 border-orange-600"
                : "text-gray-500 hover:text-orange-700",
            };

            return (
              <button
                key={tab.id}
                onClick={() => setActiveTab(tab.id)}
                className={`py-4 px-1 border-b-2 font-medium text-sm flex items-center ${
                  isActive
                    ? colorClasses[tab.color as keyof typeof colorClasses]
                    : "border-transparent"
                }`}
              >
                <i className={`${tab.icon} mr-2`}></i>
                {tab.label}
                {tab.loading && (
                  <i className="fas fa-spinner fa-spin ml-2 text-xs"></i>
                )}
                {tab.error && (
                  <i className="fas fa-exclamation-triangle ml-2 text-red-500 text-xs"></i>
                )}
              </button>
            );
          })}
        </nav>
      </div>

      {/* Tab Content */}
      <div className="p-6">{renderTabContent()}</div>
    </div>
  );
};

export default WaterEnergyTabs;
