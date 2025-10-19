"use client";

import React from "react";
import Link from "next/link";
import { useParams } from "next/navigation";
import BaseLayout from "../../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../../components/Layout/Breadcrumb";
import { LogementListSkeleton } from "../../../../components/Logement";
import { useLogements } from "../../../../hooks/useLogements";

const LogementsListPage: React.FC = () => {
  const params = useParams();
  const immeubleId = parseInt(params.id as string, 10);

  const {
    logements,
    logementsLoading,
    logementsError,
    indicators,
    indicatorsLoading,
    indicatorsError,
    getIndicatorsForLogement,
    refetch,
  } = useLogements(immeubleId);

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: "Liste des immeubles", href: "/immeubles" },
    { label: `Immeuble ${immeubleId}`, href: `/immeubles/${immeubleId}` },
    { label: "Logements", href: "#" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div className="mb-8">
          <h1 className="text-3xl font-bold text-gray-900 mb-2">
            Logements de l&apos;immeuble
          </h1>
          <p className="text-gray-600">
            Liste des logements et leurs indicateurs de performance
          </p>
        </div>

        {/* Loading State */}
        {logementsLoading && (
          <div className="space-y-6">
            <LogementListSkeleton count={5} />
          </div>
        )}

        {/* Error State */}
        {logementsError && (
          <div className="bg-red-50 border border-red-200 rounded-lg p-6">
            <div className="flex items-center justify-between">
              <div>
                <h3 className="text-lg font-medium text-red-800 mb-2">
                  Erreur lors du chargement des logements
                </h3>
                <p className="text-red-600 text-sm">{logementsError}</p>
              </div>
              <button
                onClick={refetch}
                className="px-4 py-2 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition-colors"
              >
                Réessayer
              </button>
            </div>
          </div>
        )}

        {/* Success State */}
        {!logementsLoading && !logementsError && logements && (
          <div className="space-y-6">
            {logements.length === 0 ? (
              <div className="text-center py-12">
                <i className="fas fa-home text-4xl text-gray-400 mb-4"></i>
                <p className="text-gray-500 text-lg">Aucun logement trouvé</p>
                <p className="text-gray-400 text-sm">
                  Aucun logement n&apos;est associé à cet immeuble
                </p>
              </div>
            ) : (
              logements.map((logement) => (
                <div
                  key={logement.pkLogement}
                  className="grid grid-cols-1 lg:grid-cols-2 gap-6"
                >
                  {/* Left Column - Logement Info */}
                  <div className="bg-white rounded-lg shadow-md p-6">
                    <div className="flex items-start justify-between mb-4">
                      <div className="flex items-start space-x-4 flex-1">
                        <div className="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                          <i className="fas fa-home text-green-600 text-xl"></i>
                        </div>

                        <div className="flex-1">
                          <Link
                            href={`/immeubles/${immeubleId}/logements/${logement.pkLogement}`}
                            className="text-xl font-semibold text-green-600 hover:text-green-800 hover:underline transition-colors duration-200"
                          >
                            Logement {logement.numOrdre}
                          </Link>
                          <div className="grid grid-cols-2 gap-2 text-sm">
                            <div>
                              <span className="font-medium text-gray-600">
                                Bâtiment :
                              </span>
                              <div className="font-semibold text-gray-800">
                                {logement.numBatiment}
                              </div>
                            </div>
                            <div>
                              <span className="font-medium text-gray-600">
                                Escalier :
                              </span>
                              <div className="font-semibold text-gray-800">
                                {logement.numEscalier}
                              </div>
                            </div>
                            <div>
                              <span className="font-medium text-gray-600">
                                Étage :
                              </span>
                              <div className="font-semibold text-gray-800">
                                {logement.numEtage}
                              </div>
                            </div>
                            <div>
                              <span className="font-medium text-gray-600">
                                Type :
                              </span>
                              <div className="font-semibold text-gray-800">
                                {logement.type.trim() || "N/A"}
                              </div>
                            </div>
                          </div>

                          <div className="mt-2 text-sm text-gray-600">
                            <div>{logement.adrBatiment}</div>
                            <div>{logement.adrEscalier}</div>
                          </div>
                        </div>
                      </div>
                    </div>

                    {/* Action Buttons */}
                    <div className="flex items-center justify-between">
                      <button className="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center">
                        <span className="font-semibold">Voir les détails</span>
                        <i className="fas fa-chevron-right ml-2"></i>
                      </button>
                    </div>
                  </div>

                  {/* Right Column - Indicators */}
                  <div className="bg-white rounded-lg shadow-md p-6">
                    <h3 className="text-xl font-semibold text-gray-800 mb-4">
                      Indicateurs
                    </h3>

                    {indicatorsLoading ? (
                      <div className="animate-pulse space-y-3">
                        <div className="h-4 bg-gray-200 rounded"></div>
                        <div className="h-4 bg-gray-200 rounded w-2/3"></div>
                        <div className="h-4 bg-gray-200 rounded w-1/2"></div>
                      </div>
                    ) : indicatorsError ? (
                      <div className="text-center py-4">
                        <i className="fas fa-exclamation-triangle text-red-500 text-xl mb-2"></i>
                        <p className="text-red-600 text-sm">
                          {indicatorsError}
                        </p>
                      </div>
                    ) : getIndicatorsForLogement(logement.pkLogement) ? (
                      <div className="space-y-4">
                        {/* Meter Counts */}
                        <div>
                          <h4 className="text-sm font-medium text-gray-700 mb-2">
                            Compteurs
                          </h4>
                          <div className="grid grid-cols-2 gap-2 text-sm">
                            <div className="flex justify-between">
                              <span className="text-gray-600">Eau Froide:</span>
                              <span className="font-medium">
                                {getIndicatorsForLogement(logement.pkLogement)
                                  ?.nbCompteursEF || 0}
                              </span>
                            </div>
                            <div className="flex justify-between">
                              <span className="text-gray-600">Eau Chaude:</span>
                              <span className="font-medium">
                                {getIndicatorsForLogement(logement.pkLogement)
                                  ?.nbCompteursEC || 0}
                              </span>
                            </div>
                            <div className="flex justify-between">
                              <span className="text-gray-600">
                                Répartiteurs:
                              </span>
                              <span className="font-medium">
                                {getIndicatorsForLogement(logement.pkLogement)
                                  ?.nbCompteursRepart || 0}
                              </span>
                            </div>
                            <div className="flex justify-between">
                              <span className="text-gray-600">CET:</span>
                              <span className="font-medium">
                                {getIndicatorsForLogement(logement.pkLogement)
                                  ?.nbCompteursCET || 0}
                              </span>
                            </div>
                            <div className="flex justify-between">
                              <span className="text-gray-600">Appareils:</span>
                              <span className="font-medium">
                                {getIndicatorsForLogement(logement.pkLogement)
                                  ?.nbAppareils || 0}
                              </span>
                            </div>
                          </div>
                        </div>

                        {/* Issues */}
                        <div>
                          <h4 className="text-sm font-medium text-gray-700 mb-2">
                            Problèmes
                          </h4>
                          <div className="grid grid-cols-2 gap-2 text-sm">
                            <div className="flex justify-between">
                              <span className="text-gray-600">Fuites:</span>
                              <span
                                className={`font-medium ${
                                  (getIndicatorsForLogement(logement.pkLogement)
                                    ?.nbFuites || 0) > 0
                                    ? "text-red-600"
                                    : "text-gray-600"
                                }`}
                              >
                                {getIndicatorsForLogement(logement.pkLogement)
                                  ?.nbFuites || 0}
                              </span>
                            </div>
                            <div className="flex justify-between">
                              <span className="text-gray-600">Anomalies:</span>
                              <span
                                className={`font-medium ${
                                  (getIndicatorsForLogement(logement.pkLogement)
                                    ?.nbAnomalies || 0) > 0
                                    ? "text-red-600"
                                    : "text-gray-600"
                                }`}
                              >
                                {getIndicatorsForLogement(logement.pkLogement)
                                  ?.nbAnomalies || 0}
                              </span>
                            </div>
                            <div className="flex justify-between">
                              <span className="text-gray-600">
                                Dysfonctionnements:
                              </span>
                              <span
                                className={`font-medium ${
                                  (getIndicatorsForLogement(logement.pkLogement)
                                    ?.nbDysfonctionnements || 0) > 0
                                    ? "text-orange-600"
                                    : "text-gray-600"
                                }`}
                              >
                                {getIndicatorsForLogement(logement.pkLogement)
                                  ?.nbDysfonctionnements || 0}
                              </span>
                            </div>
                            <div className="flex justify-between">
                              <span className="text-gray-600">Dépannages:</span>
                              <span
                                className={`font-medium ${
                                  (getIndicatorsForLogement(logement.pkLogement)
                                    ?.nbDepannages || 0) > 0
                                    ? "text-yellow-600"
                                    : "text-gray-600"
                                }`}
                              >
                                {getIndicatorsForLogement(logement.pkLogement)
                                  ?.nbDepannages || 0}
                              </span>
                            </div>
                          </div>
                        </div>
                      </div>
                    ) : (
                      <div className="text-center py-4 text-gray-500">
                        <i className="fas fa-chart-line text-2xl mb-2"></i>
                        <p>Aucun indicateur disponible</p>
                      </div>
                    )}
                  </div>
                </div>
              ))
            )}
          </div>
        )}
      </div>
    </BaseLayout>
  );
};

export default LogementsListPage;
