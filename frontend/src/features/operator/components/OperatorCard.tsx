"use client";

import React, { useState } from "react";
import Link from "next/link";

interface OperatorCardProps {
  operator: {
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
  };
  onDelete?: (id: number) => void;
}

const OperatorCard: React.FC<OperatorCardProps> = ({ operator, onDelete }) => {
  const [isDeleting, setIsDeleting] = useState(false);

  const handleDelete = async () => {
    if (!onDelete) return;

    const confirmed = window.confirm(
      "Êtes-vous sûr de vouloir supprimer ce gestionnaire ?"
    );

    if (confirmed) {
      setIsDeleting(true);
      try {
        await onDelete(operator.PKUser);
      } catch (error) {
        console.error("Error deleting operator:", error);
        alert("Erreur lors de la suppression");
      } finally {
        setIsDeleting(false);
      }
    }
  };

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
    <div className="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 border border-gray-200">
      <div className="p-6">
        {/* Header */}
        <div className="flex items-start justify-between mb-4">
          <div className="flex items-center space-x-4">
            <div className="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center">
              <i className="fas fa-user text-blue-600 text-2xl"></i>
            </div>
            <div>
              <h3 className="text-xl font-semibold text-gray-800">
                {getDisplayName()}
              </h3>
              <p className="text-sm text-gray-600">
                {getJobTitle()} • {operator.UserName}
              </p>
            </div>
          </div>

          {/* Actions */}
          <div className="flex space-x-2">
            <Link
              href={`/operators/${operator.PKUser}/edit`}
              className="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg transition-colors duration-200 flex items-center"
            >
              <i className="fas fa-edit mr-2"></i>
              Modifier
            </Link>
            <button
              onClick={handleDelete}
              disabled={isDeleting}
              className="bg-red-600 hover:bg-red-700 disabled:bg-gray-400 text-white px-3 py-2 rounded-lg transition-colors duration-200 flex items-center"
            >
              {isDeleting ? (
                <div className="animate-spin rounded-full h-4 w-4 border-b-2 border-white mr-2"></div>
              ) : (
                <i className="fas fa-trash mr-2"></i>
              )}
              Supprimer
            </button>
          </div>
        </div>

        {/* Contact Information */}
        <div className="space-y-3 mb-4">
          {operator.EMail && (
            <div className="flex items-center space-x-2">
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
            <div className="flex items-center space-x-2">
              <i className="fas fa-phone text-gray-400"></i>
              <a
                href={`tel:${operator.Phone}`}
                className="text-blue-600 hover:text-blue-800 transition-colors duration-200"
              >
                {operator.Phone}
              </a>
            </div>
          )}

          {(operator.Adresse || operator.Cp || operator.Ville) && (
            <div className="flex items-start space-x-2">
              <i className="fas fa-map-marker-alt text-gray-400 mt-1"></i>
              <div className="text-sm text-gray-600">
                {operator.Adresse && <div>{operator.Adresse}</div>}
                {(operator.Cp || operator.Ville) && (
                  <div>
                    {operator.Cp} {operator.Ville}
                  </div>
                )}
              </div>
            </div>
          )}
        </div>

        {/* Building Count */}
        <div className="bg-gray-50 rounded-lg p-4">
          <div className="flex items-center justify-between">
            <div className="flex items-center space-x-2">
              <i className="fas fa-building text-blue-600"></i>
              <span className="text-sm font-medium text-gray-700">
                Immeubles gérés
              </span>
            </div>
            <div className="text-2xl font-bold text-blue-600">
              {operator.NbImmeubles}
            </div>
          </div>
        </div>

        {/* View Details Link */}
        <div className="mt-4 pt-4 border-t border-gray-200">
          <Link
            href={`/operators/${operator.PKUser}`}
            className="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg transition-colors duration-200 flex items-center justify-center"
          >
            <i className="fas fa-eye mr-2"></i>
            Voir les détails
          </Link>
        </div>
      </div>
    </div>
  );
};

export default OperatorCard;
