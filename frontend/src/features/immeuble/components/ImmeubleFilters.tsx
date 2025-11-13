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
    <div className="bg-white rounded-lg shadow-md p-6 mb-6">
      <h3 className="text-lg font-semibold text-gray-800 mb-4">Filtré par :</h3>

      <form className="space-y-4">
        <div className="grid grid-cols-1 md:grid-cols-4 gap-4">
          {/* Energy Type Filter */}
          <div>
            <label className="block text-sm font-medium text-gray-700 mb-2">
              Type d'énergie
            </label>
            <select
              value={filters.energie}
              onChange={(e) => handleFilterChange("energie", e.target.value)}
              className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <option value="">Toutes les énergies</option>
              <option value="energieef">Eau froide</option>
              <option value="energieec">Eau chaude</option>
              <option value="energiecet">Compteur d'énergie thermique</option>
              <option value="energierepart">Répartiteur</option>
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
                  checked={filters.fuites}
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
                  checked={filters.anomalies}
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
                  checked={filters.dysfonctionnements}
                  onChange={(e) =>
                    handleFilterChange("dysfonctionnements", e.target.checked)
                  }
                  className="mr-2"
                />
                <span className="text-sm">Alarmes techniques</span>
              </label>
            </div>
          </div>

          {/* Status Filters */}
          <div className="space-y-2">
            <label className="block text-sm font-medium text-gray-700">
              Statut
            </label>
            <div className="space-y-2">
              <label className="flex items-center">
                <input
                  type="checkbox"
                  checked={filters.depannages}
                  onChange={(e) =>
                    handleFilterChange("depannages", e.target.checked)
                  }
                  className="mr-2"
                />
                <span className="text-sm">Dépannages en cours</span>
              </label>
              <label className="flex items-center">
                <input
                  type="checkbox"
                  checked={filters.chantiers}
                  onChange={(e) =>
                    handleFilterChange("chantiers", e.target.checked)
                  }
                  className="mr-2"
                />
                <span className="text-sm">Chantiers en cours</span>
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
                value={filters.reference}
                onChange={(e) =>
                  handleFilterChange("reference", e.target.value)
                }
                className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
              <input
                type="text"
                placeholder="Code postal / Ville"
                value={filters.location}
                onChange={(e) => handleFilterChange("location", e.target.value)}
                className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
          </div>
        </div>
      </form>
    </div>
  );
};

export default ImmeubleFilters;
