import React, { useState } from "react";
import {
  LogementCETData,
  LogementECData,
  LogementEFData,
  LogementEF,
  LogementEC,
  LogementCET,
  ConsoPeriode,
  InfosAppareilEAU,
  Appareil,
  Releve,
} from "@/hooks/useLogement";

// Helper function to format date
const formatDate = (dateString: string): string => {
  if (dateString === "0001-01-01T00:00:00") return "N/A";
  try {
    return new Date(dateString).toLocaleDateString("fr-FR");
  } catch {
    return "N/A";
  }
};

// Helper function to format consumption value
const formatConsumption = (value: string): string => {
  if (value === "0" || value === "-1") return "N/A";
  return `${value} m³`;
};

// Helper function to render device readings
const renderDeviceReadings = (readings: {
  R1: Releve;
  R2: Releve;
  R3: Releve;
  R4: Releve;
  R5: Releve;
  R6?: Releve;
}) => {
  const readingKeys = Object.keys(readings).sort().reverse(); // R6, R5, R4, R3, R2, R1
  return (
    <div className="grid grid-cols-2 md:grid-cols-3 gap-2 text-xs">
      {readingKeys.map((key) => {
        const reading = readings[key as keyof typeof readings];
        return (
          <div key={key} className="bg-gray-50 rounded p-2">
            <div className="font-medium text-gray-600">{key}</div>
            <div className="text-gray-800">
              {formatDate(reading.DateReleve)}
            </div>
            <div className="text-gray-800">Index: {reading.Index}</div>
            <div className="text-gray-800">
              Conso: {formatConsumption(reading.Conso)}
            </div>
          </div>
        );
      })}
    </div>
  );
};

// Render EF content
const renderEFContent = (efData: LogementEF) => {
  return (
    <div className="space-y-6">
      {/* Issues Summary */}
      <div className="grid grid-cols-2 gap-4">
        <div className="bg-red-50 rounded-lg p-4 text-center">
          <div className="text-2xl font-bold text-red-600">
            {efData.NbFuites}
          </div>
          <div className="text-red-800">Fuites</div>
        </div>
        <div className="bg-orange-50 rounded-lg p-4 text-center">
          <div className="text-2xl font-bold text-orange-600">
            {efData.NbAnomalies}
          </div>
          <div className="text-orange-800">Anomalies</div>
        </div>
      </div>

      {/* Consumption Period */}
      <div className="bg-blue-50 rounded-lg p-4">
        <h4 className="text-lg font-semibold text-blue-800 mb-3">
          Période de Consommation
        </h4>
        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
          <div>
            <div className="font-medium text-gray-600">Consommation</div>
            <div className="text-gray-800">
              {formatConsumption(efData.ConsoPeriode.Conso)}
            </div>
          </div>
          <div>
            <div className="font-medium text-gray-600">Date Début</div>
            <div className="text-gray-800">
              {formatDate(efData.ConsoPeriode.DateDeb)}
            </div>
          </div>
          <div>
            <div className="font-medium text-gray-600">Date Fin</div>
            <div className="text-gray-800">
              {formatDate(efData.ConsoPeriode.DateFin)}
            </div>
          </div>
          <div>
            <div className="font-medium text-gray-600">Conso Même Type</div>
            <div className="text-gray-800">
              {efData.ConsoMemeTypeLogement !== "-1"
                ? `${efData.ConsoMemeTypeLogement} m³`
                : "N/A"}
            </div>
          </div>
        </div>
      </div>

      {/* Devices */}
      <div className="space-y-4">
        <h4 className="text-lg font-semibold text-gray-800">
          Appareils Eau Froide (
          {efData.ListeInfosAppareils.infosAppareilEAU.length})
        </h4>
        {efData.ListeInfosAppareils.infosAppareilEAU.map((device, index) => (
          <div
            key={device.Appareil.PkAppareil}
            className="bg-white border border-gray-200 rounded-lg p-4"
          >
            <div className="flex items-center justify-between mb-3">
              <div>
                <h5 className="font-semibold text-gray-800">
                  Appareil {device.Appareil.Numero}
                </h5>
                <div className="text-sm text-gray-600">
                  {device.Appareil.Emplacement} • {device.Appareil.TypeAppareil}
                </div>
              </div>
              <div className="text-right text-sm text-gray-600">
                <div>PK: {device.Appareil.PkAppareil}</div>
                <div>Unité: {device.Appareil.Unite}</div>
              </div>
            </div>

            {/* Device Issues */}
            <div className="grid grid-cols-4 gap-2 mb-3 text-sm">
              <div className="text-center">
                <div className="font-medium text-red-600">
                  {device.NbFuites}
                </div>
                <div className="text-red-800">Fuites</div>
              </div>
              <div className="text-center">
                <div className="font-medium text-orange-600">
                  {device.NbAnomalies}
                </div>
                <div className="text-orange-800">Anomalies</div>
              </div>
              <div className="text-center">
                <div className="font-medium text-blue-600">
                  {device.NbDepannages}
                </div>
                <div className="text-blue-800">Dépannages</div>
              </div>
              <div className="text-center">
                <div className="font-medium text-purple-600">
                  {device.NbDysfonctionnements !== -1
                    ? device.NbDysfonctionnements
                    : "N/A"}
                </div>
                <div className="text-purple-800">Dysfonctionnements</div>
              </div>
            </div>

            {/* Device Readings */}
            <div>
              <h6 className="font-medium text-gray-700 mb-2">Relevés</h6>
              {renderDeviceReadings(device)}
            </div>

            {/* Series Info */}
            <div className="mt-3 pt-3 border-t border-gray-200">
              <div className="text-sm text-gray-600">
                <span className="font-medium">Série:</span>{" "}
                {device.SerieConsos.Annee || "N/A"}•{" "}
                <span className="font-medium">Intervalle:</span>{" "}
                {device.SerieConsos.DefaultIntervalle} jours
              </div>
              {device.SerieConsos.Info && (
                <div className="text-sm text-blue-600 mt-1">
                  <span className="font-medium">Info:</span>{" "}
                  {device.SerieConsos.Info}
                </div>
              )}
              {device.SerieConsos.Erreur && (
                <div className="text-sm text-red-600 mt-1">
                  <span className="font-medium">Erreur:</span>{" "}
                  {device.SerieConsos.Erreur}
                </div>
              )}
            </div>
          </div>
        ))}
      </div>

      {/* Global Series */}
      <div className="bg-gray-50 rounded-lg p-4">
        <h5 className="font-semibold text-gray-800 mb-2">
          Séries de Consommation Globales
        </h5>
        <div className="text-sm text-gray-800">
          <div className="mb-2">
            <span className="font-medium">Année:</span>{" "}
            {efData.SerieConsos.annee || "N/A"}
          </div>
          <div className="mb-2">
            <span className="font-medium">Intervalle:</span>{" "}
            {efData.SerieConsos.defaultIntervalle} jours
          </div>
          {efData.SerieConsos.info && (
            <div className="text-blue-600">
              <span className="font-medium">Info:</span>{" "}
              {efData.SerieConsos.info}
            </div>
          )}
          {efData.SerieConsos.erreur && (
            <div className="text-red-600">
              <span className="font-medium">Erreur:</span>{" "}
              {efData.SerieConsos.erreur}
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

// Render EC content (same structure as EF but for hot water)
const renderECContent = (ecData: LogementEC) => {
  return (
    <div className="space-y-6">
      {/* Issues Summary */}
      <div className="grid grid-cols-2 gap-4">
        <div className="bg-red-50 rounded-lg p-4 text-center">
          <div className="text-2xl font-bold text-red-600">
            {ecData.NbFuites}
          </div>
          <div className="text-red-800">Fuites</div>
        </div>
        <div className="bg-orange-50 rounded-lg p-4 text-center">
          <div className="text-2xl font-bold text-orange-600">
            {ecData.NbAnomalies}
          </div>
          <div className="text-orange-800">Anomalies</div>
        </div>
      </div>

      {/* Consumption Period */}
      <div className="bg-red-50 rounded-lg p-4">
        <h4 className="text-lg font-semibold text-red-800 mb-3">
          Période de Consommation
        </h4>
        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
          <div>
            <div className="font-medium text-gray-600">Consommation</div>
            <div className="text-gray-800">
              {formatConsumption(ecData.ConsoPeriode.Conso)}
            </div>
          </div>
          <div>
            <div className="font-medium text-gray-600">Date Début</div>
            <div className="text-gray-800">
              {formatDate(ecData.ConsoPeriode.DateDeb)}
            </div>
          </div>
          <div>
            <div className="font-medium text-gray-600">Date Fin</div>
            <div className="text-gray-800">
              {formatDate(ecData.ConsoPeriode.DateFin)}
            </div>
          </div>
          <div>
            <div className="font-medium text-gray-600">Conso Même Type</div>
            <div className="text-gray-800">
              {ecData.ConsoMemeTypeLogement !== "-1"
                ? `${ecData.ConsoMemeTypeLogement} m³`
                : "N/A"}
            </div>
          </div>
        </div>
      </div>

      {/* Devices */}
      <div className="space-y-4">
        <h4 className="text-lg font-semibold text-gray-800">
          Appareils Eau Chaude (
          {ecData.ListeInfosAppareils.infosAppareilEAU.length})
        </h4>
        {ecData.ListeInfosAppareils.infosAppareilEAU.map((device, index) => (
          <div
            key={device.Appareil.PkAppareil}
            className="bg-white border border-gray-200 rounded-lg p-4"
          >
            <div className="flex items-center justify-between mb-3">
              <div>
                <h5 className="font-semibold text-gray-800">
                  Appareil {device.Appareil.Numero}
                </h5>
                <div className="text-sm text-gray-600">
                  {device.Appareil.Emplacement} • {device.Appareil.TypeAppareil}
                </div>
              </div>
              <div className="text-right text-sm text-gray-600">
                <div>PK: {device.Appareil.PkAppareil}</div>
                <div>Unité: {device.Appareil.Unite}</div>
              </div>
            </div>

            {/* Device Issues */}
            <div className="grid grid-cols-4 gap-2 mb-3 text-sm">
              <div className="text-center">
                <div className="font-medium text-red-600">
                  {device.NbFuites}
                </div>
                <div className="text-red-800">Fuites</div>
              </div>
              <div className="text-center">
                <div className="font-medium text-orange-600">
                  {device.NbAnomalies}
                </div>
                <div className="text-orange-800">Anomalies</div>
              </div>
              <div className="text-center">
                <div className="font-medium text-blue-600">
                  {device.NbDepannages}
                </div>
                <div className="text-blue-800">Dépannages</div>
              </div>
              <div className="text-center">
                <div className="font-medium text-purple-600">
                  {device.NbDysfonctionnements !== -1
                    ? device.NbDysfonctionnements
                    : "N/A"}
                </div>
                <div className="text-purple-800">Dysfonctionnements</div>
              </div>
            </div>

            {/* Device Readings */}
            <div>
              <h6 className="font-medium text-gray-700 mb-2">Relevés</h6>
              {renderDeviceReadings(device)}
            </div>

            {/* Series Info */}
            <div className="mt-3 pt-3 border-t border-gray-200">
              <div className="text-sm text-gray-600">
                <span className="font-medium">Série:</span>{" "}
                {device.SerieConsos.Annee || "N/A"}•{" "}
                <span className="font-medium">Intervalle:</span>{" "}
                {device.SerieConsos.DefaultIntervalle} jours
              </div>
              {device.SerieConsos.Info && (
                <div className="text-sm text-blue-600 mt-1">
                  <span className="font-medium">Info:</span>{" "}
                  {device.SerieConsos.Info}
                </div>
              )}
              {device.SerieConsos.Erreur && (
                <div className="text-sm text-red-600 mt-1">
                  <span className="font-medium">Erreur:</span>{" "}
                  {device.SerieConsos.Erreur}
                </div>
              )}
            </div>
          </div>
        ))}
      </div>

      {/* Global Series */}
      <div className="bg-gray-50 rounded-lg p-4">
        <h5 className="font-semibold text-gray-800 mb-2">
          Séries de Consommation Globales
        </h5>
        <div className="text-sm text-gray-800">
          <div className="mb-2">
            <span className="font-medium">Année:</span>{" "}
            {ecData.SerieConsos.annee || "N/A"}
          </div>
          <div className="mb-2">
            <span className="font-medium">Intervalle:</span>{" "}
            {ecData.SerieConsos.defaultIntervalle} jours
          </div>
          {ecData.SerieConsos.info && (
            <div className="text-blue-600">
              <span className="font-medium">Info:</span>{" "}
              {ecData.SerieConsos.info}
            </div>
          )}
          {ecData.SerieConsos.erreur && (
            <div className="text-red-600">
              <span className="font-medium">Erreur:</span>{" "}
              {ecData.SerieConsos.erreur}
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

// Render CET content (heating data with financial information)
const renderCETContent = (cetData: LogementCET) => {
  return (
    <div className="space-y-6">
      {/* Financial Summary */}
      <div className="bg-orange-50 rounded-lg p-4">
        <h4 className="text-lg font-semibold text-orange-800 mb-3 flex items-center">
          <i className="fas fa-euro-sign mr-2"></i>
          Résumé Financier Chauffage
        </h4>
        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
          <div className="text-center">
            <div className="text-xl font-bold text-orange-600">
              {cetData.Tot_URepart !== "-1" ? `${cetData.Tot_URepart}€` : "N/A"}
            </div>
            <div className="text-orange-800">Total U. Répart</div>
          </div>
          <div className="text-center">
            <div className="text-xl font-bold text-orange-600">
              {cetData.Tot_TantChauff !== "-1"
                ? `${cetData.Tot_TantChauff}€`
                : "N/A"}
            </div>
            <div className="text-orange-800">Total Tant Chauff</div>
          </div>
          <div className="text-center">
            <div className="text-xl font-bold text-orange-600">
              {cetData.Prix_URepart !== "-1"
                ? `${cetData.Prix_URepart}€`
                : "N/A"}
            </div>
            <div className="text-orange-800">Prix U. Répart</div>
          </div>
          <div className="text-center">
            <div className="text-xl font-bold text-orange-600">
              {cetData.Prix_Abonn !== "-1" ? `${cetData.Prix_Abonn}€` : "N/A"}
            </div>
            <div className="text-orange-800">Prix Abonnement</div>
          </div>
        </div>
      </div>

      {/* Heating Details */}
      <div className="bg-red-50 rounded-lg p-4">
        <h4 className="text-lg font-semibold text-red-800 mb-3 flex items-center">
          <i className="fas fa-thermometer-half mr-2"></i>
          Détails Chauffage
        </h4>
        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
          <div className="text-center">
            <div className="text-xl font-bold text-red-600">
              {cetData.PU_Tant !== "-1" ? `${cetData.PU_Tant}€` : "N/A"}
            </div>
            <div className="text-red-800">Prix Unitaire Tant</div>
          </div>
          <div className="text-center">
            <div className="text-xl font-bold text-red-600">
              {cetData.Mont_ARepartTant !== "-1"
                ? `${cetData.Mont_ARepartTant}€`
                : "N/A"}
            </div>
            <div className="text-red-800">Montant A. Répart Tant</div>
          </div>
          <div className="text-center">
            <div className="text-xl font-bold text-red-600">
              {cetData.Part_RepartConsos !== "-1"
                ? `${cetData.Part_RepartConsos}%`
                : "N/A"}
            </div>
            <div className="text-red-800">Part Répart Consos</div>
          </div>
          <div className="text-center">
            <div className="text-xl font-bold text-red-600">
              {cetData.CT_Combust !== "-1" ? `${cetData.CT_Combust}€` : "N/A"}
            </div>
            <div className="text-red-800">CT Combustible</div>
          </div>
        </div>
      </div>

      {/* Logement Specific */}
      <div className="bg-blue-50 rounded-lg p-4">
        <h4 className="text-lg font-semibold text-blue-800 mb-3 flex items-center">
          <i className="fas fa-home mr-2"></i>
          Logement Spécifique
        </h4>
        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
          <div className="text-center">
            <div className="text-xl font-bold text-blue-600">
              {cetData.URepartLog !== "-1" ? `${cetData.URepartLog}€` : "N/A"}
            </div>
            <div className="text-blue-800">U. Répart Logement</div>
          </div>
          <div className="text-center">
            <div className="text-xl font-bold text-blue-600">
              {cetData.TantLog !== "-1" ? `${cetData.TantLog}€` : "N/A"}
            </div>
            <div className="text-blue-800">Tant Logement</div>
          </div>
          <div className="text-center">
            <div className="text-xl font-bold text-blue-600">
              {cetData.Prix_ChauffTantLog !== "-1"
                ? `${cetData.Prix_ChauffTantLog}€`
                : "N/A"}
            </div>
            <div className="text-blue-800">Prix Chauff Tant Log</div>
          </div>
          <div className="text-center">
            <div className="text-xl font-bold text-blue-600">
              {cetData.CT_ChauffLog !== "-1"
                ? `${cetData.CT_ChauffLog}€`
                : "N/A"}
            </div>
            <div className="text-blue-800">CT Chauff Logement</div>
          </div>
        </div>
      </div>

      {/* Series Data */}
      <div className="bg-gray-50 rounded-lg p-4">
        <h5 className="font-semibold text-gray-800 mb-2">
          Séries de Consommation DJU
        </h5>
        <div className="text-sm text-gray-800">
          <div className="mb-2">
            <span className="font-medium">Intervalle:</span>{" "}
            {cetData.SerieConsosDJU.defaultIntervalle} jours
          </div>
          <div className="mb-2">
            <span className="font-medium">Année:</span>{" "}
            {cetData.SerieConsosDJU.annee || "N/A"}
          </div>
          {cetData.SerieConsosDJU.info && (
            <div className="text-blue-600">
              <span className="font-medium">Info:</span>{" "}
              {cetData.SerieConsosDJU.info}
            </div>
          )}
          {cetData.SerieConsosDJU.erreur && (
            <div className="text-red-600">
              <span className="font-medium">Erreur:</span>{" "}
              {cetData.SerieConsosDJU.erreur}
            </div>
          )}
        </div>
      </div>

      {/* Appareils Info */}
      <div className="bg-purple-50 rounded-lg p-4">
        <h5 className="font-semibold text-purple-800 mb-2">
          Appareils Chauffage ({cetData.ListeInfosAppareils.length})
        </h5>
        {cetData.ListeInfosAppareils.length > 0 ? (
          <div className="text-purple-700">
            {cetData.ListeInfosAppareils.length} appareil(s) de chauffage
            configuré(s)
          </div>
        ) : (
          <div className="text-gray-500">
            Aucun appareil de chauffage configuré
          </div>
        )}
      </div>
    </div>
  );
};

interface LogementWaterEnergyTabsProps {
  cet: LogementCETData | null;
  cetLoading: boolean;
  cetError: string | null;
  ec: LogementECData | null;
  ecLoading: boolean;
  ecError: string | null;
  ef: LogementEFData | null;
  efLoading: boolean;
  efError: string | null;
  refetchAsyncData: (dataType: string) => void;
}

const LogementWaterEnergyTabs: React.FC<LogementWaterEnergyTabsProps> = ({
  cet,
  cetLoading,
  cetError,
  ec,
  ecLoading,
  ecError,
  ef,
  efLoading,
  efError,
  refetchAsyncData,
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
      icon: "fas fa-fire",
      color: "red",
      data: ec,
      loading: ecLoading,
      error: ecError,
    },
    {
      id: "cet" as const,
      label: "Chauffage",
      icon: "fas fa-thermometer-half",
      color: "orange",
      data: cet,
      loading: cetLoading,
      error: cetError,
    },
  ];

  const getTabColorClasses = (tabId: string, color: string) => {
    const baseClasses =
      "px-4 py-2 rounded-lg font-medium transition-colors duration-200";
    const isActive = activeTab === tabId;

    switch (color) {
      case "blue":
        return `${baseClasses} ${
          isActive
            ? "bg-blue-100 text-blue-800 border border-blue-200"
            : "text-blue-600 hover:bg-blue-50"
        }`;
      case "red":
        return `${baseClasses} ${
          isActive
            ? "bg-red-100 text-red-800 border border-red-200"
            : "text-red-600 hover:bg-red-50"
        }`;
      case "orange":
        return `${baseClasses} ${
          isActive
            ? "bg-orange-100 text-orange-800 border border-orange-200"
            : "text-orange-600 hover:bg-orange-50"
        }`;
      default:
        return `${baseClasses} ${
          isActive
            ? "bg-gray-100 text-gray-800 border border-gray-200"
            : "text-gray-600 hover:bg-gray-50"
        }`;
    }
  };

  const renderTabContent = () => {
    const activeTabData = tabs.find((tab) => tab.id === activeTab);
    if (!activeTabData) return null;

    const { data, loading, error, label } = activeTabData;

    if (loading) {
      return (
        <div className="space-y-4">
          <div className="animate-pulse">
            <div className="h-4 bg-gray-200 rounded w-3/4 mb-2"></div>
            <div className="h-4 bg-gray-200 rounded w-1/2"></div>
          </div>
          <div className="animate-pulse">
            <div className="h-4 bg-gray-200 rounded w-3/4 mb-2"></div>
            <div className="h-4 bg-gray-200 rounded w-1/2"></div>
          </div>
        </div>
      );
    }

    if (error) {
      return (
        <div className="bg-red-50 border border-red-200 rounded-lg p-4">
          <div className="flex items-center justify-between">
            <div className="flex items-center">
              <i className="fas fa-exclamation-triangle text-red-500 mr-2"></i>
              <span className="text-red-700 text-sm">
                Erreur de chargement des données {label.toLowerCase()}
              </span>
            </div>
            <button
              onClick={() => refetchAsyncData(activeTab)}
              className="text-red-600 hover:text-red-800 transition-colors duration-200"
              title="Réessayer"
            >
              <i className="fas fa-redo mr-1"></i>
              Réessayer
            </button>
          </div>
        </div>
      );
    }

    if (data) {
      // Render specific content based on the active tab
      if (activeTab === "ef" && data.logementEF) {
        return renderEFContent(data.logementEF);
      } else if (activeTab === "ec" && data.logementEC) {
        return renderECContent(data.logementEC);
      } else if (activeTab === "cet" && data.logementCET) {
        return renderCETContent(data.logementCET);
      }

      // Fallback for other data types
      return (
        <div className="space-y-4">
          <div className="text-center text-gray-500 py-8">
            <i className={`${activeTabData.icon} text-3xl mb-2`}></i>
            <p>Données {label.toLowerCase()} disponibles</p>
            <p className="text-sm text-gray-400 mt-1">
              Structure à définir selon la réponse backend
            </p>
          </div>
        </div>
      );
    }

    return (
      <div className="text-center text-gray-500 py-8">
        <i className={`${activeTabData.icon} text-3xl mb-2`}></i>
        <p>Aucune donnée {label.toLowerCase()} disponible</p>
      </div>
    );
  };

  return (
    <div className="bg-white rounded-lg shadow-sm border border-gray-200">
      {/* Tab Headers */}
      <div className="border-b border-gray-200 p-6">
        <div className="flex space-x-1">
          {tabs.map((tab) => (
            <button
              key={tab.id}
              onClick={() => setActiveTab(tab.id)}
              className={getTabColorClasses(tab.id, tab.color)}
            >
              <i className={`${tab.icon} mr-2`}></i>
              {tab.label}
              {tab.loading && <i className="fas fa-spinner fa-spin ml-2"></i>}
              {tab.error && (
                <i className="fas fa-exclamation-triangle ml-2 text-red-500"></i>
              )}
            </button>
          ))}
        </div>
      </div>

      {/* Tab Content */}
      <div className="p-6">{renderTabContent()}</div>
    </div>
  );
};

export default LogementWaterEnergyTabs;
