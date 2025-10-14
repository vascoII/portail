"use client";

import React from "react";
import { useParams } from "next/navigation";
import BaseLayout from "../../../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../../../components/Layout/Breadcrumb";
import { LogementDetailSkeleton } from "../../../../../components/Logement";
import { useLogement } from "../../../../../hooks/useLogement";

// Placeholder components - will be created next
import LogementHeader from "../../../../../components/Logement/LogementHeader";
import LogementCapteurRepartPanel from "../../../../../components/Logement/LogementCapteurRepartPanel";
import LogementWaterEnergyTabs from "../../../../../components/Logement/LogementWaterEnergyTabs";

const LogementDetailPage: React.FC = () => {
  const params = useParams();
  const immeubleId = parseInt(params.id as string, 10);
  const logementId = parseInt(params.logementId as string, 10);

  const {
    // Main logement data
    logement,
    logementLoading,
    logementError,

    // Async data sections
    indicators,
    indicatorsLoading,
    indicatorsError,

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

    repart,
    repartLoading,
    repartError,

    // Combined states
    loading,
    error,

    // Actions
    refetch,
    refetchAsyncData,
  } = useLogement(logementId);

  // Show loading skeleton while main data is loading
  if (logementLoading) {
    return (
      <BaseLayout>
        <div className="container mx-auto px-4 py-6">
          <Breadcrumb
            items={[
              { label: "Immeubles", href: "/pages/immeubles" },
              {
                label: `Immeuble ${immeubleId}`,
                href: `/pages/immeubles/${immeubleId}`,
              },
              {
                label: "Logements",
                href: `/pages/immeubles/${immeubleId}/logements`,
              },
              { label: "Chargement...", href: "#" },
            ]}
          />
          <LogementDetailSkeleton />
        </div>
      </BaseLayout>
    );
  }

  // Show error if main data failed to load
  if (logementError || !logement) {
    return (
      <BaseLayout>
        <div className="container mx-auto px-4 py-6">
          <Breadcrumb
            items={[
              { label: "Immeubles", href: "/pages/immeubles" },
              {
                label: `Immeuble ${immeubleId}`,
                href: `/pages/immeubles/${immeubleId}`,
              },
              {
                label: "Logements",
                href: `/pages/immeubles/${immeubleId}/logements`,
              },
              { label: "Erreur", href: "#" },
            ]}
          />
          <div className="bg-red-50 border border-red-200 rounded-lg p-6">
            <div className="flex items-center">
              <i className="fas fa-exclamation-triangle text-red-500 text-xl mr-3"></i>
              <div>
                <h3 className="text-lg font-semibold text-red-800">
                  Erreur de chargement
                </h3>
                <p className="text-red-600 mt-1">
                  {logementError ||
                    "Impossible de charger les données du logement"}
                </p>
                <button
                  onClick={refetch}
                  className="mt-3 px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition-colors duration-200"
                >
                  Réessayer
                </button>
              </div>
            </div>
          </div>
        </div>
      </BaseLayout>
    );
  }

  return (
    <BaseLayout>
      <div className="container mx-auto px-4 py-6">
        <Breadcrumb
          items={[
            { label: "Immeubles", href: "/pages/immeubles" },
            {
              label: `Immeuble ${immeubleId}`,
              href: `/pages/immeubles/${immeubleId}`,
            },
            {
              label: "Logements",
              href: `/pages/immeubles/${immeubleId}/logements`,
            },
            { label: `Logement ${logement.numOrdre}`, href: "#" },
          ]}
        />

        <div className="space-y-6">
          {/* Top Section: Logement Info + Indicators */}
          <LogementHeader
            logement={logement}
            logementLoading={logementLoading}
            logementError={logementError}
            indicators={indicators}
            indicatorsLoading={indicatorsLoading}
            indicatorsError={indicatorsError}
          />

          {/* Middle Section: Capteur + Repart */}
          <LogementCapteurRepartPanel
            capteur={capteur}
            capteurLoading={capteurLoading}
            capteurError={capteurError}
            repart={repart}
            repartLoading={repartLoading}
            repartError={repartError}
            refetchAsyncData={refetchAsyncData}
          />

          {/* Bottom Section: Water/Energy Tabs (EF, EC, CET) */}
          <LogementWaterEnergyTabs
            cet={cet}
            cetLoading={cetLoading}
            cetError={cetError}
            ec={ec}
            ecLoading={ecLoading}
            ecError={ecError}
            ef={ef}
            efLoading={efLoading}
            efError={efError}
            refetchAsyncData={refetchAsyncData}
          />
        </div>
      </div>
    </BaseLayout>
  );
};

export default LogementDetailPage;
