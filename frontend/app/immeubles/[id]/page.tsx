"use client";

import React from "react";
import { useParams } from "next/navigation";
import BaseLayout from "../../../src/components/Layout/BaseLayout";
import Breadcrumb from "../../../src/components/Layout/Breadcrumb";
import ImmeubleDetailSkeleton from "../../../src/components/Immeuble/ImmeubleDetailSkeleton";
import {
  ImmeubleHeader,
  CapteurRepartPanel,
  WaterEnergyTabs,
} from "../../../src/components/Immeuble";
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

    indicators,
    indicatorsLoading,
    indicatorsError,

    repart,
    repartLoading,
    repartError,

    // Actions
    refetchImmeuble,
    refetchAsyncData,
  } = useImmeuble(immeubleId);

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: "Liste des immeubles", href: "/immeubles" },
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
              L&apos;immeuble demandé n&apos;existe pas ou n&apos;est pas
              accessible.
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
        {/* Top Section: Building + Indicators */}
        <ImmeubleHeader
          immeuble={immeuble}
          immeubleLoading={immeubleLoading}
          immeubleError={immeubleError}
          indicators={indicators}
          indicatorsLoading={indicatorsLoading}
          indicatorsError={indicatorsError}
        />

        {/* Middle Section: Capteur + Repart */}
        <CapteurRepartPanel
          capteur={capteur}
          capteurLoading={capteurLoading}
          capteurError={capteurError}
          repart={repart}
          repartLoading={repartLoading}
          repartError={repartError}
        />

        {/* Bottom Section: Water/Energy Tabs */}
        <WaterEnergyTabs
          cet={cet}
          cetLoading={cetLoading}
          cetError={cetError}
          ec={ec}
          ecLoading={ecLoading}
          ecError={ecError}
          ef={ef}
          efLoading={efLoading}
          efError={efError}
        />
      </div>
    </BaseLayout>
  );
};

export default ImmeubleDetailPage;
