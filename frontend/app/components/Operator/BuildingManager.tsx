"use client";

import React, { useState, useMemo } from "react";

interface Building {
  PkImmeuble: number;
  Ref: string;
  Numero: string;
  Adresse1: string;
  Cp: string;
  Ville: string;
}

interface BuildingManagerProps {
  buildings: Building[];
  type: "assigned" | "available";
  onAction?: (buildingIds: number[]) => Promise<void>;
  actionLabel: string;
  actionIcon: string;
  actionColor: string;
}

const BuildingManager: React.FC<BuildingManagerProps> = ({
  buildings,
  type,
  onAction,
  actionLabel,
  actionIcon,
  actionColor,
}) => {
  const [searchTerm, setSearchTerm] = useState("");
  const [selectedBuildings, setSelectedBuildings] = useState<number[]>([]);
  const [isLoading, setIsLoading] = useState(false);

  const filteredBuildings = useMemo(() => {
    if (!searchTerm) return buildings;

    return buildings.filter((building) => {
      const searchLower = searchTerm.toLowerCase();
      return (
        building.Ref.toLowerCase().includes(searchLower) ||
        building.Numero.toLowerCase().includes(searchLower) ||
        building.Adresse1.toLowerCase().includes(searchLower) ||
        building.Cp.toLowerCase().includes(searchLower) ||
        building.Ville.toLowerCase().includes(searchLower)
      );
    });
  }, [buildings, searchTerm]);

  const handleSelectBuilding = (buildingId: number) => {
    setSelectedBuildings((prev) => {
      if (prev.includes(buildingId)) {
        return prev.filter((id) => id !== buildingId);
      } else {
        return [...prev, buildingId];
      }
    });
  };

  const handleSelectAll = () => {
    if (selectedBuildings.length === filteredBuildings.length) {
      setSelectedBuildings([]);
    } else {
      setSelectedBuildings(filteredBuildings.map((b) => b.PkImmeuble));
    }
  };

  const handleAction = async () => {
    if (!onAction || selectedBuildings.length === 0) return;

    setIsLoading(true);
    try {
      await onAction(selectedBuildings);
      setSelectedBuildings([]);
    } catch (error) {
      console.error("Error performing action:", error);
    } finally {
      setIsLoading(false);
    }
  };

  const handleActionAll = async () => {
    if (!onAction || filteredBuildings.length === 0) return;

    setIsLoading(true);
    try {
      await onAction(filteredBuildings.map((b) => b.PkImmeuble));
      setSelectedBuildings([]);
    } catch (error) {
      console.error("Error performing action:", error);
    } finally {
      setIsLoading(false);
    }
  };

  if (buildings.length === 0) {
    return (
      <div className="text-center py-8">
        <i className="fas fa-building text-4xl text-gray-400 mb-4"></i>
        <p className="text-gray-500">
          {type === "assigned"
            ? "Aucun immeuble assigné"
            : "Aucun immeuble disponible"}
        </p>
      </div>
    );
  }

  return (
    <div className="space-y-4">
      {/* Search and Actions */}
      <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div className="flex-1">
          <input
            type="text"
            placeholder="Rechercher un immeuble..."
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
            className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
          />
        </div>
        <div className="flex space-x-2">
          <button
            onClick={handleSelectAll}
            className="px-3 py-2 bg-gray-100 text-gray-700 rounded-md hover:bg-gray-200 transition-colors duration-200 text-sm"
          >
            {selectedBuildings.length === filteredBuildings.length
              ? "Tout désélectionner"
              : "Tout sélectionner"}
          </button>
          <button
            onClick={handleActionAll}
            disabled={isLoading || filteredBuildings.length === 0}
            className={`px-4 py-2 text-white rounded-md transition-colors duration-200 text-sm ${actionColor} ${
              isLoading || filteredBuildings.length === 0
                ? "opacity-50 cursor-not-allowed"
                : ""
            }`}
          >
            {isLoading ? (
              <div className="animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-2"></div>
            ) : (
              <i className={`${actionIcon} mr-2`}></i>
            )}
            {actionLabel} tout
          </button>
        </div>
      </div>

      {/* Building List */}
      <div className="space-y-2 max-h-96 overflow-y-auto">
        {filteredBuildings.map((building) => (
          <div
            key={building.PkImmeuble}
            className={`p-4 border rounded-lg transition-colors duration-200 ${
              selectedBuildings.includes(building.PkImmeuble)
                ? "border-blue-500 bg-blue-50"
                : "border-gray-200 hover:border-gray-300"
            }`}
          >
            <div className="flex items-center space-x-3">
              <input
                type="checkbox"
                checked={selectedBuildings.includes(building.PkImmeuble)}
                onChange={() => handleSelectBuilding(building.PkImmeuble)}
                className="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
              />
              <div className="flex-1">
                <div className="flex items-center justify-between">
                  <div>
                    <div className="font-medium text-gray-900">
                      {building.Ref} - {building.Numero}
                    </div>
                    <div className="text-sm text-gray-600">
                      {building.Adresse1}
                    </div>
                    <div className="text-sm text-gray-500">
                      {building.Cp} {building.Ville}
                    </div>
                  </div>
                  <button
                    onClick={() => handleSelectBuilding(building.PkImmeuble)}
                    disabled={isLoading}
                    className={`px-3 py-1 text-white rounded text-sm transition-colors duration-200 ${actionColor} ${
                      isLoading ? "opacity-50 cursor-not-allowed" : ""
                    }`}
                  >
                    <i className={`${actionIcon} mr-1`}></i>
                    {actionLabel}
                  </button>
                </div>
              </div>
            </div>
          </div>
        ))}
      </div>

      {/* Selected Actions */}
      {selectedBuildings.length > 0 && (
        <div className="bg-blue-50 border border-blue-200 rounded-lg p-4">
          <div className="flex items-center justify-between">
            <div className="text-sm text-blue-800">
              {selectedBuildings.length} immeuble(s) sélectionné(s)
            </div>
            <button
              onClick={handleAction}
              disabled={isLoading}
              className={`px-4 py-2 text-white rounded-md transition-colors duration-200 ${actionColor} ${
                isLoading ? "opacity-50 cursor-not-allowed" : ""
              }`}
            >
              {isLoading ? (
                <div className="animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-2"></div>
              ) : (
                <i className={`${actionIcon} mr-2`}></i>
              )}
              {actionLabel} sélectionné(s)
            </button>
          </div>
        </div>
      )}
    </div>
  );
};

export default BuildingManager;
