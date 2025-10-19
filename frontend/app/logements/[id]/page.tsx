"use client";

import React, { useState } from "react";
import { useParams } from "next/navigation";
import BaseLayout from "../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../components/Layout/Breadcrumb";
import LogementDetailSkeleton from "../../../components/Logement/LogementDetailSkeleton";
import DataPanel from "../../../components/Immeuble/DataPanel";
import { useLogement } from "../../../hooks/useLogement";

const LogementDetailPage: React.FC = () => {
  const params = useParams();
  const logementId = parseInt(params.id as string, 10);

  const {
    // Main logement data
    logement,
    logementLoading,
    logementError,

    // Async data sections
    capteur,
    capteurLoading,
    capteurError,

    cet,
    cetLoading,
    cetError,

    ec,
    ecLoading,
    ecError,

    ef,
    efLoading,
    efError,

    elect,
    electLoading,
    electError,

    gaz,
    gazLoading,
    gazError,

    indicators,
    indicatorsLoading,
    indicatorsError,

    repart,
    repartLoading,
    repartError,

    anomalies,
    anomaliesLoading,
    anomaliesError,

    dysfonctionnements,
    dysfonctionnementsLoading,
    dysfonctionnementsError,

    fuites,
    fuitesLoading,
    fuitesError,

    interventions,
    interventionsLoading,
    interventionsError,

    // Actions
    refetchLogement,
    refetchAsyncData,
  } = useLogement(logementId);

  const [activeTab, setActiveTab] = useState<string>("ef");

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: "Liste des immeubles", href: "/immeubles" },
    ...(logement?.Immeuble
      ? [
          {
            label: `Immeuble ${logement.Immeuble.Ref}`,
            href: `/immeubles/${logement.Immeuble.PkImmeuble}`,
          },
          {
            label: "Liste des logements",
            href: `/logements?immeuble=${logement.Immeuble.PkImmeuble}`,
          },
        ]
      : []),
    { label: `Logement ${logement?.Occupant.Ref || ""}`, href: "#" },
  ];

  // Show main skeleton while logement is loading
  if (logementLoading) {
    return (
      <BaseLayout>
        <Breadcrumb items={breadcrumbItems} />
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <LogementDetailSkeleton />
        </div>
      </BaseLayout>
    );
  }

  // Show error if logement failed to load
  if (logementError) {
    return (
      <BaseLayout>
        <Breadcrumb items={breadcrumbItems} />
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <div className="bg-red-50 border border-red-200 rounded-lg p-6">
            <div className="flex items-center justify-between">
              <div>
                <h3 className="text-lg font-medium text-red-800 mb-2">
                  Erreur lors du chargement du logement
                </h3>
                <p className="text-red-600 text-sm">{logementError}</p>
              </div>
              <button
                onClick={refetchLogement}
                className="px-4 py-2 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition-colors"
              >
                Réessayer
              </button>
            </div>
          </div>
        </div>
      </BaseLayout>
    );
  }

  if (!logement) {
    return (
      <BaseLayout>
        <Breadcrumb items={breadcrumbItems} />
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <div className="text-center py-12">
            <h2 className="text-2xl font-bold text-gray-900 mb-4">
              Logement non trouvé
            </h2>
            <p className="text-gray-600">
              Le logement demandé n'existe pas ou n'est pas accessible.
            </p>
          </div>
        </div>
      </BaseLayout>
    );
  }

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 className="text-2xl font-bold text-gray-900 mb-8">
          Aperçu du logement {logement.Occupant.Ref}
        </h2>

        {/* Main logement info */}
        <div className="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
          {/* Main panel */}
          <div className="lg:col-span-2">
            <div className="bg-white rounded-lg shadow-md p-6">
              {/* Logement info */}
              <div className="flex items-start space-x-4 mb-6">
                <div className="w-16 h-16 bg-green-100 rounded-lg flex items-center justify-center">
                  <i className="fas fa-home text-2xl text-green-600"></i>
                </div>
                <div className="flex-1">
                  <h3 className="text-xl font-semibold text-gray-800 mb-2">
                    Référence: {logement.Occupant.Ref}
                  </h3>
                  <p className="text-gray-600 mb-1">
                    <strong>N° d'immeuble:</strong> {logement.Immeuble.Numero}
                  </p>
                  <div className="grid grid-cols-2 gap-2 mt-2">
                    <div className="text-sm text-gray-600">
                      <strong>Bâtiment:</strong> {logement.Logement.NumBatiment}
                    </div>
                    <div className="text-sm text-gray-600">
                      <strong>Escalier:</strong> {logement.Logement.NumEscalier}
                    </div>
                    <div className="text-sm text-gray-600">
                      <strong>Étage:</strong> {logement.Logement.NumEtage}
                    </div>
                    <div className="text-sm text-gray-600">
                      <strong>Logement:</strong> {logement.Logement.NumOrdre}
                    </div>
                  </div>
                  {logement.Logement.AdrBatiment && (
                    <p className="text-gray-600 mt-2">
                      {logement.Logement.AdrBatiment}
                    </p>
                  )}
                  <p className="text-gray-600">
                    {logement.Immeuble.Cp} {logement.Immeuble.Ville}
                  </p>
                </div>
              </div>

              {/* Occupant info */}
              <div className="flex items-start space-x-4 mb-6">
                <div className="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center">
                  <i className="fas fa-user text-2xl text-blue-600"></i>
                </div>
                <div className="flex-1">
                  <h3 className="text-xl font-semibold text-gray-800 mb-2">
                    Occupant: {logement.Occupant.Nom}
                  </h3>
                  <p className="text-gray-600 mb-1">
                    <strong>Date d'arrivée:</strong>{" "}
                    {new Date(logement.Occupant.DateArrivee).toLocaleDateString(
                      "fr-FR"
                    )}
                  </p>
                </div>
              </div>

              {/* Stats */}
              <div className="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                <div className="text-center">
                  <div className="text-2xl font-bold text-green-600">
                    {logement.NbAppareils}
                  </div>
                  <div className="text-sm text-gray-600">Appareils</div>
                </div>
                {logement.NbCompteursEF > 0 && (
                  <div className="text-center">
                    <div className="text-2xl font-bold text-blue-500">
                      {logement.NbCompteursEF}
                    </div>
                    <div className="text-sm text-gray-600">Eau froide</div>
                  </div>
                )}
                {logement.NbCompteursEC > 0 && (
                  <div className="text-center">
                    <div className="text-2xl font-bold text-red-500">
                      {logement.NbCompteursEC}
                    </div>
                    <div className="text-sm text-gray-600">Eau chaude</div>
                  </div>
                )}
                {logement.NbCompteursRepart > 0 && (
                  <div className="text-center">
                    <div className="text-2xl font-bold text-purple-500">
                      {logement.NbCompteursRepart}
                    </div>
                    <div className="text-sm text-gray-600">Répartiteurs</div>
                  </div>
                )}
                {logement.NbCompteursCET > 0 && (
                  <div className="text-center">
                    <div className="text-2xl font-bold text-orange-500">
                      {logement.NbCompteursCET}
                    </div>
                    <div className="text-sm text-gray-600">CET</div>
                  </div>
                )}
                {logement.NbCompteursElect > 0 && (
                  <div className="text-center">
                    <div className="text-2xl font-bold text-yellow-500">
                      {logement.NbCompteursElect}
                    </div>
                    <div className="text-sm text-gray-600">Électricité</div>
                  </div>
                )}
              </div>

              {/* Status info */}
              <div className="border-t pt-4">
                <p className="text-sm text-gray-600 mb-1">
                  <strong>Mode de relève:</strong>{" "}
                  {logement.Immeuble.HasTelereleve
                    ? "Réseau fixe TSS"
                    : "Relève planifiée (radio ou manuelle)"}
                </p>
                <p className="text-sm text-gray-600">
                  <strong>Transfert électronique:</strong>{" "}
                  {logement.Immeuble.HasNoteOccupant ? "Actif" : "Inactif"}
                </p>
              </div>
            </div>
          </div>

          {/* Side panels */}
          <div className="space-y-6">
            {/* Tickets panel */}
            {logement.TicketsInterEnabled && (
              <div className="bg-white rounded-lg shadow-md p-6">
                <div className="text-center">
                  <h3 className="text-lg font-semibold text-gray-800 mb-4">
                    Tickets en cours
                  </h3>
                  <div className="w-32 h-32 bg-gray-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                    <i className="fas fa-ticket-alt text-3xl text-gray-400"></i>
                  </div>
                  <div className="text-3xl font-bold text-gray-800">
                    {logement.NbTicketsInter}
                  </div>
                </div>
              </div>
            )}

            {/* Alerts panel */}
            <div className="bg-white rounded-lg shadow-md p-6">
              <div className="text-center">
                <h3 className="text-lg font-semibold text-gray-800 mb-4">
                  Alertes
                </h3>
                <div className="w-32 h-32 bg-gray-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                  <i className="fas fa-exclamation-triangle text-3xl text-gray-400"></i>
                </div>
                <div className="text-3xl font-bold text-gray-800">
                  {logement.NbAnomalies +
                    logement.NbDysfonctionnements +
                    logement.NbFuites}
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Tabs for different data types */}
        <div className="bg-white rounded-lg shadow-md">
          {/* Tab navigation */}
          <div className="border-b border-gray-200">
            <nav className="flex space-x-1 p-4">
              {logement.NbCompteursEF > 0 && (
                <button
                  onClick={() => setActiveTab("ef")}
                  className={`px-4 py-2 rounded-md text-sm font-medium transition-colors ${
                    activeTab === "ef"
                      ? "bg-blue-100 text-blue-700"
                      : "text-gray-500 hover:text-gray-700"
                  }`}
                >
                  <i className="fas fa-tint mr-2"></i>
                  Eau froide
                </button>
              )}
              {logement.NbCompteursEC > 0 && (
                <button
                  onClick={() => setActiveTab("ec")}
                  className={`px-4 py-2 rounded-md text-sm font-medium transition-colors ${
                    activeTab === "ec"
                      ? "bg-blue-100 text-blue-700"
                      : "text-gray-500 hover:text-gray-700"
                  }`}
                >
                  <i className="fas fa-tint mr-2"></i>
                  Eau chaude
                </button>
              )}
              {logement.NbCompteursRepart > 0 && (
                <button
                  onClick={() => setActiveTab("repart")}
                  className={`px-4 py-2 rounded-md text-sm font-medium transition-colors ${
                    activeTab === "repart"
                      ? "bg-blue-100 text-blue-700"
                      : "text-gray-500 hover:text-gray-700"
                  }`}
                >
                  <i className="fas fa-th mr-2"></i>
                  Répartiteur
                </button>
              )}
              {logement.NbCompteursCET > 0 && (
                <button
                  onClick={() => setActiveTab("cet")}
                  className={`px-4 py-2 rounded-md text-sm font-medium transition-colors ${
                    activeTab === "cet"
                      ? "bg-blue-100 text-blue-700"
                      : "text-gray-500 hover:text-gray-700"
                  }`}
                >
                  <i className="fas fa-tachometer-alt mr-2"></i>
                  CET
                </button>
              )}
              {logement.NbCompteursCapteur > 0 && (
                <button
                  onClick={() => setActiveTab("capteur")}
                  className={`px-4 py-2 rounded-md text-sm font-medium transition-colors ${
                    activeTab === "capteur"
                      ? "bg-blue-100 text-blue-700"
                      : "text-gray-500 hover:text-gray-700"
                  }`}
                >
                  <i className="fas fa-thermometer-half mr-2"></i>
                  Température
                </button>
              )}
              {logement.NbCompteursElect > 0 && (
                <button
                  onClick={() => setActiveTab("elect")}
                  className={`px-4 py-2 rounded-md text-sm font-medium transition-colors ${
                    activeTab === "elect"
                      ? "bg-blue-100 text-blue-700"
                      : "text-gray-500 hover:text-gray-700"
                  }`}
                >
                  <i className="fas fa-bolt mr-2"></i>
                  Électricité
                </button>
              )}
              {logement.NbCompteursGaz > 0 && (
                <button
                  onClick={() => setActiveTab("gaz")}
                  className={`px-4 py-2 rounded-md text-sm font-medium transition-colors ${
                    activeTab === "gaz"
                      ? "bg-blue-100 text-blue-700"
                      : "text-gray-500 hover:text-gray-700"
                  }`}
                >
                  <i className="fas fa-fire mr-2"></i>
                  Gaz
                </button>
              )}
            </nav>
          </div>

          {/* Tab content */}
          <div className="p-6">
            {activeTab === "ef" && (
              <DataPanel
                title="Eau froide"
                icon="fas fa-tint"
                data={ef}
                loading={efLoading}
                error={efError}
                onRefresh={() => refetchAsyncData("ef")}
                showChart={true}
                showStats={true}
              />
            )}

            {activeTab === "ec" && (
              <DataPanel
                title="Eau chaude"
                icon="fas fa-tint"
                data={ec}
                loading={ecLoading}
                error={ecError}
                onRefresh={() => refetchAsyncData("ec")}
                showChart={true}
                showStats={true}
              />
            )}

            {activeTab === "repart" && (
              <DataPanel
                title="Répartiteur"
                icon="fas fa-th"
                data={repart}
                loading={repartLoading}
                error={repartError}
                onRefresh={() => refetchAsyncData("repart")}
                showChart={true}
                showStats={true}
              />
            )}

            {activeTab === "cet" && (
              <DataPanel
                title="Compteur d'énergie thermique"
                icon="fas fa-tachometer-alt"
                data={cet}
                loading={cetLoading}
                error={cetError}
                onRefresh={() => refetchAsyncData("cet")}
                showChart={true}
                showStats={true}
              />
            )}

            {activeTab === "capteur" && (
              <DataPanel
                title="Température/Humidité"
                icon="fas fa-thermometer-half"
                data={capteur}
                loading={capteurLoading}
                error={capteurError}
                onRefresh={() => refetchAsyncData("capteur")}
                showChart={true}
                showStats={true}
              />
            )}

            {activeTab === "elect" && (
              <DataPanel
                title="Électricité"
                icon="fas fa-bolt"
                data={elect}
                loading={electLoading}
                error={electError}
                onRefresh={() => refetchAsyncData("elect")}
                showChart={true}
                showStats={true}
              />
            )}

            {activeTab === "gaz" && (
              <DataPanel
                title="Gaz"
                icon="fas fa-fire"
                data={gaz}
                loading={gazLoading}
                error={gazError}
                onRefresh={() => refetchAsyncData("gaz")}
                showChart={true}
                showStats={true}
              />
            )}
          </div>
        </div>

        {/* Additional data panels */}
        <div className="mt-8 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {/* Indicators */}
          <DataPanel
            title="Indicateurs"
            icon="fas fa-chart-line"
            data={indicators}
            loading={indicatorsLoading}
            error={indicatorsError}
            onRefresh={() => refetchAsyncData("indicators")}
            showChart={true}
            showStats={true}
          />

          {/* Anomalies */}
          <DataPanel
            title="Anomalies"
            icon="fas fa-exclamation-triangle"
            data={anomalies}
            loading={anomaliesLoading}
            error={anomaliesError}
            onRefresh={() => refetchAsyncData("anomalies")}
            showList={true}
            listCount={5}
          />

          {/* Dysfonctionnements */}
          <DataPanel
            title="Dysfonctionnements"
            icon="fas fa-bell"
            data={dysfonctionnements}
            loading={dysfonctionnementsLoading}
            error={dysfonctionnementsError}
            onRefresh={() => refetchAsyncData("dysfonctionnements")}
            showList={true}
            listCount={5}
          />

          {/* Fuites */}
          <DataPanel
            title="Fuites"
            icon="fas fa-tint"
            data={fuites}
            loading={fuitesLoading}
            error={fuitesError}
            onRefresh={() => refetchAsyncData("fuites")}
            showList={true}
            listCount={5}
          />

          {/* Interventions */}
          <DataPanel
            title="Interventions"
            icon="fas fa-wrench"
            data={interventions}
            loading={interventionsLoading}
            error={interventionsError}
            onRefresh={() => refetchAsyncData("interventions")}
            showList={true}
            listCount={5}
          />
        </div>
      </div>
    </BaseLayout>
  );
};

export default LogementDetailPage;
