"use client";

import React, { useState, useMemo } from "react";
import OperatorCard from "./OperatorCard";

interface Operator {
  PKUser: number;
  UserName: string;
  FirstName?: string;
  LastName?: string;
  EMail?: string;
  Phone?: string;
  Job?: string;
  NbImmeubles: number;
  Adresse?: string;
  Cp?: string;
  Ville?: string;
}

interface FilterState {
  search: string;
}

interface OperatorListProps {
  operators: Operator[];
  filters: FilterState;
  loading?: boolean;
  error?: string | null;
  onDelete?: (id: number) => void;
}

const OperatorList: React.FC<OperatorListProps> = ({
  operators,
  filters,
  loading = false,
  error = null,
  onDelete,
}) => {
  const [viewMode, setViewMode] = useState<"grid" | "table">("grid");

  const filteredOperators = useMemo(() => {
    return operators.filter((operator) => {
      // Search filter
      if (filters.search) {
        const searchLower = filters.search.toLowerCase();
        const matchesSearch =
          operator.UserName.toLowerCase().includes(searchLower) ||
          (operator.FirstName &&
            operator.FirstName.toLowerCase().includes(searchLower)) ||
          (operator.LastName &&
            operator.LastName.toLowerCase().includes(searchLower)) ||
          (operator.EMail &&
            operator.EMail.toLowerCase().includes(searchLower)) ||
          (operator.Job && operator.Job.toLowerCase().includes(searchLower));

        if (!matchesSearch) return false;
      }

      return true;
    });
  }, [operators, filters]);

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
          <span className="text-blue-600">{filteredOperators.length}</span>{" "}
          Gestionnaires
        </h2>

        {/* View Mode Toggle */}
        <div className="flex items-center space-x-4 mt-4 sm:mt-0">
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

      {/* Operators Display */}
      {filteredOperators.length === 0 ? (
        <div className="text-center py-12">
          <i className="fas fa-users text-4xl text-gray-400 mb-4"></i>
          <p className="text-gray-500 text-lg">Aucun gestionnaire trouvé</p>
          <p className="text-gray-400 text-sm">
            Essayez de modifier vos filtres de recherche
          </p>
        </div>
      ) : viewMode === "grid" ? (
        <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          {filteredOperators.map((operator) => (
            <OperatorCard
              key={operator.PKUser}
              operator={operator}
              onDelete={onDelete}
            />
          ))}
        </div>
      ) : (
        <div className="bg-white rounded-lg shadow-md overflow-hidden">
          <div className="overflow-x-auto">
            <table className="min-w-full divide-y divide-gray-200">
              <thead className="bg-gray-50">
                <tr>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Gestionnaire
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Contact
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Poste
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Immeubles
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Actions
                  </th>
                </tr>
              </thead>
              <tbody className="bg-white divide-y divide-gray-200">
                {filteredOperators.map((operator) => (
                  <tr key={operator.PKUser} className="hover:bg-gray-50">
                    <td className="px-6 py-4 whitespace-nowrap">
                      <div className="flex items-center">
                        <div className="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                          <i className="fas fa-user text-blue-600"></i>
                        </div>
                        <div>
                          <div className="text-sm font-medium text-gray-900">
                            {operator.FirstName && operator.LastName
                              ? `${operator.FirstName} ${operator.LastName}`
                              : operator.UserName}
                          </div>
                          <div className="text-sm text-gray-500">
                            @{operator.UserName}
                          </div>
                        </div>
                      </div>
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap">
                      <div className="text-sm text-gray-900">
                        {operator.EMail || "N/A"}
                      </div>
                      <div className="text-sm text-gray-500">
                        {operator.Phone || "N/A"}
                      </div>
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap">
                      <div className="text-sm text-gray-900">
                        {operator.Job || "Gestionnaire"}
                      </div>
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap">
                      <div className="flex items-center">
                        <i className="fas fa-building text-blue-600 mr-2"></i>
                        <span className="text-sm font-medium text-gray-900">
                          {operator.NbImmeubles}
                        </span>
                      </div>
                    </td>
                    <td className="px-6 py-4 whitespace-nowrap text-sm font-medium">
                      <div className="flex space-x-2">
                        <a
                          href={`/pages/operators/${operator.PKUser}`}
                          className="text-blue-600 hover:text-blue-900 transition-colors duration-200"
                        >
                          <i className="fas fa-eye mr-1"></i>
                          Voir
                        </a>
                        <a
                          href={`/pages/operators/${operator.PKUser}/edit`}
                          className="text-green-600 hover:text-green-900 transition-colors duration-200"
                        >
                          <i className="fas fa-edit mr-1"></i>
                          Modifier
                        </a>
                        <button
                          onClick={() => onDelete?.(operator.PKUser)}
                          className="text-red-600 hover:text-red-900 transition-colors duration-200"
                        >
                          <i className="fas fa-trash mr-1"></i>
                          Supprimer
                        </button>
                      </div>
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

export default OperatorList;
