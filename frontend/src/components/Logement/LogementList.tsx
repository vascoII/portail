"use client";

import React, { useState, useMemo } from "react";
import LogementCard from "./LogementCard";

interface Logement {
  infosLogement: {
    Logement: {
      PkLogement: number;
      Ref?: string;
      NumOrdre: string;
      NumBatiment: string;
      NumEscalier: string;
      NumEtage: string;
    };
    Occupant: {
      Ref: string;
      Nom: string;
    };
    NbFuites: number;
    NbAnomalies: number;
    NbDysfonctionnements: number;
    NbDepannages: number;
    NbCompteursEF: number;
    NbCompteursEC: number;
    NbCompteursRepart: number;
    NbCompteursCET: number;
    NbCompteursElect: number;
    NbCompteursGaz: number;
    TicketsInterEnabled: boolean;
    NbTicketsInter: number;
  };
}

interface FilterState {
  energie: string;
  fuites: boolean;
  anomalies: boolean;
  dysfonctionnements: boolean;
  depannages: boolean;
  reference: string;
  location: string;
  batiment: string;
  escalier: string;
  etage: string;
}

interface LogementListProps {
  logements: Logement[];
  filters: FilterState;
  isGestionMode?: boolean;
  showChgtOccupant?: boolean;
  loading?: boolean;
  error?: string | null;
  logementsLoading?: boolean;
  logementsError?: string | null;
}

const LogementList: React.FC<LogementListProps> = ({
  logements,
  filters,
  isGestionMode = false,
  showChgtOccupant = false,
  loading = false,
  error = null,
  logementsLoading = false,
  logementsError = null,
}) => {
  const [viewMode, setViewMode] = useState<"list" | "grid-big" | "grid-small">(
    "list"
  );

  const filteredLogements = useMemo(() => {
    return logements.filter((logement) => {
      // Energy type filter
      if (filters.energie) {
        const hasEnergy = {
          energieef: logement.infosLogement.NbCompteursEF > 0,
          energieec: logement.infosLogement.NbCompteursEC > 0,
          energiecet: logement.infosLogement.NbCompteursCET > 0,
          energierepart: logement.infosLogement.NbCompteursRepart > 0,
          energieelect: logement.infosLogement.NbCompteursElect > 0,
          energiegaz: logement.infosLogement.NbCompteursGaz > 0,
        };

        if (!hasEnergy[filters.energie as keyof typeof hasEnergy]) {
          return false;
        }
      }

      // Alert filters
      if (filters.fuites && logement.infosLogement.NbFuites <= 0) return false;
      if (filters.anomalies && logement.infosLogement.NbAnomalies <= 0)
        return false;
      if (
        filters.dysfonctionnements &&
        logement.infosLogement.NbDysfonctionnements <= 0
      )
        return false;
      if (filters.depannages && logement.infosLogement.NbDepannages <= 0)
        return false;

      // Text filters
      if (filters.reference) {
        const refMatch =
          logement.infosLogement.Occupant.Ref.toLowerCase().includes(
            filters.reference.toLowerCase()
          );
        const numMatch =
          logement.infosLogement.Logement.NumOrdre.toLowerCase().includes(
            filters.reference.toLowerCase()
          );
        if (!refMatch && !numMatch) return false;
      }

      if (filters.location) {
        // This would need to be implemented based on actual data structure
        // For now, we'll skip this filter
        return true;
      }

      // Building/Floor/Stair filters
      if (
        filters.batiment &&
        logement.infosLogement.Logement.NumBatiment !== filters.batiment
      ) {
        return false;
      }
      if (
        filters.escalier &&
        logement.infosLogement.Logement.NumEscalier !== filters.escalier
      ) {
        return false;
      }
      if (
        filters.etage &&
        logement.infosLogement.Logement.NumEtage !== filters.etage
      ) {
        return false;
      }

      return true;
    });
  }, [logements, filters]);

  if (logementsLoading) {
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

        {/* Logements skeleton */}
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
                <div className="h-4 bg-gray-200 rounded w-3/4"></div>
              </div>
              <div className="space-y-2 mb-4">
                <div className="h-4 bg-gray-200 rounded w-1/2"></div>
                <div className="h-4 bg-gray-200 rounded w-1/3"></div>
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

  if (logementsError) {
    return (
      <div className="bg-red-50 border border-red-200 rounded-lg p-6">
        <div className="flex items-center justify-between">
          <div>
            <h3 className="text-lg font-medium text-red-800 mb-2">
              Erreur lors du chargement des logements
            </h3>
            <p className="text-red-600 text-sm">{logementsError}</p>
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
          <span className="text-green-600">{filteredLogements.length}</span>{" "}
          Logements
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
                  ? "bg-white text-green-600 shadow-sm"
                  : "text-gray-600 hover:text-gray-800"
              }`}
            >
              <i className="fas fa-list"></i>
            </button>
            <button
              onClick={() => setViewMode("grid-big")}
              className={`px-3 py-1 rounded text-sm transition-colors duration-200 ${
                viewMode === "grid-big"
                  ? "bg-white text-green-600 shadow-sm"
                  : "text-gray-600 hover:text-gray-800"
              }`}
            >
              <i className="fas fa-th"></i>
            </button>
            <button
              onClick={() => setViewMode("grid-small")}
              className={`px-3 py-1 rounded text-sm transition-colors duration-200 ${
                viewMode === "grid-small"
                  ? "bg-white text-green-600 shadow-sm"
                  : "text-gray-600 hover:text-gray-800"
              }`}
            >
              <i className="fas fa-th-large"></i>
            </button>
          </div>
        </div>
      </div>

      {/* Logements Grid/List */}
      <div
        className={`${
          viewMode === "list"
            ? "space-y-4"
            : viewMode === "grid-big"
            ? "grid grid-cols-1 lg:grid-cols-2 gap-6"
            : "grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4"
        }`}
      >
        {filteredLogements.length === 0 ? (
          <div className="col-span-full text-center py-12">
            <i className="fas fa-home text-4xl text-gray-400 mb-4"></i>
            <p className="text-gray-500 text-lg">Aucun logement trouvé</p>
            <p className="text-gray-400 text-sm">
              Essayez de modifier vos filtres de recherche
            </p>
          </div>
        ) : (
          filteredLogements.map((logement) => (
            <LogementCard
              key={logement.infosLogement.Logement.PkLogement}
              logement={logement}
              isGestionMode={isGestionMode}
              showChgtOccupant={showChgtOccupant}
            />
          ))
        )}
      </div>
    </div>
  );
};

export default LogementList;
