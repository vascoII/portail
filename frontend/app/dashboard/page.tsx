"use client";

import React, { useState } from "react";
import BaseLayout from "@/components/Layout/BaseLayout";
import Breadcrumb from "@/components/Layout/Breadcrumb";
import {
  ParcOverview,
  StatusGauge,
  ClientAlerts,
  ConstructionPanel,
  InterventionModal,
  DashboardMenu,
} from "@/components/Dashboard";

const DashboardPage: React.FC = () => {
  const [isInterventionModalOpen, setIsInterventionModalOpen] = useState(false);

  // Mock data - in a real app, this would come from an API
  const dashboardData = {
    // Parc overview data
    NbImmeubles: 25,
    NbCompteurs: 150,
    NbCompteursEF: 75,
    NbCompteursEC: 50,
    NbCompteursRepart: 20,
    NbCompteursCET: 5,
    NbCompteursElect: 0,
    NbCompteursGaz: 0,
    PcImmeublesTransfertFichiers: 85,
    showChgtOccupant: true,

    // Status data
    NbFuites: 3,
    NbDysfonctionnements: 2,
    NbAnomalies: 7,
    NbDepannages: 1,

    // Construction data
    NbChantiers: 2,
    NbCompteursCommandes: 30,
    NbCompteursPoses: 18,
    DateEntreeChantier: "2024-01-15",

    // Demo mode
    isDemo: true,
  };

  const breadcrumbItems = [{ label: "Le parc", href: "/dashboard" }];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      {/* Dashboard Menu */}
      <DashboardMenu data={dashboardData} />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 className="text-2xl font-bold text-gray-900 mb-8">
          Aperçu de votre parc
        </h2>

        <div className="grid grid-cols-1 lg:grid-cols-12 gap-6">
          {/* Parc Overview */}
          <ParcOverview data={dashboardData} />

          {/* Status Gauges */}
          <div className="col-span-4 lg:col-span-4 md:col-span-6 space-y-6">
            <StatusGauge
              title="Dépannages en cours"
              count={dashboardData.NbDepannages}
              icon="fas fa-wrench"
              color="bg-yellow-500"
              href="/immeubles?depannages=1"
            />

            <div className="bg-white rounded-lg shadow-md p-6">
              <button
                onClick={() => setIsInterventionModalOpen(true)}
                className="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg transition-colors duration-200"
              >
                Livret d&apos;intervention
              </button>
            </div>
          </div>
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-6">
          {/* Client Alerts */}
          <ClientAlerts data={dashboardData} />

          {/* Technical Alerts */}
          <div className="col-span-4 lg:col-span-4 md:col-span-6">
            <StatusGauge
              title="Alarmes techniques"
              count={dashboardData.NbDysfonctionnements}
              icon="fas fa-bell"
              color="bg-orange-500"
              href="/immeubles?dysfonctionnements=1"
            />

            {dashboardData.isDemo && (
              <div className="mt-4">
                <a
                  href="/xlsx/Synthese-Codes-Incident.xlsx"
                  className="block w-full bg-orange-600 hover:bg-orange-700 text-white py-2 px-4 rounded-lg text-sm transition-colors duration-200 text-center"
                >
                  Liste des alarmes
                </a>
              </div>
            )}
          </div>
        </div>

        {/* Construction Panel */}
        <div className="mt-6">
          <ConstructionPanel data={dashboardData} />
        </div>
      </div>

      {/* Intervention Modal */}
      <InterventionModal
        isOpen={isInterventionModalOpen}
        onClose={() => setIsInterventionModalOpen(false)}
      />
    </BaseLayout>
  );
};

export default DashboardPage;
