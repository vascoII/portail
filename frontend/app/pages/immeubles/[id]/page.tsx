"use client";

import React, { useState } from "react";
import { useParams } from "next/navigation";
import BaseLayout from "../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../components/Layout/Breadcrumb";
import ImmeubleDetailSkeleton from "../../../components/Immeuble/ImmeubleDetailSkeleton";
import DataPanel from "../../../components/Immeuble/DataPanel";
import { useImmeuble } from "../../../hooks/useImmeuble";

const ImmeubleDetailPage: React.FC = () => {
  const params = useParams();
  const immeubleId = parseInt(params.id as string, 10);

  const {
    // Main immeuble data
    immeuble,
    immeubleLoading,
    immeubleError,

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

    serieConsosCompteurGeneral,
    serieConsosCompteurGeneralLoading,
    serieConsosCompteurGeneralError,

    serieConsosEau,
    serieConsosEauLoading,
    serieConsosEauError,

    anomalies,
    anomaliesLoading,
    anomaliesError,

    dysfonctionnements,
    dysfonctionnementsLoading,
    dysfonctionnementsError,

    fuites,
    fuitesLoading,
    fuitesError,

    // Actions
    refetchImmeuble,
    refetchAsyncData,
  } = useImmeuble(immeubleId);

  const [activeTab, setActiveTab] = useState<string>("ef");

  const breadcrumbItems = [
    { label: "Le parc", href: "/pages/dashboard" },
    { label: "Liste des immeubles", href: "/pages/immeubles" },
    { label: `Immeuble ${immeuble?.ref || ""}`, href: "#" },
  ];

  // Show main skeleton while immeuble is loading
  if (immeubleLoading) {
    return (
      <BaseLayout>
        <Breadcrumb items={breadcrumbItems} />
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <ImmeubleDetailSkeleton />
        </div>
      </BaseLayout>
    );
  }

  // Show error if immeuble failed to load
  if (immeubleError) {
    return (
      <BaseLayout>
        <Breadcrumb items={breadcrumbItems} />
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <div className="bg-red-50 border border-red-200 rounded-lg p-6">
            <div className="flex items-center justify-between">
              <div>
                <h3 className="text-lg font-medium text-red-800 mb-2">
                  Erreur lors du chargement de l&apos;immeuble
                </h3>
                <p className="text-red-600 text-sm">{immeubleError}</p>
              </div>
              <button
                onClick={refetchImmeuble}
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

  if (!immeuble) {
    return (
      <BaseLayout>
        <Breadcrumb items={breadcrumbItems} />
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <div className="text-center py-12">
            <h2 className="text-2xl font-bold text-gray-900 mb-4">
              Immeuble non trouvé
            </h2>
            <p className="text-gray-600">
              L&apos;immeuble demandé n&apos;existe pas ou n&apos;est pas accessible.
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
          Aperçu de l&apos;immeuble {immeuble.ref}
        </h2>

        {/* Main building info */}
        <div className="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-8">
          {/* Main panel */}
          <div className="lg:col-span-2">
            <div className="bg-white rounded-lg shadow-md p-6">
              <div className="flex items-start space-x-4 mb-6">
                <div className="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center">
                  <i className="fas fa-building text-2xl text-blue-600"></i>
                </div>
                <div className="flex-1">
                  {immeuble.nom && (
                    <h3 className="text-xl font-semibold text-gray-800 mb-2">
                      {immeuble.nom}
                    </h3>
                  )}
                  <p className="text-gray-600 mb-1">
                    <strong>Référence:</strong> {immeuble.ref}
                  </p>
                  <p className="text-gray-600 mb-1">
                    <strong>N° d&apos;immeuble:</strong> {immeuble.numero}
                  </p>
                  <p className="text-gray-600 mb-1">
                    {immeuble.adresse1} {immeuble.adresse2}{" "}
                    {immeuble.adresse3}
                  </p>
                  <p className="text-gray-600">
                    {immeuble.cp} {immeuble.ville}
                  </p>
                </div>
              </div>

              {/* Stats */}
              <div className="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
                <div className="text-center">
                  <div className="text-2xl font-bold text-blue-600">
                    {immeuble.nbLogements}
                  </div>
                  <div className="text-sm text-gray-600">Logements</div>
                </div>
                <div className="text-center">
                  <div className="text-2xl font-bold text-green-600">
                    {immeuble.nbAppareils}
                  </div>
                  <div className="text-sm text-gray-600">Appareils</div>
                </div>
                {immeuble.nbCompteursEF > 0 && (
                  <div className="text-center">
                    <div className="text-2xl font-bold text-blue-500">
                      {immeuble.nbCompteursEF}
                    </div>
                    <div className="text-sm text-gray-600">Eau froide</div>
                  </div>
                )}
                {immeuble.nbCompteursEC > 0 && (
                  <div className="text-center">
                    <div className="text-2xl font-bold text-red-500">
                      {immeuble.nbCompteursEC}
                    </div>
                    <div className="text-sm text-gray-600">Eau chaude</div>
                  </div>
                )}
                {immeuble.nbCompteursRepart > 0 && (
                  <div className="text-center">
                    <div className="text-2xl font-bold text-purple-500">
                      {immeuble.nbCompteursRepart}
                    </div>
                    <div className="text-sm text-gray-600">Répartiteurs</div>
                  </div>
                )}
                {immeuble.nbCompteursCET > 0 && (
                  <div className="text-center">
                    <div className="text-2xl font-bold text-orange-500">
                      {immeuble.nbCompteursCET}
                    </div>
                    <div className="text-sm text-gray-600">CET</div>
                  </div>
                )}
              </div>

              {/* Status info */}
              <div className="border-t pt-4">
                <p className="text-sm text-gray-600 mb-1">
                  <strong>Mode de relève:</strong>{" "}
                  {immeuble.hasTelereleve
                    ? "Réseau fixe TSS"
                    : "Relève planifiée (radio ou manuelle)"}
                </p>
                <p className="text-sm text-gray-600">
                  <strong>Transfert électronique:</strong>{" "}
                  {immeuble.hasTransfertFichiers ? "Actif" : "Inactif"}
                </p>
              </div>
            </div>
          </div>

          {/* Side panels */}
          <div className="space-y-6">
            {/* Depannages panel */}
            <div className="bg-white rounded-lg shadow-md p-6">
              <div className="text-center">
                <h3 className="text-lg font-semibold text-gray-800 mb-4">
                  Dépannages {immeuble.nbDepannages > 0 ? "en cours" : ""}
                </h3>
                <div className="w-32 h-32 bg-gray-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                  <i className="fas fa-wrench text-3xl text-gray-400"></i>
                </div>
                <div className="text-3xl font-bold text-gray-800">
                  {immeuble.nbDepannages > 0
                    ? immeuble.nbDepannages
                    : immeuble.nbDepannagesTotal}
                </div>
              </div>
            </div>

            {/* Dysfonctionnements panel */}
            <div className="bg-white rounded-lg shadow-md p-6">
              <div className="text-center">
                <h3 className="text-lg font-semibold text-gray-800 mb-4">
                  Alarmes techniques
                </h3>
                <div className="w-32 h-32 bg-gray-100 rounded-full mx-auto mb-4 flex items-center justify-center">
                  <i className="fas fa-bell text-3xl text-gray-400"></i>
                </div>
                <div className="text-3xl font-bold text-gray-800">
                  {immeuble.nbDysfonctionnements === -1
                    ? 0
                    : immeuble.nbDysfonctionnements}
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
              {immeuble.nbCompteursEF > 0 && (
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
              {immeuble.nbCompteursEC > 0 && (
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
              {immeuble.nbCompteursRepart > 0 && (
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
              {immeuble.nbCompteursCET > 0 && (
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
              {immeuble.nbCompteursCapteur > 0 && (
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
              {immeuble.nbCompteursElect > 0 && (
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
              {immeuble.nbCompteursGaz > 0 && (
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

          {/* Série consos compteur général */}
          <DataPanel
            title="Série consos compteur général"
            icon="fas fa-chart-bar"
            data={serieConsosCompteurGeneral}
            loading={serieConsosCompteurGeneralLoading}
            error={serieConsosCompteurGeneralError}
            onRefresh={() => refetchAsyncData("serieConsosCompteurGeneral")}
            showChart={true}
          />

          {/* Série consos eau */}
          <DataPanel
            title="Série consos eau"
            icon="fas fa-chart-area"
            data={serieConsosEau}
            loading={serieConsosEauLoading}
            error={serieConsosEauError}
            onRefresh={() => refetchAsyncData("serieConsosEau")}
            showChart={true}
          />
        </div>
      </div>
    </BaseLayout>
  );
};

export default ImmeubleDetailPage;
