"use client";

import React, { useMemo, useCallback } from "react";
import { useParams } from "next/navigation";
import BaseLayout from "@/src/shared/components/Layout/BaseLayout";
import Breadcrumb from "@/src/shared/components/Layout/Breadcrumb";
import { LogementDetailSkeleton } from "@/src/features/logement/components";
import { useLogement } from "@/src/features/logement/hooks/useLogement";
import type { LogementResponseDto } from "@/src/features/logement/types/response/LogementResponseDto";
import type { Logement, LogementIndicators } from "@/src/shared/hooks/useLogement";

// Placeholder components - will be created next
import LogementHeader from "@/src/features/logement/components/LogementHeader";
import LogementCapteurRepartPanel from "@/src/features/logement/components/LogementCapteurRepartPanel";
import LogementWaterEnergyTabs from "@/src/features/logement/components/LogementWaterEnergyTabs";

// Helper function to convert LogementResponseDto to Logement
const convertToLogement = (
  dto: LogementResponseDto | null
): Logement | null => {
  if (!dto) return null;
  return {
    pkLogement: dto.pkLogement ?? 0,
    numBatiment: dto.numBatiment ?? "",
    adrBatiment: dto.adrBatiment ?? "",
    numEscalier: dto.numEscalier ?? "",
    adrEscalier: dto.adrEscalier ?? "",
    numEtage: dto.numEtage ?? "",
    numOrdre: dto.numOrdre ?? "",
    type: dto.type ?? "",
  };
};

const LogementDetailPage: React.FC = () => {
  const params = useParams();
  const immeubleId = params.id as string;
  const logementId = params.logementId as string;

  const {
    // Main logement data
    logement: logementDto,
    logementLoading,
    logementError,
    refetchLogement,

    // Async data sections
    capteur,
    capteurLoading,
    capteurError,
    refetchCapteur,

    cet,
    cetLoading,
    cetError,
    refetchCet,

    ec,
    ecLoading,
    ecError,
    refetchEc,

    ef,
    efLoading,
    efError,
    refetchEf,

    repart,
    repartLoading,
    repartError,
    refetchRepart,

    // Combined states
    loading,
    error,
  } = useLogement({
    pkLogement: logementId,
    pkImmeuble: immeubleId, // Required for repart
    loadCapteur: true,
    loadCet: true,
    loadEc: true,
    loadEf: true,
    loadRepart: true,
  });

  // Convert DTO to component format
  const logement = useMemo(() => convertToLogement(logementDto), [logementDto]);

  // Indicators are not available in the new hook yet
  // TODO: Create a service API and hook for logement indicators if needed
  const indicators: LogementIndicators | null = null;
  const indicatorsLoading = false;
  const indicatorsError: string | null = null;

  // Wrapper function for refetchAsyncData to maintain compatibility
  const refetchAsyncData = useCallback(
    async (dataType?: string) => {
      const force = true;
      switch (dataType) {
        case "capteur":
          await refetchCapteur(force);
          break;
        case "cet":
          await refetchCet(force);
          break;
        case "ec":
          await refetchEc(force);
          break;
        case "ef":
          await refetchEf(force);
          break;
        case "repart":
          await refetchRepart(force);
          break;
        default:
          // Refetch all async data
          await Promise.all([
            refetchCapteur(force),
            refetchCet(force),
            refetchEc(force),
            refetchEf(force),
            refetchRepart(force),
          ]);
      }
    },
    [refetchCapteur, refetchCet, refetchEc, refetchEf, refetchRepart]
  );

  // Combined refetch function
  const refetch = useCallback(async () => {
    await refetchLogement(true);
    await refetchAsyncData();
  }, [refetchLogement, refetchAsyncData]);

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: "Immeubles", href: "/immeubles" },
    {
      label: `Immeuble ${immeubleId}`,
      href: `/immeubles/${immeubleId}`,
    },
    {
      label: "Logements",
      href: `/immeubles/${immeubleId}/logements`,
    },
    {
      label: logement?.numOrdre
        ? `Logement ${logement.numOrdre}`
        : logementDto?.numOrdre
        ? `Logement ${logementDto.numOrdre}`
        : "Chargement...",
      href: "#",
    },
  ];

  // Show loading skeleton while main data is loading
  if (logementLoading) {
    return (
      <BaseLayout>
        <div className="container mx-auto px-4 py-6">
          <Breadcrumb items={breadcrumbItems} />
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
              { label: "Immeubles", href: "/immeubles" },
              {
                label: `Immeuble ${immeubleId}`,
                href: `/immeubles/${immeubleId}`,
              },
              {
                label: "Logements",
                href: `/immeubles/${immeubleId}/logements`,
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
                  onClick={() => refetch()}
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
        <Breadcrumb items={breadcrumbItems} />

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
