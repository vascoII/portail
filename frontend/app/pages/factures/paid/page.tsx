"use client";

import React, { useState } from "react";
import BaseLayout from "../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../components/Layout/Breadcrumb";
import {
  FactureFilters,
  FactureList,
  FactureMenu,
} from "../../../components/Facture";

interface FilterState {
  search: string;
  dateFrom: string;
  dateTo: string;
  amountFrom: string;
  amountTo: string;
  codeGestio: string;
  ville: string;
}

const PaidFacturesPage: React.FC = () => {
  const [filters, setFilters] = useState<FilterState>({
    search: "",
    dateFrom: "",
    dateTo: "",
    amountFrom: "",
    amountTo: "",
    codeGestio: "",
    ville: "",
  });

  // Mock data for paid invoices
  const factures = [
    {
      PKFacture: 2,
      NumFacture: "FAC-2024-002",
      CodeGestio: "GEST-002",
      Adresse: "456 Avenue des Champs",
      Ville: "Lyon",
      CP: "69001",
      DateEdition: "2024-01-20",
      MontantTotalHT: 800.0,
      MontantTotalTTC: 960.0,
      MontantTotalAPayer: 0.0,
    },
    {
      PKFacture: 5,
      NumFacture: "FAC-2024-005",
      CodeGestio: "GEST-001",
      Adresse: "654 Rue de la République",
      Ville: "Nice",
      CP: "06000",
      DateEdition: "2024-01-05",
      MontantTotalHT: 600.0,
      MontantTotalTTC: 720.0,
      MontantTotalAPayer: 0.0,
    },
  ];

  const breadcrumbItems = [
    { label: "Le parc", href: "/pages/dashboard" },
    { label: "Liste des factures", href: "/pages/factures" },
    { label: "Factures payées", href: "/pages/factures/paid" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      {/* Facture Menu */}
      <FactureMenu activeTab="paid" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div className="mb-6">
          <h2 className="text-2xl font-bold text-gray-900 mb-2">
            Factures payées
          </h2>
          <p className="text-gray-600">
            {factures.length} facture{factures.length > 1 ? "s" : ""} payée
            {factures.length > 1 ? "s" : ""}
          </p>
        </div>

        <FactureFilters onFiltersChange={setFilters} />

        <FactureList
          factures={factures}
          filters={filters}
          loading={false}
          error={null}
        />
      </div>
    </BaseLayout>
  );
};

export default PaidFacturesPage;
