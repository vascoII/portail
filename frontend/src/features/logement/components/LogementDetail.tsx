"use client";

import React, { useState } from "react";
import Link from "next/link";
import StatusGauge from "@/src/features/parc/components/StatusGauge";
import InterventionModal from "@/src/features/parc/components/InterventionModal";

interface LogementDetailProps {
  logement: {
    Logement: {
      PkLogement: number;
      Ref?: string;
      NumOrdre: string;
      NumBatiment: string;
      NumEscalier: string;
      NumEtage: string;
      AdrBatiment: string;
    };
    Immeuble: {
      PkImmeuble: number;
      Ref: string;
      Numero: string;
      Cp: string;
      Ville: string;
      HasTelereleve: boolean;
      HasNoteOccupant: boolean;
    };
    Occupant: {
      PkOccupant: number;
      Ref: string;
      Nom: string;
      DateArrivee: string;
    };
    NbAppareils: number;
    NbCompteursEF: number;
    NbCompteursEC: number;
    NbCompteursRepart: number;
    NbCompteursCET: number;
    NbCompteursElect: number;
    NbCompteursGaz: number;
    NbCompteursCapteur: number;
    NbFuites: number;
    NbAnomalies: number;
    NbDysfonctionnements: number;
    NbDepannages: number;
    NbDepannagesTotal: number;
    TicketsInterEnabled: boolean;
    NbTicketsInter: number;
  };
  isGestionMode?: boolean;
  showChgtOccupant?: boolean;
}

const LogementDetail: React.FC<LogementDetailProps> = ({
  logement,
  isGestionMode = false,
  showChgtOccupant = false,
}) => {
  const [isInterventionModalOpen, setIsInterventionModalOpen] = useState(false);

  const deviceStats = [
    {
      label: "Eau froide",
      count: logement.NbCompteursEF,
      icon: "fas fa-tint",
      color: "text-blue-600",
    },
    {
      label: "Eau chaude",
      count: logement.NbCompteursEC,
      icon: "fas fa-tint",
      color: "text-red-600",
    },
    {
      label: "Répartiteurs",
      count: logement.NbCompteursRepart,
      icon: "fas fa-th-large",
      color: "text-green-600",
    },
    {
      label: "Compteur d'énergie",
      count: logement.NbCompteursCET,
      icon: "fas fa-tachometer-alt",
      color: "text-purple-600",
    },
    {
      label: "Electricité",
      count: logement.NbCompteursElect,
      icon: "fas fa-bolt",
      color: "text-yellow-600",
    },
    {
      label: "Gaz",
      count: logement.NbCompteursGaz,
      icon: "fas fa-fire",
      color: "text-orange-600",
    },
  ].filter((stat) => stat.count > 0);

  return (
    <div className="space-y-6">
      {/* Main Logement Info */}
      <div className="bg-green-600 text-white rounded-lg p-6">
        <div className="flex items-start justify-between mb-6">
          <div className="flex items-center space-x-4">
            <div className="w-16 h-16 bg-green-500 rounded-lg flex items-center justify-center">
              <i className="fas fa-home text-2xl"></i>
            </div>
            <div>
              <p className="text-lg font-semibold">
                <strong>Référence :</strong> {logement.Occupant.Ref}
              </p>
              <p className="text-sm opacity-90">
                <strong>N° d'immeuble :</strong> {logement.Immeuble.Numero}
              </p>
            </div>
          </div>

          {/* Ticket System */}
          {logement.TicketsInterEnabled && (
            <div className="text-right">
              {logement.NbTicketsInter > 0 && (
                <Link
                  href="/tickets"
                  className="block bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg mb-2 transition-colors duration-200"
                >
                  <div className="text-sm">Tickets en cours</div>
                  <div className="text-lg font-bold">
                    {logement.NbTicketsInter}
                  </div>
                </Link>
              )}
              <button
                onClick={() => setIsInterventionModalOpen(true)}
                className="bg-green-700 hover:bg-green-800 text-white px-4 py-2 rounded-lg transition-colors duration-200"
              >
                Demande d'intervention
              </button>
            </div>
          )}
        </div>

        <div className="mb-4">
          <div className="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
            <div>
              <span className="font-medium">
                Bâtiment {logement.Logement.NumBatiment}
              </span>
            </div>
            <div>
              <span className="font-medium">
                Escalier {logement.Logement.NumEscalier}
              </span>
            </div>
            <div>
              <span className="font-medium">
                Étage {logement.Logement.NumEtage}
              </span>
            </div>
            <div>
              <span className="font-medium">
                Logement {logement.Logement.NumOrdre}
              </span>
            </div>
          </div>
          <div className="mt-2 text-sm opacity-90">
            <div>{logement.Logement.AdrBatiment}</div>
            <div>
              {logement.Immeuble.Cp} {logement.Immeuble.Ville}
            </div>
          </div>
        </div>
      </div>

      {/* Occupant Info */}
      <div className="bg-white rounded-lg shadow-md p-6">
        <div className="flex items-start space-x-4">
          <div className="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
            <i className="fas fa-user text-blue-600 text-xl"></i>
          </div>
          <div className="flex-1">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <p className="text-lg font-semibold text-gray-800">
                  <strong>Occupant :</strong> {logement.Occupant.Nom}
                </p>
                <p className="text-sm text-gray-600">
                  <strong>Date d'arrivée :</strong>{" "}
                  {new Date(logement.Occupant.DateArrivee).toLocaleDateString(
                    "fr-FR"
                  )}
                </p>
              </div>

              {/* Management Actions */}
              {isGestionMode && showChgtOccupant && (
                <div className="flex space-x-2">
                  <Link
                    href={`/logements/${logement.Logement.PkLogement}/edit`}
                    className="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center"
                    title="Modifier les coordonnées de l'occupant"
                  >
                    <i className="fas fa-pencil mr-2"></i>
                    Modifier
                  </Link>
                  <Link
                    href={`/gestion-parc/declarer-occupant/${logement.Logement.PkLogement}`}
                    className="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center"
                    title="Déclarer un nouvel occupant"
                  >
                    <i className="fas fa-user-plus mr-2"></i>
                    Nouvel occupant
                  </Link>
                </div>
              )}

              {/* Consumption Info Buttons */}
              {logement.Immeuble.HasTelereleve &&
                logement.Immeuble.HasNoteOccupant && (
                  <div className="flex space-x-2">
                    {logement.NbCompteursEC > 0 && (
                      <form
                        action={`/occupant/note-releve/${logement.Immeuble.PkImmeuble}/${logement.Occupant.PkOccupant}/EAU`}
                        method="POST"
                        target="_blank"
                        className="inline"
                      >
                        <button
                          type="submit"
                          className="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded text-sm transition-colors duration-200"
                        >
                          <i className="fas fa-download mr-1"></i>
                          Info Conso Eau
                        </button>
                      </form>
                    )}
                    {(logement.NbCompteursCET > 0 ||
                      logement.NbCompteursRepart > 0) && (
                      <form
                        action={`/occupant/note-releve/${logement.Immeuble.PkImmeuble}/${logement.Occupant.PkOccupant}/CHAUFFAGE`}
                        method="POST"
                        target="_blank"
                        className="inline"
                      >
                        <button
                          type="submit"
                          className="bg-orange-600 hover:bg-orange-700 text-white px-3 py-2 rounded text-sm transition-colors duration-200"
                        >
                          <i className="fas fa-download mr-1"></i>
                          Info Conso Chauffage
                        </button>
                      </form>
                    )}
                  </div>
                )}
            </div>
          </div>
        </div>
      </div>

      {/* Device Statistics */}
      <div className="bg-white rounded-lg shadow-md p-6">
        <div className="text-center mb-6">
          <div className="text-2xl font-bold text-gray-800">
            {logement.NbAppareils}
          </div>
          <div className="text-lg text-gray-600">Appareils</div>
        </div>

        <div className="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
          {deviceStats.map((stat, index) => (
            <div key={index} className="text-center">
              <div className={`text-2xl font-bold ${stat.color}`}>
                {stat.count}
              </div>
              <div className="text-sm text-gray-600">{stat.label}</div>
            </div>
          ))}
        </div>
      </div>

      {/* Status Gauges */}
      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        <StatusGauge
          title={
            logement.NbDepannages > 0 ? "Dépannages en cours" : "Dépannages"
          }
          count={
            logement.NbDepannages > 0
              ? logement.NbDepannages
              : logement.NbDepannagesTotal
          }
          icon="fas fa-wrench"
          color="bg-yellow-500"
          href={`/logements/${logement.Logement.PkLogement}/interventions${
            logement.NbDepannages > 0 ? "?statut=ouvert" : ""
          }`}
        />

        <StatusGauge
          title="Alarmes techniques"
          count={
            logement.NbDysfonctionnements === -1
              ? 0
              : logement.NbDysfonctionnements
          }
          icon="fas fa-bell"
          color="bg-orange-500"
          href={`/logements/${logement.Logement.PkLogement}/dysfunctions`}
        />
      </div>

      {/* Energy Tabs Placeholder */}
      <div className="bg-white rounded-lg shadow-md">
        <div className="border-b border-gray-200">
          <nav className="flex space-x-8 px-6">
            {deviceStats.map((stat, index) => (
              <button
                key={index}
                className={`py-4 px-1 border-b-2 font-medium text-sm ${
                  index === 0
                    ? "border-green-500 text-green-600"
                    : "border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300"
                }`}
              >
                <i className={`${stat.icon} mr-2`}></i>
                {stat.label}
              </button>
            ))}
          </nav>
        </div>
        <div className="p-6">
          <div className="text-center text-gray-500">
            <i className="fas fa-chart-line text-4xl mb-4"></i>
            <p>Graphiques de consommation et alertes</p>
            <p className="text-sm">
              Sélectionnez un onglet pour voir les détails
            </p>
          </div>
        </div>
      </div>

      {/* Intervention Modal */}
      <InterventionModal
        isOpen={isInterventionModalOpen}
        onClose={() => setIsInterventionModalOpen(false)}
      />
    </div>
  );
};

export default LogementDetail;
