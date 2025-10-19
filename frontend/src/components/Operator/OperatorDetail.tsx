"use client";

import React, { useState } from "react";
import Link from "next/link";
import BuildingManager from "./BuildingManager";

interface OperatorDetailProps {
  operator: {
    PKUser: number;
    UserName: string;
    FirstName?: string;
    LastName?: string;
    EMail?: string;
    Phone?: string;
    Job?: string;
    Adresse?: string;
    Cp?: string;
    Ville?: string;
  };
  assignedBuildings: Array<{
    PkImmeuble: number;
    Ref: string;
    Numero: string;
    Adresse1: string;
    Cp: string;
    Ville: string;
  }>;
  availableBuildings: Array<{
    PkImmeuble: number;
    Ref: string;
    Numero: string;
    Adresse1: string;
    Cp: string;
    Ville: string;
  }>;
  onAddBuildings?: (buildingIds: number[]) => Promise<void>;
  onRemoveBuildings?: (buildingIds: number[]) => Promise<void>;
}

const OperatorDetail: React.FC<OperatorDetailProps> = ({
  operator,
  assignedBuildings,
  availableBuildings,
  onAddBuildings,
  onRemoveBuildings,
}) => {
  const [isEditing, setIsEditing] = useState(false);

  const getDisplayName = () => {
    if (operator.FirstName && operator.LastName) {
      return `${operator.FirstName} ${operator.LastName}`;
    }
    return operator.UserName;
  };

  const getJobTitle = () => {
    if (operator.Job) {
      return operator.Job;
    }
    return "Gestionnaire";
  };

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="bg-white rounded-lg shadow-md p-6">
        <div className="flex items-start justify-between mb-6">
          <div className="flex items-center space-x-4">
            <div className="w-20 h-20 bg-blue-100 rounded-lg flex items-center justify-center">
              <i className="fas fa-user text-blue-600 text-3xl"></i>
            </div>
            <div>
              <h1 className="text-3xl font-bold text-gray-800">
                {getDisplayName()}
              </h1>
              <p className="text-lg text-gray-600">{getJobTitle()}</p>
              <p className="text-sm text-gray-500">@{operator.UserName}</p>
            </div>
          </div>

          <div className="flex space-x-3">
            <button
              onClick={() => setIsEditing(!isEditing)}
              className="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center"
            >
              <i className="fas fa-edit mr-2"></i>
              {isEditing ? "Annuler" : "Modifier"}
            </button>
            <Link
              href={`/pages/operators/${operator.PKUser}/password`}
              className="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center"
            >
              <i className="fas fa-key mr-2"></i>
              Mot de passe
            </Link>
          </div>
        </div>

        {/* Contact Information */}
        <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
          <div>
            <h3 className="text-lg font-semibold text-gray-800 mb-4">
              Informations de contact
            </h3>
            <div className="space-y-3">
              {operator.EMail && (
                <div className="flex items-center space-x-3">
                  <i className="fas fa-envelope text-gray-400"></i>
                  <a
                    href={`mailto:${operator.EMail}`}
                    className="text-blue-600 hover:text-blue-800 transition-colors duration-200"
                  >
                    {operator.EMail}
                  </a>
                </div>
              )}

              {operator.Phone && (
                <div className="flex items-center space-x-3">
                  <i className="fas fa-phone text-gray-400"></i>
                  <a
                    href={`tel:${operator.Phone}`}
                    className="text-blue-600 hover:text-blue-800 transition-colors duration-200"
                  >
                    {operator.Phone}
                  </a>
                </div>
              )}
            </div>
          </div>

          <div>
            <h3 className="text-lg font-semibold text-gray-800 mb-4">
              Adresse
            </h3>
            <div className="space-y-2">
              {operator.Adresse && (
                <div className="flex items-start space-x-3">
                  <i className="fas fa-map-marker-alt text-gray-400 mt-1"></i>
                  <div className="text-gray-600">{operator.Adresse}</div>
                </div>
              )}
              {(operator.Cp || operator.Ville) && (
                <div className="flex items-start space-x-3">
                  <i className="fas fa-city text-gray-400 mt-1"></i>
                  <div className="text-gray-600">
                    {operator.Cp} {operator.Ville}
                  </div>
                </div>
              )}
            </div>
          </div>
        </div>
      </div>

      {/* Building Management */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Assigned Buildings */}
        <div className="bg-white rounded-lg shadow-md">
          <div className="p-6 border-b border-gray-200">
            <div className="flex items-center justify-between">
              <h3 className="text-lg font-semibold text-gray-800">
                <span className="text-blue-600">
                  {assignedBuildings.length}
                </span>{" "}
                Immeubles gérés
              </h3>
            </div>
          </div>
          <div className="p-6">
            <BuildingManager
              buildings={assignedBuildings}
              type="assigned"
              onAction={onRemoveBuildings}
              actionLabel="Retirer"
              actionIcon="fas fa-minus"
              actionColor="bg-red-600 hover:bg-red-700"
            />
          </div>
        </div>

        {/* Available Buildings */}
        <div className="bg-white rounded-lg shadow-md">
          <div className="p-6 border-b border-gray-200">
            <div className="flex items-center justify-between">
              <h3 className="text-lg font-semibold text-gray-800">
                <span className="text-green-600">
                  {availableBuildings.length}
                </span>{" "}
                Immeubles disponibles
              </h3>
            </div>
          </div>
          <div className="p-6">
            <BuildingManager
              buildings={availableBuildings}
              type="available"
              onAction={onAddBuildings}
              actionLabel="Ajouter"
              actionIcon="fas fa-plus"
              actionColor="bg-green-600 hover:bg-green-700"
            />
          </div>
        </div>
      </div>

      {/* Statistics */}
      <div className="bg-white rounded-lg shadow-md p-6">
        <h3 className="text-lg font-semibold text-gray-800 mb-4">
          Statistiques
        </h3>
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div className="text-center">
            <div className="text-3xl font-bold text-blue-600">
              {assignedBuildings.length}
            </div>
            <div className="text-sm text-gray-600">Immeubles gérés</div>
          </div>
          <div className="text-center">
            <div className="text-3xl font-bold text-green-600">
              {availableBuildings.length}
            </div>
            <div className="text-sm text-gray-600">Immeubles disponibles</div>
          </div>
          <div className="text-center">
            <div className="text-3xl font-bold text-purple-600">
              {assignedBuildings.length + availableBuildings.length}
            </div>
            <div className="text-sm text-gray-600">Total immeubles</div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default OperatorDetail;
