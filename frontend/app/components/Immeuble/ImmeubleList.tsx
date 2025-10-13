"use client";

import React, { useState, useMemo } from "react";
import ImmeubleCard from "./ImmeubleCard";

interface Immeuble {
  Immeuble: {
    PkImmeuble: number;
    Ref: string;
    Numero: string;
    Nom?: string;
    Adresse1: string;
    Adresse2?: string;
    Adresse3?: string;
    Cp: string;
    Ville: string;
  };
  NbLogements: number;
  NbAppareils: number;
  NbCompteursEF: number;
  NbCompteursEC: number;
  NbCompteursRepart: number;
  NbCompteursCET: number;
  NbCompteursElect: number;
  NbCompteursGaz: number;
  NbFuites: number;
  NbAnomalies: number;
  NbDysfonctionnements: number;
  NbDepannages: number;
  NbChantiers: number;
}

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
  filters: FilterState;
  isGestionMode?: boolean;
  showChgtOccupant?: boolean;
  loading?: boolean;
  error?: string | null;
  buildingsLoading?: boolean;
  buildingsError?: string | null;
}

const ImmeubleList: React.FC<ImmeubleListProps> = ({
  immeubles,
  filters,
  isGestionMode = false,
  showChgtOccupant = false,
  loading = false,
  error = null,
  buildingsLoading = false,
  buildingsError = null,
}) => {
  const [viewMode, setViewMode] = useState<"list" | "grid-big" | "grid-small">(
    "list"
  );

  const filteredImmeubles = useMemo(() => {
    return immeubles.filter((immeuble) => {
      // Energy type filter
      if (filters.energie) {
        const hasEnergy = {
          energieef: immeuble.NbCompteursEF > 0,
          energieec: immeuble.NbCompteursEC > 0,
          energiecet: immeuble.NbCompteursCET > 0,
          energierepart: immeuble.NbCompteursRepart > 0,
          energieelect: immeuble.NbCompteursElect > 0,
          energiegaz: immeuble.NbCompteursGaz > 0,
        };

        if (!hasEnergy[filters.energie as keyof typeof hasEnergy]) {
          return false;
        }
      }

      // Alert filters
      if (filters.fuites && immeuble.NbFuites <= 0) return false;
      if (filters.anomalies && immeuble.NbAnomalies <= 0) return false;
      if (filters.dysfonctionnements && immeuble.NbDysfonctionnements <= 0)
        return false;
      if (filters.depannages && immeuble.NbDepannages <= 0) return false;
      if (filters.chantiers && immeuble.NbChantiers <= 0) return false;

      // Text filters
      if (filters.reference) {
        const refMatch = immeuble.Immeuble.Ref.toLowerCase().includes(
          filters.reference.toLowerCase()
        );
        const numMatch = immeuble.Immeuble.Numero.toLowerCase().includes(
          filters.reference.toLowerCase()
        );
        if (!refMatch && !numMatch) return false;
      }

      if (filters.location) {
        const cpMatch = immeuble.Immeuble.Cp.toLowerCase().includes(
          filters.location.toLowerCase()
        );
        const villeMatch = immeuble.Immeuble.Ville.toLowerCase().includes(
          filters.location.toLowerCase()
        );
        if (!cpMatch && !villeMatch) return false;
      }

      return true;
    });
  }, [immeubles, filters]);

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

      {/* Immeubles Grid/List */}
      <div
        className={`${
          viewMode === "list"
            ? "space-y-4"
            : viewMode === "grid-big"
            ? "grid grid-cols-1 lg:grid-cols-2 gap-6"
            : "grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4"
        }`}
      >
        {filteredImmeubles.length === 0 ? (
          <div className="col-span-full text-center py-12">
            <i className="fas fa-building text-4xl text-gray-400 mb-4"></i>
            <p className="text-gray-500 text-lg">Aucun immeuble trouvé</p>
            <p className="text-gray-400 text-sm">
              Essayez de modifier vos filtres de recherche
            </p>
          </div>
        ) : (
          filteredImmeubles.map((immeuble) => (
            <ImmeubleCard
              key={immeuble.Immeuble.PkImmeuble}
              immeuble={immeuble}
              isGestionMode={isGestionMode}
              showChgtOccupant={showChgtOccupant}
            />
          ))
        )}
      </div>
    </div>
  );
};

export default ImmeubleList;
