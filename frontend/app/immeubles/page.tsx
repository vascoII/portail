"use client";

import React, { useState, useMemo, useCallback } from "react";
import BaseLayout from "@/src/shared/components/Layout/BaseLayout";
import Breadcrumb from "@/src/shared/components/Layout/Breadcrumb";
import { ImmeubleFilters, ImmeubleList } from "@/components/Immeuble";
import IndicatorsPanel from "@/components/Immeuble/IndicatorsPanel";
import { useImmeubles } from "@/src/features/immeuble/hooks/useImmeubles";
import type { ImmeubleResponseDto } from "@/types/api/response/immeuble/ImmeubleResponseDto";

interface FilterState {
  energie: string;
  fuites: boolean;
  anomalies: boolean;
  dysfonctionnements: boolean;
  depannages: boolean;
  chantiers: boolean;
  reference: string;
  location: string;
}

// Helper function to convert ImmeubleResponseDto to the old Immeuble type
const convertToImmeuble = (dto: ImmeubleResponseDto) => ({
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
});

// Helper function to convert ImmeubleResponseDto to Indicator type
const convertToIndicator = (dto: ImmeubleResponseDto) => ({
  pkImmeuble: dto.pkImmeuble ?? 0,
  nbLogements: dto.nbLogements ?? 0,
  nbAppareils: dto.nbAppareils ?? 0,
  nbCompteursEC: dto.nbCompteursEC ?? 0,
  nbCompteursEF: dto.nbCompteursEF ?? 0,
  nbCompteursRepart: dto.nbCompteursRepart ?? 0,
  nbCompteursCET: dto.nbCompteursCET ?? 0,
  nbCompteursCapteur: dto.nbCompteursCapteur ?? 0,
  nbCompteursElect: dto.nbCompteursElect ?? 0,
  nbCompteursGaz: dto.nbCompteursGaz ?? 0,
  nbFuites: dto.nbFuites ?? 0,
  nbDepannages: dto.nbDepannages ?? 0,
  nbDysfonctionnements: dto.nbDysfonctionnements ?? 0,
  nbAnomalies: dto.nbAnomalies ?? 0,
  nbChantiers: dto.nbChantiers ?? 0,
});

const ImmeublesListPage: React.FC = () => {
  const { data, loading, error, refetch } = useImmeubles();

  const [filters, setFilters] = useState<FilterState>({
    energie: "",
    fuites: false,
    anomalies: false,
    dysfonctionnements: false,
    depannages: false,
    chantiers: false,
    reference: "",
    location: "",
  });

  // Convert data to the format expected by components
  const immeubles = useMemo(() => {
    if (!data?.listImmeubleDto) return [];
    return data.listImmeubleDto.map(convertToImmeuble);
  }, [data]);

  const indicators = useMemo(() => {
    if (!data?.listImmeubleDto) return [];
    return data.listImmeubleDto.map(convertToIndicator);
  }, [data]);

  // Helper function to get indicators for a specific immeuble
  const getIndicatorsForImmeuble = useCallback(
    (pkImmeuble: number) => {
      return indicators.find((ind) => ind.pkImmeuble === pkImmeuble);
    },
    [indicators]
  );

  // Refetch function for indicators (same as refetch for immeubles)
  const refetchIndicators = useCallback(async () => {
    await refetch(true);
  }, [refetch]);

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: "Liste des immeubles", href: "/immeubles" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 className="text-2xl font-bold text-gray-900 mb-8">
          Liste des immeubles
        </h2>

        {/* Filters */}
        <ImmeubleFilters onFiltersChange={setFilters} />

        {/* Buildings List with Indicators */}
        <div className="mb-8">
          <ImmeubleList
            immeubles={immeubles}
            indicators={indicators}
            filters={filters}
            buildingsLoading={loading}
            buildingsError={error}
            indicatorsLoading={loading}
            indicatorsError={error}
            getIndicatorsForImmeuble={getIndicatorsForImmeuble}
          />
        </div>

        {/* Indicators Panel */}
        <div className="mt-12">
          <IndicatorsPanel
            indicators={indicators}
            loading={loading}
            error={error}
            onRefresh={refetchIndicators}
          />
        </div>
      </div>
    </BaseLayout>
  );
};

export default ImmeublesListPage;
