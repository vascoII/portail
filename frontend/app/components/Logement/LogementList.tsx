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
}

const LogementList: React.FC<LogementListProps> = ({
  logements,
  filters,
  isGestionMode = false,
  showChgtOccupant = false,
  loading = false,
  error = null,
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

  if (loading) {
    return (
      <div className="flex justify-center items-center py-12">
        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-green-600"></div>
      </div>
    );
  }

  if (error) {
    return (
      <div className="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded">
        <p className="font-bold">Erreur</p>
        <p>{error}</p>
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
