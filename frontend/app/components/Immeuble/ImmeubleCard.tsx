"use client";

import React from "react";
import Link from "next/link";
interface ImmeubleCardProps {
  immeuble: {
    pkImmeuble: number;
    ref: string;
    numero: string;
    nom?: string;
    adresse1: string;
    adresse2?: string;
    adresse3?: string;
    cp: string;
    ville: string;
    nbLogements: number;
    nbAppareils: number;
    nbCompteursEF: number;
    nbCompteursEC: number;
    nbCompteursRepart: number;
    nbCompteursCET: number;
    nbCompteursElect: number;
    nbCompteursGaz: number;
    nbFuites: number;
    nbAnomalies: number;
    nbDysfonctionnements: number;
    nbDepannages: number;
    nbChantiers: number;
  };
  isGestionMode?: boolean;
  showChgtOccupant?: boolean;
}


const ImmeubleCard: React.FC<ImmeubleCardProps> = ({
  immeuble,
  isGestionMode = false,
  showChgtOccupant = false,
}) => {
  const totalWaterMeters = (immeuble.nbCompteursEF ?? 0) + (immeuble.nbCompteursEC ?? 0);

  const getAlertIcon = (type: string, count: number, href: string) => {
    if (count <= 0) return null;

    const iconClasses = {
      dys: "fas fa-bell text-orange-500",
      dep: "fas fa-wrench text-yellow-500",
      fui: "fas fa-tint text-blue-500",
      ano: "fas fa-exclamation-triangle text-red-500",
    };

    const bgClasses = {
      dys: "bg-orange-100",
      dep: "bg-yellow-100",
      fui: "bg-blue-100",
      ano: "bg-red-100",
    };

    return (
      <Link href={href} className="block">
        <div
          className={`w-8 h-8 rounded-full ${
            bgClasses[type as keyof typeof bgClasses]
          } flex items-center justify-center hover:scale-110 transition-transform duration-200`}
        >
          <i
            className={`${
              iconClasses[type as keyof typeof iconClasses]
            } text-sm`}
          ></i>
        </div>
      </Link>
    );
  };

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
                  {immeuble.adresse1} {immeuble.adresse2}{" "}
                  {immeuble.adresse3}
                </div>
                <div>
                  {immeuble.cp} {immeuble.ville}
                </div>
              </div>
            </div>
          </div>

          {/* Alert Icons */}
          {!isGestionMode && (
            <div className="flex space-x-2">
              {getAlertIcon(
                "dys",
                immeuble.nbDysfonctionnements,
                `/pages/immeubles/${immeuble.pkImmeuble}/dysfunctions`
              )}
              {getAlertIcon(
                "dep",
                immeuble.nbDepannages,
                `/pages/immeubles/${immeuble.pkImmeuble}/interventions`
              )}
              {getAlertIcon(
                "fui",
                immeuble.nbFuites,
                `/pages/immeubles/${immeuble.pkImmeuble}/leaks`
              )}
              {getAlertIcon(
                "ano",
                immeuble.nbAnomalies,
                `/pages/immeubles/${immeuble.pkImmeuble}/anomalies`
              )}
            </div>
          )}
        </div>

        {/* Action Buttons */}
        <div className="flex items-center justify-between">
          <Link
            href={
              isGestionMode
                ? `/pages/gestion-parc/logement/${immeuble.pkImmeuble}`
                : `/pages/immeubles/${immeuble.pkImmeuble}`
            }
            className="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center"
          >
            <span className="font-semibold">{immeuble.nbLogements}</span>
            <span className="ml-2">Logements</span>
            <i className="fas fa-chevron-right ml-2"></i>
          </Link>

          {/* Meter Counts */}
          {!isGestionMode && (
            <div className="flex space-x-4 text-sm">
              <div className="text-center">
                <div className="flex items-center text-blue-600">
                  <i className="fas fa-tint mr-1"></i>
                  <span className="font-semibold">{totalWaterMeters}</span>
                </div>
                <div className="text-gray-600">Eau</div>
              </div>
              <div className="text-center">
                <div className="flex items-center text-green-600">
                  <i className="fas fa-th-large mr-1"></i>
                  <span className="font-semibold">
                    {immeuble.nbCompteursRepart || 0}
                  </span>
                </div>
                <div className="text-gray-600">Répartiteurs</div>
              </div>
              <div className="text-center">
                <div className="flex items-center text-purple-600">
                  <i className="fas fa-tachometer-alt mr-1"></i>
                  <span className="font-semibold">
                    {immeuble.nbCompteursCET || 0}
                  </span>
                </div>
                <div className="text-gray-600">Compteur d&apos;énergie</div>
              </div>
            </div>
          )}

          {/* Gestion Mode Button */}
          {isGestionMode && showChgtOccupant && (
            <Link
              href={`/pages/gestion-parc/logement/${immeuble.pkImmeuble}`}
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
