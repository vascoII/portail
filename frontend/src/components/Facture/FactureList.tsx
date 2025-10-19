"use client";

import React, { useState, useMemo } from "react";
import FactureCard from "./FactureCard";

interface Facture {
  PKFacture: number;
  NumFacture: string;
  CodeGestio: string;
  Adresse: string;
  Ville: string;
  CP: string;
  DateEdition: string;
  MontantTotalHT: number;
  MontantTotalTTC: number;
  MontantTotalAPayer: number;
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

interface FactureListProps {
  factures: Facture[];
  filters: FilterState;
  loading?: boolean;
  error?: string | null;
}

const FactureList: React.FC<FactureListProps> = ({
  factures,
  filters,
  loading = false,
  error = null,
}) => {
  const [viewMode, setViewMode] = useState<"grid" | "table">("grid");
  const [sortBy, setSortBy] = useState<keyof Facture>("DateEdition");
  const [sortOrder, setSortOrder] = useState<"asc" | "desc">("desc");

  const filteredAndSortedFactures = useMemo(() => {
    let filtered = factures.filter((facture) => {
      // Search filter
      if (filters.search) {
        const searchLower = filters.search.toLowerCase();
        const matchesSearch =
          facture.NumFacture.toLowerCase().includes(searchLower) ||
          facture.Adresse.toLowerCase().includes(searchLower) ||
          facture.Ville.toLowerCase().includes(searchLower) ||
          facture.CodeGestio.toLowerCase().includes(searchLower);

        if (!matchesSearch) return false;
      }

      // Date filters
      if (filters.dateFrom) {
        const factureDate = new Date(facture.DateEdition);
        const fromDate = new Date(filters.dateFrom);
        if (factureDate < fromDate) return false;
      }

      if (filters.dateTo) {
        const factureDate = new Date(facture.DateEdition);
        const toDate = new Date(filters.dateTo);
        if (factureDate > toDate) return false;
      }

      // Amount filters
      if (filters.amountFrom) {
        const minAmount = parseFloat(filters.amountFrom);
        if (facture.MontantTotalAPayer < minAmount) return false;
      }

      if (filters.amountTo) {
        const maxAmount = parseFloat(filters.amountTo);
        if (facture.MontantTotalAPayer > maxAmount) return false;
      }

      // Code gestionnaire filter
      if (filters.codeGestio) {
        if (
          !facture.CodeGestio.toLowerCase().includes(
            filters.codeGestio.toLowerCase()
          )
        ) {
          return false;
        }
      }

      // Ville filter
      if (filters.ville) {
        if (
          !facture.Ville.toLowerCase().includes(filters.ville.toLowerCase())
        ) {
          return false;
        }
      }

      return true;
    });

    // Sort
    filtered.sort((a, b) => {
      let aValue = a[sortBy];
      let bValue = b[sortBy];

      if (sortBy === "DateEdition") {
        aValue = new Date(aValue as string).getTime();
        bValue = new Date(bValue as string).getTime();
      }

      if (sortOrder === "asc") {
        return aValue < bValue ? -1 : aValue > bValue ? 1 : 0;
      } else {
        return aValue > bValue ? -1 : aValue < bValue ? 1 : 0;
      }
    });

    return filtered;
  }, [factures, filters, sortBy, sortOrder]);

  const handleSort = (field: keyof Facture) => {
    if (sortBy === field) {
      setSortOrder(sortOrder === "asc" ? "desc" : "asc");
    } else {
      setSortBy(field);
      setSortOrder("asc");
    }
  };

  const getSortIcon = (field: keyof Facture) => {
    if (sortBy !== field) return "fas fa-sort text-gray-400";
    return sortOrder === "asc"
      ? "fas fa-sort-up text-blue-600"
      : "fas fa-sort-down text-blue-600";
  };

  if (loading) {
    return (
      <div className="flex justify-center items-center py-12">
        <div className="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600"></div>
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
          <span className="text-blue-600">
            {filteredAndSortedFactures.length}
          </span>{" "}
          Factures
        </h2>

        {/* View Mode Toggle */}
        <div className="flex items-center space-x-4 mt-4 sm:mt-0">
          <div className="flex items-center space-x-2">
            <label className="text-sm font-medium text-gray-700">
              Trier par :
            </label>
            <select
              value={sortBy}
              onChange={(e) => setSortBy(e.target.value as keyof Facture)}
              className="px-3 py-1 border border-gray-300 rounded text-sm focus:outline-none focus:ring-2 focus:ring-blue-500"
            >
              <option value="DateEdition">Date d'émission</option>
              <option value="NumFacture">Numéro de facture</option>
              <option value="MontantTotalAPayer">Montant à payer</option>
              <option value="Ville">Ville</option>
            </select>
            <button
              onClick={() => setSortOrder(sortOrder === "asc" ? "desc" : "asc")}
              className="p-1 text-gray-500 hover:text-gray-700"
            >
              <i className={getSortIcon(sortBy)}></i>
            </button>
          </div>

          <div className="flex items-center space-x-2">
            <label className="text-sm font-medium text-gray-700">
              Affichage :
            </label>
            <div className="flex bg-gray-100 rounded-lg p-1">
              <button
                onClick={() => setViewMode("grid")}
                className={`px-3 py-1 rounded text-sm transition-colors duration-200 ${
                  viewMode === "grid"
                    ? "bg-white text-blue-600 shadow-sm"
                    : "text-gray-600 hover:text-gray-800"
                }`}
              >
                <i className="fas fa-th"></i>
              </button>
              <button
                onClick={() => setViewMode("table")}
                className={`px-3 py-1 rounded text-sm transition-colors duration-200 ${
                  viewMode === "table"
                    ? "bg-white text-blue-600 shadow-sm"
                    : "text-gray-600 hover:text-gray-800"
                }`}
              >
                <i className="fas fa-list"></i>
              </button>
            </div>
          </div>
        </div>
      </div>

      {/* Factures Display */}
      {filteredAndSortedFactures.length === 0 ? (
        <div className="text-center py-12">
          <i className="fas fa-file-invoice text-4xl text-gray-400 mb-4"></i>
          <p className="text-gray-500 text-lg">Aucune facture trouvée</p>
          <p className="text-gray-400 text-sm">
            Essayez de modifier vos filtres de recherche
          </p>
        </div>
      ) : viewMode === "grid" ? (
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {filteredAndSortedFactures.map((facture) => (
            <FactureCard key={facture.PKFacture} facture={facture} />
          ))}
        </div>
      ) : (
        <div className="bg-white rounded-lg shadow-md overflow-hidden">
          <div className="overflow-x-auto">
            <table className="min-w-full divide-y divide-gray-200">
              <thead className="bg-gray-50">
                <tr>
                  <th
                    className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100"
                    onClick={() => handleSort("NumFacture")}
                  >
                    <div className="flex items-center space-x-1">
                      <span>Numéro</span>
                      <i className={getSortIcon("NumFacture")}></i>
                    </div>
                  </th>
                  <th
                    className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100"
                    onClick={() => handleSort("CodeGestio")}
                  >
                    <div className="flex items-center space-x-1">
                      <span>Code gestionnaire</span>
                      <i className={getSortIcon("CodeGestio")}></i>
                    </div>
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Adresse
                  </th>
                  <th
                    className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100"
                    onClick={() => handleSort("DateEdition")}
                  >
                    <div className="flex items-center space-x-1">
                      <span>Date d'émission</span>
                      <i className={getSortIcon("DateEdition")}></i>
                    </div>
                  </th>
                  <th
                    className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer hover:bg-gray-100"
                    onClick={() => handleSort("MontantTotalAPayer")}
                  >
                    <div className="flex items-center space-x-1">
                      <span>Montant à payer</span>
                      <i className={getSortIcon("MontantTotalAPayer")}></i>
                    </div>
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody className="bg-white divide-y divide-gray-200">
                {filteredAndSortedFactures.map((facture) => (
                  <tr key={facture.PKFacture} className="hover:bg-gray-50">
                    <td className="px-6 py-4 whitespace-nowrap">
                      <div className="text-sm font-medium text-gray-900">
                        {facture.NumFacture}
                      </div>
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap">
                      <div className="text-sm text-gray-900">
                        {facture.CodeGestio}
                      </div>
                    </td>
                    <td className="px-6 py-4">
                      <div className="text-sm text-gray-900">
                        {facture.Adresse}
                      </div>
                      <div className="text-sm text-gray-500">
                        {facture.CP} {facture.Ville}
                      </div>
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap">
                      <div className="text-sm text-gray-900">
                        {new Date(facture.DateEdition).toLocaleDateString(
                          "fr-FR"
                        )}
                      </div>
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap">
                      <div className="text-sm font-medium text-gray-900">
                        {new Intl.NumberFormat("fr-FR", {
                          style: "currency",
                          currency: "EUR",
                        }).format(facture.MontantTotalAPayer)}
                      </div>
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                      <a
                        href={`/pages/factures/download/${facture.PKFacture}`}
                        target="_blank"
                        className="text-blue-600 hover:text-blue-900 transition-colors duration-200"
                      >
                        <i className="fas fa-download mr-1"></i>
                        Télécharger
                      </a>
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      )}
    </div>
  );
};

export default FactureList;
