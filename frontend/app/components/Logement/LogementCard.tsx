"use client";

import React, { useState } from "react";
import Link from "next/link";

interface LogementCardProps {
  logement: {
    infosLogement: {
      Logement: {
        PkLogement: number;
        Ref?: string;
        NumOrdre: string;
        NumBatiment: string;
        NumEscalier: string;
        NumEtage: string;
      };
      Occupant: {
        Ref: string;
        Nom: string;
      };
      NbFuites: number;
      NbAnomalies: number;
      NbDysfonctionnements: number;
      NbDepannages: number;
      NbCompteursEF: number;
      NbCompteursEC: number;
      NbCompteursRepart: number;
      NbCompteursCET: number;
      NbCompteursElect: number;
      NbCompteursGaz: number;
      TicketsInterEnabled: boolean;
      NbTicketsInter: number;
    };
  };
  isGestionMode?: boolean;
  showChgtOccupant?: boolean;
}

const LogementCard: React.FC<LogementCardProps> = ({
  logement,
  isGestionMode = false,
  showChgtOccupant = false,
}) => {
  const [isInterventionModalOpen, setIsInterventionModalOpen] = useState(false);

  const totalWaterMeters =
    logement.infosLogement.NbCompteursEF + logement.infosLogement.NbCompteursEC;
  const totalHeatingMeters =
    logement.infosLogement.NbCompteursRepart +
    logement.infosLogement.NbCompteursCET;

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

  const getManagementIcon = (type: string, href: string, title: string) => {
    const iconClasses = {
      edit: "fas fa-pencil text-yellow-500",
      user: "fas fa-user text-blue-500",
    };

    const bgClasses = {
      edit: "bg-yellow-100",
      user: "bg-blue-100",
    };

    return (
      <Link href={href} title={title} className="block">
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
          {/* Logement Icon and Info */}
          <div className="flex items-start space-x-4 flex-1">
            <div className="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
              <i className="fas fa-home text-green-600 text-xl"></i>
            </div>

            <div className="flex-1">
              <div className="grid grid-cols-2 gap-2 text-sm">
                <div>
                  <span className="font-medium text-gray-600">
                    Référence client :
                  </span>
                  <div className="font-semibold text-gray-800">
                    {logement.infosLogement.Occupant.Ref}
                  </div>
                </div>
                <div>
                  <span className="font-medium text-gray-600">Étage :</span>
                  <div className="font-semibold text-gray-800">
                    {logement.infosLogement.Logement.NumEtage}
                  </div>
                </div>
                <div>
                  <span className="font-medium text-gray-600">
                    N° logement :
                  </span>
                  <div className="font-semibold text-gray-800">
                    {logement.infosLogement.Logement.NumOrdre}
                  </div>
                </div>
              </div>

              <div className="mt-2 text-sm text-gray-600">
                <div className="font-medium">
                  {logement.infosLogement.Occupant.Nom}
                </div>
              </div>
            </div>
          </div>

          {/* Alert Icons */}
          {!isGestionMode && (
            <div className="flex space-x-2">
              {getAlertIcon(
                "dys",
                logement.infosLogement.NbDysfonctionnements,
                `/pages/logements/${logement.infosLogement.Logement.PkLogement}/dysfunctions`
              )}
              {getAlertIcon(
                "dep",
                logement.infosLogement.NbDepannages,
                `/pages/logements/${logement.infosLogement.Logement.PkLogement}/interventions`
              )}
              {getAlertIcon(
                "fui",
                logement.infosLogement.NbFuites,
                `/pages/logements/${logement.infosLogement.Logement.PkLogement}/leaks`
              )}
              {getAlertIcon(
                "ano",
                logement.infosLogement.NbAnomalies,
                `/pages/logements/${logement.infosLogement.Logement.PkLogement}/anomalies`
              )}
            </div>
          )}

          {/* Management Icons */}
          {isGestionMode && showChgtOccupant && (
            <div className="flex space-x-2">
              {getManagementIcon(
                "edit",
                `/pages/logements/${logement.infosLogement.Logement.PkLogement}/edit`,
                "Modifier les coordonnées de l'occupant"
              )}
              {getManagementIcon(
                "user",
                `/pages/gestion-parc/declarer-occupant/${logement.infosLogement.Logement.PkLogement}`,
                "Déclarer un nouvel occupant"
              )}
            </div>
          )}
        </div>

        {/* Action Buttons */}
        <div className="flex items-center justify-between">
          <Link
            href={
              isGestionMode
                ? `/pages/gestion-parc/show/${logement.infosLogement.Logement.PkLogement}?gestion=true`
                : `/pages/logements/${logement.infosLogement.Logement.PkLogement}`
            }
            className="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center"
          >
            <i className="fas fa-home mr-2"></i>
            <span>Voir le logement</span>
            <i className="fas fa-chevron-right ml-2"></i>
          </Link>

          {/* Ticket System */}
          {!isGestionMode && logement.infosLogement.TicketsInterEnabled && (
            <div className="flex items-center space-x-2">
              {logement.infosLogement.NbTicketsInter > 0 && (
                <div className="bg-orange-100 text-orange-800 px-3 py-1 rounded-full text-sm">
                  <span className="font-semibold">
                    {logement.infosLogement.NbTicketsInter}
                  </span>
                  <span className="ml-1">Tickets en cours</span>
                </div>
              )}
              <button
                onClick={() => setIsInterventionModalOpen(true)}
                className="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-sm transition-colors duration-200"
              >
                Demande d'intervention
              </button>
            </div>
          )}
        </div>

        {/* Device Counts */}
        <div className="mt-4 grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
          {totalWaterMeters > 0 && (
            <div className="text-center">
              <div className="flex items-center justify-center text-blue-600 mb-1">
                <i className="fas fa-tint mr-1"></i>
                <span className="font-semibold">{totalWaterMeters}</span>
              </div>
              <div className="text-gray-600">Eau</div>
            </div>
          )}
          {totalHeatingMeters > 0 && (
            <div className="text-center">
              <div className="flex items-center justify-center text-green-600 mb-1">
                <i className="fas fa-th-large mr-1"></i>
                <span className="font-semibold">{totalHeatingMeters}</span>
              </div>
              <div className="text-gray-600">Chauffage</div>
            </div>
          )}
          {logement.infosLogement.NbCompteursElect > 0 && (
            <div className="text-center">
              <div className="flex items-center justify-center text-yellow-600 mb-1">
                <i className="fas fa-bolt mr-1"></i>
                <span className="font-semibold">
                  {logement.infosLogement.NbCompteursElect}
                </span>
              </div>
              <div className="text-gray-600">Electricité</div>
            </div>
          )}
          {logement.infosLogement.NbCompteursGaz > 0 && (
            <div className="text-center">
              <div className="flex items-center justify-center text-orange-600 mb-1">
                <i className="fas fa-fire mr-1"></i>
                <span className="font-semibold">
                  {logement.infosLogement.NbCompteursGaz}
                </span>
              </div>
              <div className="text-gray-600">Gaz</div>
            </div>
          )}
        </div>
      </div>

      {/* Intervention Modal Placeholder */}
      {isInterventionModalOpen && (
        <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
          <div className="bg-white rounded-lg p-6 max-w-md w-full mx-4">
            <div className="flex justify-between items-center mb-4">
              <h3 className="text-lg font-semibold">Demande d'intervention</h3>
              <button
                onClick={() => setIsInterventionModalOpen(false)}
                className="text-gray-500 hover:text-gray-700"
              >
                <i className="fas fa-times"></i>
              </button>
            </div>
            <p className="text-gray-600 mb-4">
              Fonctionnalité de demande d'intervention pour le logement{" "}
              {logement.infosLogement.Occupant.Ref}
            </p>
            <div className="flex justify-end space-x-2">
              <button
                onClick={() => setIsInterventionModalOpen(false)}
                className="px-4 py-2 text-gray-600 hover:text-gray-800"
              >
                Annuler
              </button>
              <button
                onClick={() => setIsInterventionModalOpen(false)}
                className="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700"
              >
                Envoyer
              </button>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default LogementCard;
