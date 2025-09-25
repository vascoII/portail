"use client";

import React, { useState, useEffect } from "react";

interface FactureFiltersProps {
  onFiltersChange: (filters: FilterState) => void;
  initialFilters?: FilterState;
}

interface FilterState {
  search: string;
  dateFrom: string;
  dateTo: string;
  amountFrom: string;
  amountTo: string;
  codeGestio: string;
  ville: string;
}

const FactureFilters: React.FC<FactureFiltersProps> = ({
  onFiltersChange,
  initialFilters = {
    search: "",
    dateFrom: "",
    dateTo: "",
    amountFrom: "",
    amountTo: "",
    codeGestio: "",
    ville: "",
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
      dateFrom: "",
      dateTo: "",
      amountFrom: "",
      amountTo: "",
      codeGestio: "",
      ville: "",
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
          Effacer tous les filtres
        </button>
      </div>

      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        {/* Search */}
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">
            Recherche générale
          </label>
          <input
            type="text"
            placeholder="Numéro, adresse, ville..."
            value={filterState.search}
            onChange={(e) => handleFilterChange("search", e.target.value)}
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        {/* Date Range */}
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">
            Date d'émission (du)
          </label>
          <input
            type="date"
            value={filterState.dateFrom}
            onChange={(e) => handleFilterChange("dateFrom", e.target.value)}
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">
            Date d'émission (au)
          </label>
          <input
            type="date"
            value={filterState.dateTo}
            onChange={(e) => handleFilterChange("dateTo", e.target.value)}
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        {/* Amount Range */}
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">
            Montant minimum (€)
          </label>
          <input
            type="number"
            placeholder="0.00"
            value={filterState.amountFrom}
            onChange={(e) => handleFilterChange("amountFrom", e.target.value)}
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">
            Montant maximum (€)
          </label>
          <input
            type="number"
            placeholder="999999.99"
            value={filterState.amountTo}
            onChange={(e) => handleFilterChange("amountTo", e.target.value)}
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        {/* Code Gestionnaire */}
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">
            Code gestionnaire
          </label>
          <input
            type="text"
            placeholder="Code gestionnaire"
            value={filterState.codeGestio}
            onChange={(e) => handleFilterChange("codeGestio", e.target.value)}
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>

        {/* Ville */}
        <div>
          <label className="block text-sm font-medium text-gray-700 mb-2">
            Ville
          </label>
          <input
            type="text"
            placeholder="Nom de la ville"
            value={filterState.ville}
            onChange={(e) => handleFilterChange("ville", e.target.value)}
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>
      </div>

      {/* Quick Filter Buttons */}
      <div className="mt-4 flex flex-wrap gap-2">
        <button
          onClick={() => {
            const today = new Date();
            const lastMonth = new Date(
              today.getFullYear(),
              today.getMonth() - 1,
              today.getDate()
            );
            setFilterState((prev) => ({
              ...prev,
              dateFrom: lastMonth.toISOString().split("T")[0],
              dateTo: today.toISOString().split("T")[0],
            }));
          }}
          className="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm hover:bg-blue-200 transition-colors duration-200"
        >
          Dernier mois
        </button>
        <button
          onClick={() => {
            const today = new Date();
            const last3Months = new Date(
              today.getFullYear(),
              today.getMonth() - 3,
              today.getDate()
            );
            setFilterState((prev) => ({
              ...prev,
              dateFrom: last3Months.toISOString().split("T")[0],
              dateTo: today.toISOString().split("T")[0],
            }));
          }}
          className="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm hover:bg-blue-200 transition-colors duration-200"
        >
          Derniers 3 mois
        </button>
        <button
          onClick={() => {
            setFilterState((prev) => ({
              ...prev,
              amountFrom: "1000",
              amountTo: "5000",
            }));
          }}
          className="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm hover:bg-green-200 transition-colors duration-200"
        >
          1000€ - 5000€
        </button>
        <button
          onClick={() => {
            setFilterState((prev) => ({
              ...prev,
              amountFrom: "5000",
              amountTo: "",
            }));
          }}
          className="px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm hover:bg-green-200 transition-colors duration-200"
        >
          Plus de 5000€
        </button>
      </div>
    </div>
  );
};

export default FactureFilters;
