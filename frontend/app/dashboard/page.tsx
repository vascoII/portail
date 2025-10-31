"use client";

import React, { useState } from "react";
import { useRouter } from "next/navigation";
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
import MobileMenu from "@/components/Dashboard/MobileMenu";
import { useParcData, useUserData } from "@/hooks/useParcData";
import {
  transformParcData,
  calculateConstructionStats,
} from "@/src/utils/dataTransform";
import type { DashboardData, ConstructionStats } from "@/src/types/api";
import { LoadingCard, ErrorMessage } from "@/components/UI/LoadingSpinner";
import "../../public/styles/dashboard.css";

const DashboardPage: React.FC = () => {
  const [isInterventionModalOpen, setIsInterventionModalOpen] = useState(false);

  // Fetch data from API
  const {
    data: parcData,
    loading: parcLoading,
    error: parcError,
    refetch: refetchParc,
  } = useParcData();
  const {
    user: userData,
    loading: userLoading,
    error: userError,
    refetch: refetchUser,
  } = useUserData();

  // Transform data for components
  const dashboardData =
    parcData && userData ? transformParcData(parcData, userData) : null;

  const constructionStats = dashboardData
    ? calculateConstructionStats(dashboardData)
    : null;

  const breadcrumbItems = [{ label: "Le parc", href: "/dashboard" }];

  // Show loading state
  if (parcLoading || userLoading) {
    return (
      <BaseLayout>
        <Breadcrumb items={breadcrumbItems} />
        <div className="dashboard-container">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h2 className="text-2xl font-bold text-dashboard-textPrimary mb-8">
              Aperçu de votre parc
            </h2>

            <div className="grid grid-cols-1 lg:grid-cols-12 gap-6">
              <div className="col-span-8">
                <LoadingCard className="h-64" />
              </div>
              <div className="col-span-4 space-y-6">
                <LoadingCard className="h-32" />
                <LoadingCard className="h-20" />
              </div>
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-12 gap-6 mt-6">
              <div className="col-span-8">
                <LoadingCard className="h-32" />
              </div>
              <div className="col-span-4">
                <LoadingCard className="h-32" />
              </div>
            </div>

            <div className="mt-6">
              <LoadingCard className="h-48" />
            </div>
          </div>
        </div>
      </BaseLayout>
    );
  }

  // Show error state
  if (parcError || userError) {
    return (
      <BaseLayout>
        <Breadcrumb items={breadcrumbItems} />
        <div className="dashboard-container">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h2 className="text-2xl font-bold text-dashboard-textPrimary mb-8">
              Aperçu de votre parc
            </h2>

            <ErrorMessage
              error={parcError || userError || "Erreur inconnue"}
              onRetry={() => {
                refetchParc();
                refetchUser();
              }}
            />
          </div>
        </div>
      </BaseLayout>
    );
  }

  // Show dashboard with real data
  if (!dashboardData) {
    return (
      <BaseLayout>
        <Breadcrumb items={breadcrumbItems} />
        <div className="dashboard-container">
          <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <h2 className="text-2xl font-bold text-dashboard-textPrimary mb-8">
              Aperçu de votre parc
            </h2>

            <ErrorMessage
              error="Aucune donnée disponible"
              onRetry={() => {
                refetchParc();
                refetchUser();
              }}
            />
          </div>
        </div>
      </BaseLayout>
    );
  }

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      {/* Dashboard Menu */}
      <DashboardMenu data={dashboardData} />

      {/* Mobile Menu */}
      <MobileMenu data={dashboardData} />

      <div className="dashboard-container">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <h2 className="text-2xl font-bold text-dashboard-textPrimary mb-8">
            Aperçu de votre parc
          </h2>

          {/* Main Dashboard Grid - Exact Bootstrap to Tailwind conversion */}
          <div className="row panel-area parc-area">
            {/* Block 1: Parc Overview - Bootstrap col-md-8 */}
            <div className="col-span-8 lg:col-span-8 md:col-span-12 block block-1">
              <ParcOverview data={dashboardData} />
            </div>

            {/* Block 2: Status Gauges - Bootstrap col-md-4 */}
            <div className="col-span-4 lg:col-span-4 md:col-span-12 block block-2 status-gauge">
              <StatusGauge
                title="Dépannages en cours"
                count={dashboardData.NbDepannages}
                icon="fas fa-wrench"
                color="bg-yellow-500"
                href="/immeubles?depannages=1"
                gaugeType="circular"
                maxValue={10}
              />

              <div className="panel-default p-6">
                <button
                  onClick={() => setIsInterventionModalOpen(true)}
                  className="w-full bg-blue-600 hover:bg-blue-700 text-white py-3 px-4 rounded-lg transition-colors duration-200"
                >
                  Livret d&apos;intervention
                </button>
              </div>
            </div>

            {/* Clearfix for Bootstrap compatibility */}
            <div className="clearfix"></div>

            {/* Block 3: Client Alerts - Bootstrap col-md-8 */}
            <div className="col-span-8 lg:col-span-8 md:col-span-12 block block-3 panel-client">
              <ClientAlerts data={dashboardData} />
            </div>

            {/* Block 4: Technical Alerts - Bootstrap col-md-4 */}
            <div className="col-span-4 lg:col-span-4 md:col-span-12 block block-4 status-gauge">
              <StatusGauge
                title="Alarmes techniques"
                count={dashboardData.NbDysfonctionnements}
                icon="fas fa-bell"
                color="bg-orange-500"
                href="/immeubles?dysfonctionnements=1"
                gaugeType="circular"
                maxValue={20}
              />

              {dashboardData.isDemo && (
                <div className="mt-4">
                  <a
                    href="/xlsx/Synthese-Codes-Incident.xlsx"
                    className="block w-full bg-orange-600 hover:bg-orange-700 text-white py-2 px-4 rounded-lg text-sm transition-colors duration-200 text-center demo-feature"
                  >
                    <span className="demo-badge mr-2">DEMO</span>
                    Liste des alarmes
                  </a>
                </div>
              )}
            </div>

            {/* Clearfix for Bootstrap compatibility */}
            <div className="clearfix"></div>

            {/* Block 5: Construction Panel - Bootstrap col-xs-12 */}
            <div className="col-span-12 block block-5 panel-bar">
              <ConstructionPanel
                data={dashboardData}
                constructionStats={constructionStats}
              />
            </div>
          </div>
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
