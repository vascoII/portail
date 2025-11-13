"use client";

import React, { useState } from "react";
import Link from "next/link";

interface ImmeubleDetailProps {
  immeuble: {
    Immeuble: {
      PkImmeuble: number;
      Ref: string;
      Numero: string;
      Nom?: string;
      Adresse1: string;
      Adresse2?: string;
      Adresse3?: string;
      Cp: string;
      Ville: string;
      HasTelereleve: boolean;
      HasTransfertFichiers: boolean;
    };
    NbLogements: number;
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
    GPS?: {
      x: number;
      y: number;
    };
  };
  isDemo?: boolean;
}

const ImmeubleDetail: React.FC<ImmeubleDetailProps> = ({
  immeuble,
  isDemo = false,
}) => {
  const [isInterventionModalOpen, setIsInterventionModalOpen] = useState(false);

  const deviceStats = [
    {
      label: "Eau froide",
      count: immeuble.NbCompteursEF,
      icon: "fas fa-tint",
      color: "text-blue-600",
    },
    {
      label: "Eau chaude",
      count: immeuble.NbCompteursEC,
      icon: "fas fa-tint",
      color: "text-red-600",
    },
    {
      label: "Répartiteurs",
      count: immeuble.NbCompteursRepart,
      icon: "fas fa-th-large",
      color: "text-green-600",
    },
    {
      label: "Compteur d'énergie",
      count: immeuble.NbCompteursCET,
      icon: "fas fa-tachometer-alt",
      color: "text-purple-600",
    },
    {
      label: "Electricité",
      count: immeuble.NbCompteursElect,
      icon: "fas fa-bolt",
      color: "text-yellow-600",
    },
    {
      label: "Gaz",
      count: immeuble.NbCompteursGaz,
      icon: "fas fa-fire",
      color: "text-orange-600",
    },
  ].filter((stat) => stat.count > 0);

  return (
    <div className="space-y-6">
      {/* Main Building Info */}
      <div className="bg-blue-600 text-white rounded-lg p-6">
        <div className="flex items-start justify-between mb-6">
          <div className="flex items-center space-x-4">
            <div className="w-16 h-16 bg-blue-500 rounded-lg flex items-center justify-center">
              <i className="fas fa-building text-2xl"></i>
            </div>
            <div>
              {immeuble.Immeuble.Nom && (
                <p className="text-lg font-semibold">{immeuble.Immeuble.Nom}</p>
              )}
              <p className="text-sm opacity-90">
                <strong>Référence :</strong> {immeuble.Immeuble.Ref}
              </p>
              <p className="text-sm opacity-90">
                <strong>N° d'immeuble :</strong> {immeuble.Immeuble.Numero}
              </p>
            </div>
          </div>

          {/* Map placeholder for demo */}
          {isDemo && immeuble.GPS && (
            <div className="w-64 h-48 bg-blue-500 rounded-lg flex items-center justify-center">
              <div className="text-center">
                <i className="fas fa-map-marker-alt text-2xl mb-2"></i>
                <p className="text-sm">Carte</p>
                <p className="text-xs opacity-75">
                  {immeuble.Immeuble.Cp} {immeuble.Immeuble.Ville}
                </p>
              </div>
            </div>
          )}
        </div>

        <div className="mb-4">
          <p className="text-sm opacity-90">
            {immeuble.Immeuble.Adresse1} {immeuble.Immeuble.Adresse2}{" "}
            {immeuble.Immeuble.Adresse3}
          </p>
          <p className="text-sm opacity-90">
            {immeuble.Immeuble.Cp} {immeuble.Immeuble.Ville}
          </p>
        </div>

        <Link
          href={`/logements?immeuble=${immeuble.Immeuble.PkImmeuble}`}
          className="inline-flex items-center bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-lg transition-colors duration-200"
        >
          <span className="font-semibold text-lg">{immeuble.NbLogements}</span>
          <span className="ml-2">Logements</span>
          <i className="fas fa-chevron-right ml-2"></i>
        </Link>
      </div>

      {/* Device Statistics */}
      <div className="bg-white rounded-lg shadow-md p-6">
        <div className="text-center mb-6">
          <div className="text-2xl font-bold text-gray-800">
            {immeuble.NbAppareils}
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

        {/* Reading Mode Status */}
        <div className="mt-6 pt-6 border-t border-gray-200">
          <div className="flex items-center space-x-4">
            <i className="fas fa-satellite-dish text-blue-600"></i>
            <div>
              <div className="text-sm font-medium text-gray-700">
                Mode de relève :{" "}
                <strong>
                  {immeuble.Immeuble.HasTelereleve
                    ? "Réseau fixe TSS"
                    : "Relève planifiée (radio ou manuelle)"}
                </strong>
              </div>
              <div className="text-sm font-medium text-gray-700">
                Transfert électronique de relevés :{" "}
                <strong>
                  {immeuble.Immeuble.HasTransfertFichiers ? "Actif" : "Inactif"}
                </strong>
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Status Gauges */}
      <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
        <StatusGauge
          title={
            immeuble.NbDepannages > 0 ? "Dépannages en cours" : "Dépannages"
          }
          count={
            immeuble.NbDepannages > 0
              ? immeuble.NbDepannages
              : immeuble.NbDepannagesTotal
          }
          icon="fas fa-wrench"
          color="bg-yellow-500"
          href={`/immeubles/${immeuble.Immeuble.PkImmeuble}/interventions${
            immeuble.NbDepannages > 0 ? "?statut=ouvert" : ""
          }`}
        />

        <StatusGauge
          title="Alarmes techniques"
          count={
            immeuble.NbDysfonctionnements === -1
              ? 0
              : immeuble.NbDysfonctionnements
          }
          icon="fas fa-bell"
          color="bg-orange-500"
          href={`/immeubles/${immeuble.Immeuble.PkImmeuble}/dysfunctions`}
        />
      </div>

      {/* Intervention Button */}
      <div className="bg-white rounded-lg shadow-md p-6 text-center">
        <button
          onClick={() => setIsInterventionModalOpen(true)}
          className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors duration-200"
        >
          Livret d'intervention
        </button>
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
                    ? "border-blue-500 text-blue-600"
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

export default ImmeubleDetail;
