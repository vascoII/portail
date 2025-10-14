import React from "react";
import {
  LogementCapteurData,
  LogementCapteur,
  IndexRecap,
  SerieConsos,
  LogementRepartData,
  LogementRepart,
} from "../../hooks/useLogement";

interface LogementCapteurRepartPanelProps {
  capteur: LogementCapteurData | null;
  capteurLoading: boolean;
  capteurError: string | null;
  repart: LogementRepartData | null;
  repartLoading: boolean;
  repartError: string | null;
  refetchAsyncData: (dataType: string) => void;
}

const LogementCapteurRepartPanel: React.FC<LogementCapteurRepartPanelProps> = ({
  capteur,
  capteurLoading,
  capteurError,
  repart,
  repartLoading,
  repartError,
  refetchAsyncData,
}) => {
  return (
    <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
      {/* Capteur Panel */}
      <div className="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div className="flex items-center justify-between mb-4">
          <h3 className="text-lg font-semibold text-gray-800">
            <i className="fas fa-thermometer-half text-blue-600 mr-2"></i>
            Capteur
          </h3>
          {capteurLoading && (
            <div className="flex items-center text-blue-600">
              <i className="fas fa-spinner fa-spin mr-2"></i>
              <span className="text-sm">Chargement...</span>
            </div>
          )}
          {capteurError && (
            <button
              onClick={() => refetchAsyncData("capteur")}
              className="text-red-600 hover:text-red-800 transition-colors duration-200"
              title="Réessayer"
            >
              <i className="fas fa-redo mr-1"></i>
              Réessayer
            </button>
          )}
        </div>

        {capteurLoading ? (
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
        ) : capteurError ? (
          <div className="bg-red-50 border border-red-200 rounded-lg p-4">
            <div className="flex items-center">
              <i className="fas fa-exclamation-triangle text-red-500 mr-2"></i>
              <span className="text-red-700 text-sm">
                Erreur de chargement des données capteur
              </span>
            </div>
          </div>
        ) : capteur ? (
          <div className="space-y-6">
            {/* Temperature Recap */}
            <div className="bg-blue-50 rounded-lg p-4">
              <h4 className="text-lg font-semibold text-blue-800 mb-3 flex items-center">
                <i className="fas fa-thermometer-half mr-2"></i>
                Température
              </h4>
              <div className="grid grid-cols-3 gap-4 text-sm">
                <div className="text-center">
                  <div className="text-2xl font-bold text-blue-600">
                    {capteur.logementCapteur.IndexRecapTemperature.moy !== "-1"
                      ? `${capteur.logementCapteur.IndexRecapTemperature.moy}°C`
                      : "N/A"}
                  </div>
                  <div className="text-blue-800">Moyenne</div>
                </div>
                <div className="text-center">
                  <div className="text-2xl font-bold text-blue-600">
                    {capteur.logementCapteur.IndexRecapTemperature.max !== "-1"
                      ? `${capteur.logementCapteur.IndexRecapTemperature.max}°C`
                      : "N/A"}
                  </div>
                  <div className="text-blue-800">Maximum</div>
                </div>
                <div className="text-center">
                  <div className="text-2xl font-bold text-blue-600">
                    {capteur.logementCapteur.IndexRecapTemperature.min !== "-1"
                      ? `${capteur.logementCapteur.IndexRecapTemperature.min}°C`
                      : "N/A"}
                  </div>
                  <div className="text-blue-800">Minimum</div>
                </div>
              </div>
            </div>

            {/* Humidity Recap */}
            <div className="bg-green-50 rounded-lg p-4">
              <h4 className="text-lg font-semibold text-green-800 mb-3 flex items-center">
                <i className="fas fa-tint mr-2"></i>
                Humidité
              </h4>
              <div className="grid grid-cols-3 gap-4 text-sm">
                <div className="text-center">
                  <div className="text-2xl font-bold text-green-600">
                    {capteur.logementCapteur.IndexRecapHumidite.moy !== "-1"
                      ? `${capteur.logementCapteur.IndexRecapHumidite.moy}%`
                      : "N/A"}
                  </div>
                  <div className="text-green-800">Moyenne</div>
                </div>
                <div className="text-center">
                  <div className="text-2xl font-bold text-green-600">
                    {capteur.logementCapteur.IndexRecapHumidite.max !== "-1"
                      ? `${capteur.logementCapteur.IndexRecapHumidite.max}%`
                      : "N/A"}
                  </div>
                  <div className="text-green-800">Maximum</div>
                </div>
                <div className="text-center">
                  <div className="text-2xl font-bold text-green-600">
                    {capteur.logementCapteur.IndexRecapHumidite.min !== "-1"
                      ? `${capteur.logementCapteur.IndexRecapHumidite.min}%`
                      : "N/A"}
                  </div>
                  <div className="text-green-800">Minimum</div>
                </div>
              </div>
            </div>

            {/* Series Data */}
            <div className="space-y-4">
              <div className="bg-gray-50 rounded-lg p-4">
                <h5 className="font-semibold text-gray-800 mb-2">
                  Séries de Consommation
                </h5>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                  <div>
                    <div className="font-medium text-gray-600 mb-1">
                      Température
                    </div>
                    <div className="text-gray-800">
                      Intervalle:{" "}
                      {
                        capteur.logementCapteur.SerieConsosTemperature
                          .defaultIntervalle
                      }{" "}
                      jours
                    </div>
                    <div className="text-gray-800">
                      Année:{" "}
                      {capteur.logementCapteur.SerieConsosTemperature.annee ||
                        "N/A"}
                    </div>
                  </div>
                  <div>
                    <div className="font-medium text-gray-600 mb-1">
                      Humidité
                    </div>
                    <div className="text-gray-800">
                      Intervalle:{" "}
                      {
                        capteur.logementCapteur.SerieConsosHumidite
                          .defaultIntervalle
                      }{" "}
                      jours
                    </div>
                    <div className="text-gray-800">
                      Année:{" "}
                      {capteur.logementCapteur.SerieConsosHumidite.annee ||
                        "N/A"}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        ) : (
          <div className="text-center text-gray-500 py-8">
            <i className="fas fa-thermometer-half text-3xl mb-2"></i>
            <p>Aucune donnée capteur disponible</p>
          </div>
        )}
      </div>

      {/* Repart Panel */}
      <div className="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
        <div className="flex items-center justify-between mb-4">
          <h3 className="text-lg font-semibold text-gray-800">
            <i className="fas fa-chart-pie text-green-600 mr-2"></i>
            Répartition
          </h3>
          {repartLoading && (
            <div className="flex items-center text-green-600">
              <i className="fas fa-spinner fa-spin mr-2"></i>
              <span className="text-sm">Chargement...</span>
            </div>
          )}
          {repartError && (
            <button
              onClick={() => refetchAsyncData("repart")}
              className="text-red-600 hover:text-red-800 transition-colors duration-200"
              title="Réessayer"
            >
              <i className="fas fa-redo mr-1"></i>
              Réessayer
            </button>
          )}
        </div>

        {repartLoading ? (
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
        ) : repartError ? (
          <div className="bg-red-50 border border-red-200 rounded-lg p-4">
            <div className="flex items-center">
              <i className="fas fa-exclamation-triangle text-red-500 mr-2"></i>
              <span className="text-red-700 text-sm">
                Erreur de chargement des données de répartition
              </span>
            </div>
          </div>
        ) : repart ? (
          <div className="space-y-6">
            {/* Financial Summary */}
            <div className="bg-green-50 rounded-lg p-4">
              <h4 className="text-lg font-semibold text-green-800 mb-3 flex items-center">
                <i className="fas fa-euro-sign mr-2"></i>
                Résumé Financier
              </h4>
              <div className="grid grid-cols-2 gap-4 text-sm">
                <div className="text-center">
                  <div className="text-xl font-bold text-green-600">
                    {repart.logementRepart.Tot_URepart !== "-1"
                      ? `${repart.logementRepart.Tot_URepart}€`
                      : "N/A"}
                  </div>
                  <div className="text-green-800">Total U. Répart</div>
                </div>
                <div className="text-center">
                  <div className="text-xl font-bold text-green-600">
                    {repart.logementRepart.Tot_TantChauff !== "-1"
                      ? `${repart.logementRepart.Tot_TantChauff}€`
                      : "N/A"}
                  </div>
                  <div className="text-green-800">Total Tant Chauff</div>
                </div>
                <div className="text-center">
                  <div className="text-xl font-bold text-green-600">
                    {repart.logementRepart.Prix_URepart !== "-1"
                      ? `${repart.logementRepart.Prix_URepart}€`
                      : "N/A"}
                  </div>
                  <div className="text-green-800">Prix U. Répart</div>
                </div>
                <div className="text-center">
                  <div className="text-xl font-bold text-green-600">
                    {repart.logementRepart.Prix_Abonn !== "-1"
                      ? `${repart.logementRepart.Prix_Abonn}€`
                      : "N/A"}
                  </div>
                  <div className="text-green-800">Prix Abonnement</div>
                </div>
              </div>
            </div>

            {/* Heating Details */}
            <div className="bg-orange-50 rounded-lg p-4">
              <h4 className="text-lg font-semibold text-orange-800 mb-3 flex items-center">
                <i className="fas fa-thermometer-half mr-2"></i>
                Détails Chauffage
              </h4>
              <div className="grid grid-cols-2 gap-4 text-sm">
                <div className="text-center">
                  <div className="text-xl font-bold text-orange-600">
                    {repart.logementRepart.PU_Tant !== "-1"
                      ? `${repart.logementRepart.PU_Tant}€`
                      : "N/A"}
                  </div>
                  <div className="text-orange-800">Prix Unitaire Tant</div>
                </div>
                <div className="text-center">
                  <div className="text-xl font-bold text-orange-600">
                    {repart.logementRepart.Mont_ARepartTant !== "-1"
                      ? `${repart.logementRepart.Mont_ARepartTant}€`
                      : "N/A"}
                  </div>
                  <div className="text-orange-800">Montant A. Répart Tant</div>
                </div>
                <div className="text-center">
                  <div className="text-xl font-bold text-orange-600">
                    {repart.logementRepart.Part_RepartConsos !== "-1"
                      ? `${repart.logementRepart.Part_RepartConsos}%`
                      : "N/A"}
                  </div>
                  <div className="text-orange-800">Part Répart Consos</div>
                </div>
                <div className="text-center">
                  <div className="text-xl font-bold text-orange-600">
                    {repart.logementRepart.CT_Combust !== "-1"
                      ? `${repart.logementRepart.CT_Combust}€`
                      : "N/A"}
                  </div>
                  <div className="text-orange-800">CT Combustible</div>
                </div>
              </div>
            </div>

            {/* Logement Specific */}
            <div className="bg-blue-50 rounded-lg p-4">
              <h4 className="text-lg font-semibold text-blue-800 mb-3 flex items-center">
                <i className="fas fa-home mr-2"></i>
                Logement Spécifique
              </h4>
              <div className="grid grid-cols-2 gap-4 text-sm">
                <div className="text-center">
                  <div className="text-xl font-bold text-blue-600">
                    {repart.logementRepart.URepartLog !== "-1"
                      ? `${repart.logementRepart.URepartLog}€`
                      : "N/A"}
                  </div>
                  <div className="text-blue-800">U. Répart Logement</div>
                </div>
                <div className="text-center">
                  <div className="text-xl font-bold text-blue-600">
                    {repart.logementRepart.TantLog !== "-1"
                      ? `${repart.logementRepart.TantLog}€`
                      : "N/A"}
                  </div>
                  <div className="text-blue-800">Tant Logement</div>
                </div>
                <div className="text-center">
                  <div className="text-xl font-bold text-blue-600">
                    {repart.logementRepart.Prix_ChauffTantLog !== "-1"
                      ? `${repart.logementRepart.Prix_ChauffTantLog}€`
                      : "N/A"}
                  </div>
                  <div className="text-blue-800">Prix Chauff Tant Log</div>
                </div>
                <div className="text-center">
                  <div className="text-xl font-bold text-blue-600">
                    {repart.logementRepart.CT_ChauffLog !== "-1"
                      ? `${repart.logementRepart.CT_ChauffLog}€`
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
                  {repart.logementRepart.SerieConsosDJU.defaultIntervalle} jours
                </div>
                <div className="mb-2">
                  <span className="font-medium">Année:</span>{" "}
                  {repart.logementRepart.SerieConsosDJU.annee || "N/A"}
                </div>
                {repart.logementRepart.SerieConsosDJU.info && (
                  <div className="text-blue-600">
                    <span className="font-medium">Info:</span>{" "}
                    {repart.logementRepart.SerieConsosDJU.info}
                  </div>
                )}
                {repart.logementRepart.SerieConsosDJU.erreur && (
                  <div className="text-red-600">
                    <span className="font-medium">Erreur:</span>{" "}
                    {repart.logementRepart.SerieConsosDJU.erreur}
                  </div>
                )}
              </div>
            </div>

            {/* Appareils and Pieces Info */}
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
              <div className="bg-purple-50 rounded-lg p-4">
                <h5 className="font-semibold text-purple-800 mb-2">
                  Appareils ({repart.logementRepart.ListeInfosAppareils.length})
                </h5>
                {repart.logementRepart.ListeInfosAppareils.length > 0 ? (
                  <div className="text-purple-700">
                    {repart.logementRepart.ListeInfosAppareils.length}{" "}
                    appareil(s) configuré(s)
                  </div>
                ) : (
                  <div className="text-gray-500">Aucun appareil configuré</div>
                )}
              </div>

              <div className="bg-indigo-50 rounded-lg p-4">
                <h5 className="font-semibold text-indigo-800 mb-2">
                  Consos Pièces ({repart.logementRepart.ConsosPieces.length})
                </h5>
                {repart.logementRepart.ConsosPieces.length > 0 ? (
                  <div className="text-indigo-700">
                    {repart.logementRepart.ConsosPieces.length} pièce(s) avec
                    consommation
                  </div>
                ) : (
                  <div className="text-gray-500">Aucune donnée de pièce</div>
                )}
              </div>
            </div>
          </div>
        ) : (
          <div className="text-center text-gray-500 py-8">
            <i className="fas fa-chart-pie text-3xl mb-2"></i>
            <p>Aucune donnée de répartition disponible</p>
          </div>
        )}
      </div>
    </div>
  );
};

export default LogementCapteurRepartPanel;
