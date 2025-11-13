"use client";

import React, { useState, useEffect } from "react";

interface ImmeubleFiltersProps {
  onFiltersChange: (filters: FilterState) => void;
  initialFilters?: FilterState;
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

const ImmeubleFilters: React.FC<ImmeubleFiltersProps> = ({
  onFiltersChange,
  initialFilters = {
    energie: "",
    fuites: false,
    anomalies: false,
    dysfonctionnements: false,
    depannages: false,
    chantiers: false,
    reference: "",
    location: "",
  },
}) => {
  const [filters, setFilters] = useState<FilterState>(initialFilters);

  useEffect(() => {
    onFiltersChange(filters);
  }, [filters, onFiltersChange]);

  const handleFilterChange = (
    key: keyof FilterState,
    value: string | boolean
  ) => {
    setFilters((prev) => ({
      ...prev,
      [key]: value,
    }));
  };

  return (
    <div
      className="rounded-lg p-6 mb-6"
      style={{
        backgroundColor: "#606060", // Vert Techem (success color)
        color: "#ffffff",
      }}
    >
      <form>
        <div className="flex flex-wrap items-start gap-6">
          {/* Left: Label and Energy Filter */}
          <div className="flex items-center gap-4">
            <h3 className="text-lg font-semibold text-white whitespace-nowrap">
              Filtré par :
            </h3>
            <select
              value={filters.energie}
              onChange={(e) => handleFilterChange("energie", e.target.value)}
              className="px-3 py-2 bg-white text-gray-900 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-green-600 min-w-[180px]"
              style={{
                backgroundColor: "#ffffff",
                color: "#333333",
              }}
            >
              <option value="">Toutes les énergies</option>
              <option value="energieef">Eau froide</option>
              <option value="energieec">Eau chaude</option>
              <option value="energiecet">
                Compteur d&apos;énergie thermique
              </option>
              <option value="energierepart">Répartiteur</option>
              <option value="energieelect">Electricité</option>
              <option value="energiegaz">Gaz</option>
            </select>
          </div>

          {/* Middle: Alert Filters - Two Columns */}
          <div className="flex gap-6">
            {/* First Column: Alertes */}
            <div className="space-y-2">
              <div className="space-y-2">
                <label className="flex items-center text-white cursor-pointer">
                  <input
                    type="checkbox"
                    checked={filters.fuites}
                    onChange={(e) =>
                      handleFilterChange("fuites", e.target.checked)
                    }
                    className="mr-2 w-4 h-4 text-green-600 bg-white border-gray-300 rounded focus:ring-2 focus:ring-white"
                    style={{
                      accentColor: "#ffffff",
                    }}
                  />
                  <span className="text-sm text-white">Fuites</span>
                </label>
                <label className="flex items-center text-white cursor-pointer">
                  <input
                    type="checkbox"
                    checked={filters.anomalies}
                    onChange={(e) =>
                      handleFilterChange("anomalies", e.target.checked)
                    }
                    className="mr-2 w-4 h-4 text-green-600 bg-white border-gray-300 rounded focus:ring-2 focus:ring-white"
                    style={{
                      accentColor: "#ffffff",
                    }}
                  />
                  <span className="text-sm text-white">Anomalies</span>
                </label>
                <label className="flex items-center text-white cursor-pointer">
                  <input
                    type="checkbox"
                    checked={filters.dysfonctionnements}
                    onChange={(e) =>
                      handleFilterChange("dysfonctionnements", e.target.checked)
                    }
                    className="mr-2 w-4 h-4 text-green-600 bg-white border-gray-300 rounded focus:ring-2 focus:ring-white"
                    style={{
                      accentColor: "#ffffff",
                    }}
                  />
                  <span className="text-sm text-white">Alarmes techniques</span>
                </label>
              </div>
            </div>

            {/* Second Column: Statut */}
            <div className="space-y-2">
              <div className="space-y-2">
                <label className="flex items-center text-white cursor-pointer">
                  <input
                    type="checkbox"
                    checked={filters.depannages}
                    onChange={(e) =>
                      handleFilterChange("depannages", e.target.checked)
                    }
                    className="mr-2 w-4 h-4 text-green-600 bg-white border-gray-300 rounded focus:ring-2 focus:ring-white"
                    style={{
                      accentColor: "#ffffff",
                    }}
                  />
                  <span className="text-sm text-white">
                    Dépannages en cours
                  </span>
                </label>
                <label className="flex items-center text-white cursor-pointer">
                  <input
                    type="checkbox"
                    checked={filters.chantiers}
                    onChange={(e) =>
                      handleFilterChange("chantiers", e.target.checked)
                    }
                    className="mr-2 w-4 h-4 text-green-600 bg-white border-gray-300 rounded focus:ring-2 focus:ring-white"
                    style={{
                      accentColor: "#ffffff",
                    }}
                  />
                  <span className="text-sm text-white">Chantiers en cours</span>
                </label>
              </div>
            </div>
          </div>

          {/* Right: Search Filters */}
          <div className="flex flex-col gap-2 ml-auto">
            <input
              type="text"
              placeholder="Référence"
              value={filters.reference}
              onChange={(e) => handleFilterChange("reference", e.target.value)}
              className="px-3 py-2 bg-white text-gray-900 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-green-600 placeholder-gray-500 min-w-[200px]"
              style={{
                backgroundColor: "#ffffff",
                color: "#333333",
              }}
            />
            <input
              type="text"
              placeholder="Code postal / Ville"
              value={filters.location}
              onChange={(e) => handleFilterChange("location", e.target.value)}
              className="px-3 py-2 bg-white text-gray-900 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-green-600 placeholder-gray-500 min-w-[200px]"
              style={{
                backgroundColor: "#ffffff",
                color: "#333333",
              }}
            />
          </div>
        </div>
      </form>
    </div>
  );
};

export default ImmeubleFilters;
