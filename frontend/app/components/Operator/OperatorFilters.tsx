"use client";

import React, { useState, useEffect } from "react";

interface OperatorFiltersProps {
  onFiltersChange: (filters: FilterState) => void;
  initialFilters?: FilterState;
}

interface FilterState {
  search: string;
}

const OperatorFilters: React.FC<OperatorFiltersProps> = ({
  onFiltersChange,
  initialFilters = {
    search: "",
  },
}) => {
  const [filterState, setFilterState] = useState<FilterState>(initialFilters);

  useEffect(() => {
    onFiltersChange(filterState);
  }, [filterState, onFiltersChange]);

  const handleFilterChange = (key: keyof FilterState, value: string) => {
    setFilterState((prev) => ({
      ...prev,
      [key]: value,
    }));
  };

  const clearFilters = () => {
    setFilterState({
      search: "",
    });
  };

  return (
    <div className="bg-white rounded-lg shadow-md p-6 mb-6">
      <div className="flex items-center justify-between mb-4">
        <h3 className="text-lg font-semibold text-gray-800">
          Filtres de recherche
        </h3>
        <button
          onClick={clearFilters}
          className="text-sm text-blue-600 hover:text-blue-800 transition-colors duration-200"
        >
          Effacer les filtres
        </button>
      </div>

      <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        {/* Search */}
        <div className="flex-1">
          <input
            type="text"
            placeholder="Recherche par nom d'utilisateur..."
            value={filterState.search}
            onChange={(e) => handleFilterChange("search", e.target.value)}
            className="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        {/* Quick Filter Buttons */}
        <div className="flex flex-wrap gap-2">
          <button
            onClick={() => {
              setFilterState((prev) => ({
                ...prev,
                search: "",
              }));
            }}
            className="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg text-sm hover:bg-gray-200 transition-colors duration-200"
          >
            Tous les gestionnaires
          </button>
          <button
            onClick={() => {
              setFilterState((prev) => ({
                ...prev,
                search: "admin",
              }));
            }}
            className="px-4 py-2 bg-blue-100 text-blue-700 rounded-lg text-sm hover:bg-blue-200 transition-colors duration-200"
          >
            Administrateurs
          </button>
          <button
            onClick={() => {
              setFilterState((prev) => ({
                ...prev,
                search: "gestion",
              }));
            }}
            className="px-4 py-2 bg-green-100 text-green-700 rounded-lg text-sm hover:bg-green-200 transition-colors duration-200"
          >
            Gestionnaires
          </button>
        </div>
      </div>
    </div>
  );
};

export default OperatorFilters;
