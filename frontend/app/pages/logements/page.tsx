"use client";

import React, { useState } from "react";
import { useSearchParams } from "next/navigation";
import BaseLayout from "../../components/Layout/BaseLayout";
import Breadcrumb from "../../components/Layout/Breadcrumb";
import { LogementFilters, LogementList } from "../../components/Logement";
import { useLogements } from "../../hooks/useLogements";

interface FilterState {
  energie: string;
  fuites: boolean;
  anomalies: boolean;
  dysfonctionnements: boolean;
  depannages: boolean;
  reference: string;
  location: string;
  batiment: string;
  escalier: string;
  etage: string;
}

const LogementsListPage: React.FC = () => {
  const searchParams = useSearchParams();
  const immeubleId = searchParams.get("immeuble");
  const gestion = searchParams.get("gestion") === "true";

  const { logements, loading, error } = useLogements(immeubleId);
  const [filters, setFilters] = useState<FilterState>({
    energie: "",
    fuites: false,
    anomalies: false,
    dysfonctionnements: false,
    depannages: false,
    reference: "",
    location: "",
    batiment: "",
    escalier: "",
    etage: "",
  });

  // Mock filter options - in a real app, this would come from an API
  const filterOptions = {
    batiment: ["A", "B", "C"],
    escalier: ["1", "2", "3"],
    etage: ["RDC", "1", "2", "3", "4", "5"],
  };

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: "Liste des immeubles", href: "/immeubles" },
    ...(immeubleId
      ? [{ label: `Immeuble ${immeubleId}`, href: `/immeubles/${immeubleId}` }]
      : []),
    { label: "Liste des logements", href: "/logements" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 className="text-2xl font-bold text-gray-900 mb-8">
          Liste des logements
        </h2>

        <LogementFilters
          onFiltersChange={setFilters}
          filters={filterOptions}
          isGestionMode={gestion}
          immeubleId={immeubleId ? parseInt(immeubleId) : undefined}
        />

        <LogementList
          logements={logements}
          filters={filters}
          isGestionMode={gestion}
          loading={loading}
          error={error}
        />
      </div>
    </BaseLayout>
  );
};

export default LogementsListPage;
