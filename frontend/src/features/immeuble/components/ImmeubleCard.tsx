"use client";

import React from "react";
import Link from "next/link";
import { Immeuble } from "@/src/shared/hooks/useImmeubles";
import ImmeubleListSkeleton from "./ImmeubleListSkeleton";

interface ImmeubleCardProps {
  immeuble: Immeuble;
  isGestionMode?: boolean;
  showChgtOccupant?: boolean;
  loading?: boolean;
  error?: string | null;
}

const ImmeubleCard: React.FC<ImmeubleCardProps> = ({
  immeuble,
  isGestionMode = false,
  showChgtOccupant = false,
  loading = false,
  error = null,
}) => {
  if (loading) {
    return (
      <div className="bg-white rounded-lg shadow-md p-6">
        <ImmeubleListSkeleton count={1} />
      </div>
    );
  }

  if (error) {
    return (
      <div className="bg-red-50 border border-red-200 rounded-lg p-6">
        <div className="flex items-center justify-between">
          <div>
            <h3 className="text-lg font-medium text-red-800 mb-2">
              Erreur lors du chargement de l'immeuble
            </h3>
            <p className="text-red-600 text-sm">{error}</p>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200">
      <div className="p-6">
        <div className="flex items-start justify-between mb-4">
          {/* Building Icon and Info */}
          <div className="flex items-start space-x-4 flex-1">
            <div className="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
              <i className="fas fa-building text-blue-600 text-xl"></i>
            </div>

            <div className="flex-1">
              <div className="grid grid-cols-2 gap-2 text-sm">
                <div>
                  <span className="font-medium text-gray-600">Référence :</span>
                  <div className="font-semibold text-gray-800">
                    {immeuble.ref}
                  </div>
                </div>
                <div>
                  <span className="font-medium text-gray-600">
                    N° d&apos;immeuble :
                  </span>
                  <div className="font-semibold text-gray-800">
                    {immeuble.numero}
                  </div>
                </div>
              </div>

              <div className="mt-2 text-sm text-gray-600">
                <div>
                  {immeuble.adresse1} {immeuble.adresse2} {immeuble.adresse3}
                </div>
                <div>
                  {immeuble.cp} {immeuble.ville}
                </div>
              </div>
            </div>
          </div>
        </div>

        {/* Action Buttons */}
        <div className="flex items-center justify-between">
          <Link
            href={
              isGestionMode
                ? `/gestion-parc/logement/${immeuble.pkImmeuble}`
                : `/immeubles/${immeuble.pkImmeuble}`
            }
            className="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center"
          >
            <span className="font-semibold">Voir les détails</span>
            <i className="fas fa-chevron-right ml-2"></i>
          </Link>

          {/* Gestion Mode Button */}
          {isGestionMode && showChgtOccupant && (
            <Link
              href={`/gestion-parc/logement/${immeuble.pkImmeuble}`}
              className="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center"
            >
              <i className="fas fa-file mr-2"></i>
              <span>Gérer les occupants</span>
            </Link>
          )}
        </div>
      </div>
    </div>
  );
};

export default ImmeubleCard;
