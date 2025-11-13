"use client";

import React, { useState, useMemo, useCallback } from "react";
import BaseLayout from "@/src/shared/components/Layout/BaseLayout";
import Breadcrumb from "@/src/shared/components/Layout/Breadcrumb";
import {
  ImmeubleFilters,
  ImmeubleList,
} from "@/src/features/immeuble/components";
import IndicatorsPanel from "@/src/features/immeuble/components/IndicatorsPanel";
import { useImmeubles } from "@/src/features/immeuble/hooks/useImmeubles";
import type { ImmeubleResponseDto } from "@/src/features/immeuble/types/response/ImmeubleResponseDto";

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

/**
 * Helper function to convert ImmeubleResponseDto to the Immeuble type expected by components
 * Handles null values, empty strings, and provides sensible defaults
 * @param dto - The DTO from the API response
 * @returns An Immeuble object with all required fields
 */
const convertToImmeuble = (dto: ImmeubleResponseDto) => {
  // Ensure pkImmeuble is always a valid number (required for routing and keys)
  if (dto.pkImmeuble === null || dto.pkImmeuble === undefined) {
    console.warn("convertToImmeuble: pkImmeuble is null/undefined, using 0 as fallback", dto);
  }

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

/**
 * Helper function to convert ImmeubleResponseDto to Indicator type
 * Extracts all indicator-related fields from the DTO
 * Note: -1 values are preserved for nbCompteursElect and nbCompteursGaz as they indicate "not applicable"
 * @param dto - The DTO from the API response
 * @returns An Indicator object with all indicator fields
 */
const convertToIndicator = (dto: ImmeubleResponseDto) => {
  // Ensure pkImmeuble is always a valid number (required for matching with immeubles)
  if (dto.pkImmeuble === null || dto.pkImmeuble === undefined) {
    console.warn("convertToIndicator: pkImmeuble is null/undefined, using 0 as fallback", dto);
  }

  return {
    pkImmeuble: dto.pkImmeuble ?? 0,
    nbLogements: dto.nbLogements ?? 0,
    nbAppareils: dto.nbAppareils ?? 0,
    nbCompteursEC: dto.nbCompteursEC ?? 0,
    nbCompteursEF: dto.nbCompteursEF ?? 0,
    nbCompteursRepart: dto.nbCompteursRepart ?? 0,
    nbCompteursCET: dto.nbCompteursCET ?? 0,
    nbCompteursCapteur: dto.nbCompteursCapteur ?? 0,
    // Preserve -1 values for nbCompteursElect and nbCompteursGaz (they mean "not applicable")
    // If null/undefined, default to -1 to indicate "not applicable"
    nbCompteursElect: dto.nbCompteursElect !== null && dto.nbCompteursElect !== undefined 
      ? dto.nbCompteursElect 
      : -1,
    nbCompteursGaz: dto.nbCompteursGaz !== null && dto.nbCompteursGaz !== undefined 
      ? dto.nbCompteursGaz 
      : -1,
    nbFuites: dto.nbFuites ?? 0,
    nbDepannages: dto.nbDepannages ?? 0,
    nbDysfonctionnements: dto.nbDysfonctionnements ?? 0,
    nbAnomalies: dto.nbAnomalies ?? 0,
    nbChantiers: dto.nbChantiers ?? 0,
  };
};

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
    
    // Convert all DTOs to Immeuble objects
    const converted = data.listImmeubleDto.map(convertToImmeuble);
    
    // Validation: Ensure all immeubles have valid pkImmeuble
    const invalid = converted.filter(im => im.pkImmeuble === 0);
    if (invalid.length > 0) {
      console.warn(
        `[convertToImmeuble] Found ${invalid.length} immeubles with invalid pkImmeuble (0)`,
        invalid
      );
    }
    
    return converted;
  }, [data]);

  const indicators = useMemo(() => {
    if (!data?.listImmeubleDto) return [];
    
    // Convert all DTOs to Indicator objects
    const converted = data.listImmeubleDto.map(convertToIndicator);
    
    // Validation: Ensure all indicators have valid pkImmeuble
    const invalid = converted.filter(ind => ind.pkImmeuble === 0);
    if (invalid.length > 0) {
      console.warn(
        `[convertToIndicator] Found ${invalid.length} indicators with invalid pkImmeuble (0)`,
        invalid
      );
    }
    
    // Validation: Ensure indicators match immeubles
    const immeubleIds = new Set(immeubles.map(im => im.pkImmeuble));
    const orphanIndicators = converted.filter(ind => !immeubleIds.has(ind.pkImmeuble));
    if (orphanIndicators.length > 0) {
      console.warn(
        `[convertToIndicator] Found ${orphanIndicators.length} indicators without matching immeuble`,
        orphanIndicators
      );
    }
    
    return converted;
  }, [data, immeubles]);

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

  // Show error state if there's an error and no data
  if (error && !data) {
    return (
      <BaseLayout>
        <Breadcrumb items={breadcrumbItems} />
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <h2 className="text-2xl font-bold text-gray-900 mb-8">
            Liste des immeubles
          </h2>
          <div className="bg-red-50 border border-red-200 rounded-lg p-6">
            <div className="flex items-center justify-between">
              <div>
                <h3 className="text-lg font-medium text-red-800 mb-2">
                  Erreur lors du chargement des immeubles
                </h3>
                <p className="text-red-600 text-sm">{error}</p>
              </div>
              <button
                onClick={() => refetch(true)}
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

        {/* Indicators Panel - Only show if we have data */}
        {!loading && immeubles.length > 0 && (
          <div className="mt-12">
            <IndicatorsPanel
              indicators={indicators}
              loading={loading}
              error={error}
              onRefresh={refetchIndicators}
            />
          </div>
        )}
      </div>
    </BaseLayout>
  );
};

export default ImmeublesListPage;
