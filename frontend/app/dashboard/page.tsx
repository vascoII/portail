"use client";

import React, { useState } from "react";
import BaseLayout from "@/src/shared/components/Layout/BaseLayout";
import Breadcrumb from "@/src/shared/components/Layout/Breadcrumb";
import {
  Bandeau,
  Main,
  DepanageGauge,
  AlarmeGauge,
  Alerte,
  Chantier,
  Releve,
  InterventionModal,
} from "@/src/features/parc/components";
import { useParc } from "@/src/features/parc/hooks/useParc";
import { useUser } from "@/src/features/security/hooks/useUser";
import { ErrorMessage } from "@/src/shared/components/UI/LoadingSpinner";
import DashboardSkeleton from "@/src/shared/components/skeleton/DashboardSkeleton";
import config from "@/src/config";
import "../../public/styles/dashboard.css";

const DashboardPage: React.FC = () => {
  const [isInterventionModalOpen, setIsInterventionModalOpen] = useState(false);

  // Fetch data from API
  const {
    data: parcData,
    loading: parcLoading,
    error: parcError,
    refetch: refetchParc,
  } = useParc();
  const {
    user: userData,
    loading: userLoading,
    error: userError,
    refetch: refetchUser,
  } = useUser();

  const breadcrumbItems = [{ label: "Le parc", href: "/dashboard" }];

  // Show loading state
  if (parcLoading || userLoading) {
    return (
      <BaseLayout>
        <Breadcrumb items={breadcrumbItems} />
        <DashboardSkeleton />
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
              onRetry={async () => {
                await refetchParc(true);
                await refetchUser(true);
              }}
            />
          </div>
        </div>
      </BaseLayout>
    );
  }

  // Show dashboard with real data
  if (!parcData) {
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
              onRetry={async () => {
                await refetchParc(true);
                await refetchUser(true);
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

      <div className="dashboard-container">
        <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
          <h2 className="text-2xl font-bold text-dashboard-textPrimary mb-8">
            Aperçu de votre parc
          </h2>

          {/* Bandeau - Full width at the top */}
          <Bandeau data={parcData} />

          {/* Main Dashboard Grid */}
          <div className="flex flex-col gap-4">
            {/* Ligne 1: Main (2/3) + DepanageGauge (1/3) */}
            <div className="flex flex-col md:flex-row gap-4 w-full">
              <div className="w-full md:w-2/3">
                <Main
                  data={parcData}
                  showChgtOccupant={userData?.showChgtOccupant ?? false}
                />
              </div>
              <div className="w-full md:w-1/3">
                <DepanageGauge data={parcData} />
              </div>
            </div>

            {/* Ligne 2: Alerte (2/3) + AlarmeGauge (1/3) */}
            <div className="flex flex-col md:flex-row gap-4 w-full">
              <div className="w-full md:w-2/3">
                <Alerte data={parcData} isDemo={config.features.demoMode} />
              </div>
              <div className="w-full md:w-1/3">
                <AlarmeGauge data={parcData} />
              </div>
            </div>

            {/* Ligne 3: Chantier (1/3) + Releve (2/3) */}
            <div className="flex flex-col md:flex-row gap-4 w-full">
              <div className="w-full md:w-1/3">
                <Chantier />
              </div>
              <div className="w-full md:w-2/3">
                <Releve data={parcData} />
              </div>
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
