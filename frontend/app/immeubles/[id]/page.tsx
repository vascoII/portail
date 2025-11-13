"use client";

import React, { useMemo } from "react";
import { useParams } from "next/navigation";
import BaseLayout from "@/src/shared/components/Layout/BaseLayout";
import Breadcrumb from "@/src/shared/components/Layout/Breadcrumb";
import ImmeubleDetailSkeleton from "@/components/Immeuble/ImmeubleDetailSkeleton";
import {
  ImmeubleHeader,
  CapteurRepartPanel,
  WaterEnergyTabs,
} from "@/components/Immeuble";
import { useImmeuble } from "@/src/features/immeuble/hooks/useImmeuble";
import type { GetImmeubleResponseDto } from "@/types/api/response/immeuble/GetImmeubleResponseDto";
import type { Immeuble, ImmeubleIndicators } from "@/src/shared/hooks/useImmeuble";

// Helper function to convert GetImmeubleResponseDto to Immeuble
const convertToImmeuble = (
  dto: GetImmeubleResponseDto | null
): Immeuble | null => {
  if (!dto) return null;
  return {
    pkImmeuble: dto.pkImmeuble ?? 0,
    nom: dto.nom ?? "",
    numero: dto.numero ?? "",
    ref: dto.ref ?? "",
    adresse1: dto.adresse1 ?? "",
    adresse2: dto.adresse2 ?? "",
    adresse3: dto.adresse3 ?? "",
    cp: dto.cp ?? "",
    ville: dto.ville ?? "",
    hasTelereleve: dto.hasTelereleve ?? false,
    fkClientTop: dto.fkClientTop ?? 0,
    actif: dto.actif ?? false,
    dateActivationClient: dto.dateActivationClient ?? "",
    dateActivationOccupant: dto.dateActivationOccupant ?? "",
    hasNoteOccupant: dto.hasNoteOccupant ?? false,
    hasDecompteOccupant: dto.hasDecompteOccupant ?? false,
    hasFactures: dto.hasFactures ?? false,
    hasChantiers: dto.hasChantiers ?? false,
  };
};

// Helper function to extract indicators from GetImmeubleResponseDto
const extractIndicators = (
  dto: GetImmeubleResponseDto | null
): ImmeubleIndicators | null => {
  if (!dto) return null;
  return {
    pkImmeuble: dto.pkImmeuble ?? 0,
    nbLogements: dto.nbLogements ?? 0,
    nbAppareils: dto.nbAppareils ?? 0,
    nbDepannages: dto.nbDepannages ?? 0,
    nbDepannagesTotal: dto.nbDepannagesTotal ?? 0,
    degresDepannages: dto.degresDepannages ?? 0,
    nbDysfonctionnements: dto.nbDysfonctionnements ?? 0,
    degresDysfonctionnements: dto.degresDysfonctionnements ?? 0,
    hasTelereleve: dto.hasTelereleve ?? false,
    nbCompteursEC: dto.nbCompteursEC ?? 0,
    nbCompteursEF: dto.nbCompteursEF ?? 0,
    nbCompteursRepart: dto.nbCompteursRepart ?? 0,
    nbCompteursCET: dto.nbCompteursCET ?? 0,
    nbCompteursCapteur: dto.nbCompteursCapteur ?? 0,
    nbCompteursElect: dto.nbCompteursElect ?? 0,
    nbCompteursGaz: dto.nbCompteursGaz ?? 0,
    nbCompteursTelereveleTotal: dto.nbCompteursTelereveleTotal ?? 0,
    nbCompteursTelereveleOK: dto.nbCompteursTelereveleOK ?? 0,
    hasTransfertFichiers: dto.hasTransfertFichiers ?? false,
  };
};

const ImmeubleDetailPage: React.FC = () => {
  const params = useParams();
  const immeubleId = params.id as string;

  const {
    // Main immeuble data
    immeuble: immeubleDto,
    immeubleLoading,
    immeubleError,
    refetchImmeuble,

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

    repart,
    repartLoading,
    repartError,
  } = useImmeuble({
    pkImmeuble: immeubleId,
    loadCapteur: true,
    loadCet: true,
    loadEc: true,
    loadEf: true,
    loadRepart: true,
  });

  // Convert DTO to component format
  const immeuble = useMemo(() => convertToImmeuble(immeubleDto), [immeubleDto]);
  const indicators = useMemo(
    () => extractIndicators(immeubleDto),
    [immeubleDto]
  );

  // Indicators loading/error states (derived from immeuble data)
  const indicatorsLoading = immeubleLoading;
  const indicatorsError = immeubleError;

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: "Liste des immeubles", href: "/immeubles" },
    { label: `Immeuble ${immeuble?.ref || immeubleDto?.ref || ""}`, href: "#" },
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
                onClick={() => refetchImmeuble(true)}
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
