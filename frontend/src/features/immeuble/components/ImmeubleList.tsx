"use client";

import React, { useState, useMemo } from "react";
import ImmeubleCard from "./ImmeubleCard";
import IndicatorsCard from "./IndicatorsCard";
import { Immeuble, Indicator } from "@/src/shared/hooks/useImmeubles";

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

interface ImmeubleListProps {
  immeubles: Immeuble[];
  indicators: Indicator[];
  filters: FilterState;
  isGestionMode?: boolean;
  showChgtOccupant?: boolean;
  buildingsLoading?: boolean;
  buildingsError?: string | null;
  indicatorsLoading?: boolean;
  indicatorsError?: string | null;
  getIndicatorsForImmeuble: (pkImmeuble: number) => Indicator | undefined;
}

const ImmeubleList: React.FC<ImmeubleListProps> = ({
  immeubles,
  indicators,
  filters,
  isGestionMode = false,
  showChgtOccupant = false,
  buildingsLoading = false,
  buildingsError = null,
  indicatorsLoading = false,
  indicatorsError = null,
  getIndicatorsForImmeuble,
}) => {
  const [viewMode, setViewMode] = useState<"list" | "grid-big" | "grid-small">(
    "list"
  );

  const filteredImmeubles = useMemo(() => {
    return immeubles.filter((immeuble) => {
      // Get indicators for this building
      const buildingIndicators = getIndicatorsForImmeuble(immeuble.pkImmeuble);

      // Energy type filter (using indicators data)
      if (filters.energie && buildingIndicators) {
        const hasEnergy = {
          energieef: buildingIndicators.nbCompteursEF > 0,
          energieec: buildingIndicators.nbCompteursEC > 0,
          energiecet: buildingIndicators.nbCompteursCET > 0,
          energierepart: buildingIndicators.nbCompteursRepart > 0,
          energieelect: buildingIndicators.nbCompteursElect > 0,
          energiegaz: buildingIndicators.nbCompteursGaz > 0,
        };

        if (!hasEnergy[filters.energie as keyof typeof hasEnergy]) {
          return false;
        }
      }

      // Alert filters (using indicators data)
      if (buildingIndicators) {
        if (filters.fuites && buildingIndicators.nbFuites <= 0) return false;
        if (filters.anomalies && buildingIndicators.nbAnomalies <= 0)
          return false;
        if (
          filters.dysfonctionnements &&
          buildingIndicators.nbDysfonctionnements <= 0
        )
          return false;
        if (filters.depannages && buildingIndicators.nbDepannages <= 0)
          return false;
        if (filters.chantiers && buildingIndicators.nbChantiers <= 0)
          return false;
      }

      // Text filters (using building data)
      if (filters.reference) {
        const refMatch = immeuble.ref
          .toLowerCase()
          .includes(filters.reference.toLowerCase());
        const numMatch = immeuble.numero
          .toLowerCase()
          .includes(filters.reference.toLowerCase());
        if (!refMatch && !numMatch) return false;
      }

      if (filters.location) {
        const cpMatch = immeuble.cp
          .toLowerCase()
          .includes(filters.location.toLowerCase());
        const villeMatch = immeuble.ville
          .toLowerCase()
          .includes(filters.location.toLowerCase());
        if (!cpMatch && !villeMatch) return false;
      }

      return true;
    });
  }, [immeubles, indicators, filters, getIndicatorsForImmeuble]);

  if (buildingsLoading) {
    return (
      <div className="space-y-6">
        {/* Header skeleton */}
        <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between">
          <div className="h-8 bg-gray-200 rounded w-48 mb-4 sm:mb-0 animate-pulse"></div>
          <div className="flex items-center space-x-2">
            <div className="h-4 bg-gray-200 rounded w-20 animate-pulse"></div>
            <div className="flex bg-gray-100 rounded-lg p-1">
              <div className="h-8 w-8 bg-gray-200 rounded animate-pulse"></div>
              <div className="h-8 w-8 bg-gray-200 rounded ml-1 animate-pulse"></div>
              <div className="h-8 w-8 bg-gray-200 rounded ml-1 animate-pulse"></div>
            </div>
          </div>
        </div>

        {/* Buildings skeleton */}
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
          {Array.from({ length: 6 }, (_, index) => (
            <div
              key={index}
              className="bg-white rounded-lg shadow-md p-6 animate-pulse"
            >
              <div className="h-6 bg-gray-200 rounded w-1/3 mb-4"></div>
              <div className="space-y-2 mb-4">
                <div className="h-4 bg-gray-200 rounded w-2/3"></div>
                <div className="h-4 bg-gray-200 rounded w-1/2"></div>
              </div>
              <div className="grid grid-cols-2 gap-4 mb-4">
                <div className="space-y-2">
                  <div className="h-3 bg-gray-200 rounded w-16"></div>
                  <div className="h-5 bg-gray-200 rounded w-8"></div>
                </div>
                <div className="space-y-2">
                  <div className="h-3 bg-gray-200 rounded w-16"></div>
                  <div className="h-5 bg-gray-200 rounded w-8"></div>
                </div>
              </div>
              <div className="flex flex-wrap gap-2">
                <div className="h-6 bg-gray-200 rounded-full w-16"></div>
                <div className="h-6 bg-gray-200 rounded-full w-16"></div>
              </div>
            </div>
          ))}
        </div>
      </div>
    );
  }

  if (buildingsError) {
    return (
      <div className="bg-red-50 border border-red-200 rounded-lg p-6">
        <div className="flex items-center justify-between">
          <div>
            <h3 className="text-lg font-medium text-red-800 mb-2">
              Erreur lors du chargement des immeubles
            </h3>
            <p className="text-red-600 text-sm">{buildingsError}</p>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <h2 className="text-2xl font-bold text-gray-800">
          <span className="text-blue-600">{filteredImmeubles.length}</span>{" "}
          Immeubles
        </h2>

        {/* View Mode Toggle */}
        <div className="flex items-center space-x-2 mt-4 sm:mt-0">
          <label className="text-sm font-medium text-gray-700">
            Affichage par :
          </label>
          <div className="flex bg-gray-100 rounded-lg p-1">
            <button
              onClick={() => setViewMode("list")}
              className={`px-3 py-1 rounded text-sm transition-colors duration-200 ${
                viewMode === "list"
                  ? "bg-white text-blue-600 shadow-sm"
                  : "text-gray-600 hover:text-gray-800"
              }`}
            >
              <i className="fas fa-list"></i>
            </button>
            <button
              onClick={() => setViewMode("grid-big")}
              className={`px-3 py-1 rounded text-sm transition-colors duration-200 ${
                viewMode === "grid-big"
                  ? "bg-white text-blue-600 shadow-sm"
                  : "text-gray-600 hover:text-gray-800"
              }`}
            >
              <i className="fas fa-th"></i>
            </button>
            <button
              onClick={() => setViewMode("grid-small")}
              className={`px-3 py-1 rounded text-sm transition-colors duration-200 ${
                viewMode === "grid-small"
                  ? "bg-white text-blue-600 shadow-sm"
                  : "text-gray-600 hover:text-gray-800"
              }`}
            >
              <i className="fas fa-th-large"></i>
            </button>
          </div>
        </div>
      </div>

      {/* Immeubles with Indicators - Two Column Layout */}
      <div className="space-y-6">
        {filteredImmeubles.length === 0 ? (
          <div className="text-center py-12">
            <i className="fas fa-building text-4xl text-gray-400 mb-4"></i>
            <p className="text-gray-500 text-lg">Aucun immeuble trouvé</p>
            <p className="text-gray-400 text-sm">
              Essayez de modifier vos filtres de recherche
            </p>
          </div>
        ) : (
          filteredImmeubles.map((immeuble) => (
            <div
              key={immeuble.pkImmeuble}
              className="grid grid-cols-1 lg:grid-cols-2 gap-6"
            >
              {/* Left Column - Building Info */}
              <ImmeubleCard
                immeuble={immeuble}
                isGestionMode={isGestionMode}
                showChgtOccupant={showChgtOccupant}
                loading={buildingsLoading}
                error={buildingsError}
              />

              {/* Right Column - Indicators */}
              <IndicatorsCard
                buildingId={immeuble.pkImmeuble}
                indicators={getIndicatorsForImmeuble(immeuble.pkImmeuble)}
                loading={indicatorsLoading}
                error={indicatorsError}
              />
            </div>
          ))
        )}
      </div>
    </div>
  );
};

export default ImmeubleList;
