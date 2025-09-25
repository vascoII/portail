"use client";

import React, { useState } from "react";
import BaseLayout from "../../components/Layout/BaseLayout";
import Breadcrumb from "../../components/Layout/Breadcrumb";
import { ImmeubleFilters, ImmeubleList } from "../../components/Immeuble";
import { useImmeubles } from "../../hooks/useImmeubles";

interface FilterState {
  energie: string;
  fuites: boolean;
  anomalies: boolean;
  dysfonctionnements: boolean;
  depannages: boolean;
  chantiers: boolean;
  reference: string;
  location: string;
}

const ImmeublesListPage: React.FC = () => {
  const { immeubles, loading, error } = useImmeubles();
  const [filters, setFilters] = useState<FilterState>({
    energie: "",
    fuites: false,
    anomalies: false,
    dysfonctionnements: false,
    depannages: false,
    chantiers: false,
    reference: "",
    location: "",
  });

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: "Liste des immeubles", href: "/immeubles" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 className="text-2xl font-bold text-gray-900 mb-8">
          Liste des immeubles
        </h2>

        <ImmeubleFilters onFiltersChange={setFilters} />

        <ImmeubleList
          immeubles={immeubles}
          filters={filters}
          loading={loading}
          error={error}
        />
      </div>
    </BaseLayout>
  );
};

export default ImmeublesListPage;
