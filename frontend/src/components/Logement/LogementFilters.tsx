"use client";

import React, { useState, useEffect } from "react";

interface LogementFiltersProps {
  onFiltersChange: (filters: FilterState) => void;
  initialFilters?: FilterState;
  filters?: {
    batiment: string[];
    escalier: string[];
    etage: string[];
  };
  isGestionMode?: boolean;
  immeubleId?: number;
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

const LogementFilters: React.FC<LogementFiltersProps> = ({
  onFiltersChange,
  initialFilters = {
    energie: "",
    fuites: false,
    anomalies: false,
    dysfonctionnements: false,
    depannages: false,
    reference: "",
    location: "",
    batiment: "",
    escalier: "",
    etage: "",
  },
  filters = { batiment: [], escalier: [], etage: [] },
  isGestionMode = false,
  immeubleId,
}) => {
  const [filterState, setFilterState] = useState<FilterState>(initialFilters);

  useEffect(() => {
    onFiltersChange(filterState);
  }, [filterState, onFiltersChange]);

  const handleFilterChange = (
    key: keyof FilterState,
    value: string | boolean
  ) => {
    setFilterState((prev) => ({
      ...prev,
      [key]: value,
    }));
  };

  return (
    <div className="space-y-6">
      {/* Building Info */}
      {immeubleId && (
        <div className="bg-blue-50 border border-blue-200 rounded-lg p-4">
          <div className="text-sm font-medium text-blue-800">
            Immeuble {immeubleId} - Filtrage des logements
          </div>
        </div>
      )}

      {/* Energy and Alert Filters */}
      {!isGestionMode && (
        <div className="bg-white rounded-lg shadow-md p-6">
          <h3 className="text-lg font-semibold text-gray-800 mb-4">
            Filtré par :
          </h3>

          <form className="space-y-4">
            <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
              {/* Energy Type Filter */}
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">
                  Type d'énergie
                </label>
                <select
                  value={filterState.energie}
                  onChange={(e) =>
                    handleFilterChange("energie", e.target.value)
                  }
                  className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  <option value="">Toutes les énergies</option>
                  <option value="energieef">Eau froide</option>
                  <option value="energieec">Eau chaude</option>
                  <option value="energierepart">Répartiteur</option>
                  <option value="energiecet">
                    Compteur d'énergie thermique
                  </option>
                  <option value="energieelect">Electricité</option>
                  <option value="energiegaz">Gaz</option>
                </select>
              </div>

              {/* Alert Filters */}
              <div className="space-y-2">
                <label className="block text-sm font-medium text-gray-700">
                  Alertes
                </label>
                <div className="space-y-2">
                  <label className="flex items-center">
                    <input
                      type="checkbox"
                      checked={filterState.fuites}
                      onChange={(e) =>
                        handleFilterChange("fuites", e.target.checked)
                      }
                      className="mr-2"
                    />
                    <span className="text-sm">Fuites</span>
                  </label>
                  <label className="flex items-center">
                    <input
                      type="checkbox"
                      checked={filterState.anomalies}
                      onChange={(e) =>
                        handleFilterChange("anomalies", e.target.checked)
                      }
                      className="mr-2"
                    />
                    <span className="text-sm">Anomalies</span>
                  </label>
                  <label className="flex items-center">
                    <input
                      type="checkbox"
                      checked={filterState.dysfonctionnements}
                      onChange={(e) =>
                        handleFilterChange(
                          "dysfonctionnements",
                          e.target.checked
                        )
                      }
                      className="mr-2"
                    />
                    <span className="text-sm">Alarmes techniques</span>
                  </label>
                  <label className="flex items-center">
                    <input
                      type="checkbox"
                      checked={filterState.depannages}
                      onChange={(e) =>
                        handleFilterChange("depannages", e.target.checked)
                      }
                      className="mr-2"
                    />
                    <span className="text-sm">Dépannages en cours</span>
                  </label>
                </div>
              </div>

              {/* Search Filters */}
              <div className="space-y-2">
                <label className="block text-sm font-medium text-gray-700">
                  Recherche
                </label>
                <div className="space-y-2">
                  <input
                    type="text"
                    placeholder="Référence / Numéro"
                    value={filterState.reference}
                    onChange={(e) =>
                      handleFilterChange("reference", e.target.value)
                    }
                    className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                  />
                  <input
                    type="text"
                    placeholder="Code postal / Ville"
                    value={filterState.location}
                    onChange={(e) =>
                      handleFilterChange("location", e.target.value)
                    }
                    className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                  />
                </div>
              </div>
            </div>
          </form>
        </div>
      )}

      {/* Building/Floor/Stair Filters */}
      <div className="bg-white rounded-lg shadow-md p-6">
        <div className="grid grid-cols-1 md:grid-cols-3 gap-4">
          {/* Building Filter */}
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-2">
              Bâtiment
            </label>
            <select
              value={filterState.batiment}
              onChange={(e) => handleFilterChange("batiment", e.target.value)}
              className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <option value="">Aucun</option>
              {filters.batiment.map((batiment) => (
                <option key={batiment} value={batiment}>
                  Bâtiment {batiment}
                </option>
              ))}
            </select>
          </div>

          {/* Stair Filter */}
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-2">
              Escalier
            </label>
            <select
              value={filterState.escalier}
              onChange={(e) => handleFilterChange("escalier", e.target.value)}
              className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <option value="">Aucun</option>
              {filters.escalier.map((escalier) => (
                <option key={escalier} value={escalier}>
                  Escalier {escalier}
                </option>
              ))}
            </select>
          </div>

          {/* Floor Filter */}
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-2">
              Étage
            </label>
            <select
              value={filterState.etage}
              onChange={(e) => handleFilterChange("etage", e.target.value)}
              className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <option value="">Aucun</option>
              {filters.etage.map((etage) => (
                <option key={etage} value={etage}>
                  Étage {etage}
                </option>
              ))}
            </select>
          </div>
        </div>

        {/* Export Button */}
        {!isGestionMode && immeubleId && (
          <div className="mt-4 flex justify-end">
            <a
              href={`/pages/logements/export/${immeubleId}`}
              target="_blank"
              className="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center"
            >
              <i className="fas fa-file-excel mr-2"></i>
              Export Excel
            </a>
          </div>
        )}
      </div>
    </div>
  );
};

export default LogementFilters;
