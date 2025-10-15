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

const PendingFacturesPage: React.FC = () => {
  const [filters, setFilters] = useState<FilterState>({
    search: "",
    dateFrom: "",
    dateTo: "",
    amountFrom: "",
    amountTo: "",
    codeGestio: "",
    ville: "",
  });

  // Mock data for pending invoices
  const factures = [
    {
      PKFacture: 1,
      NumFacture: "FAC-2024-001",
      CodeGestio: "GEST-001",
      Adresse: "123 Rue de la Paix",
      Ville: "Paris",
      CP: "75001",
      DateEdition: "2024-01-15",
      MontantTotalHT: 1200.0,
      MontantTotalTTC: 1440.0,
      MontantTotalAPayer: 1440.0,
    },
    {
      PKFacture: 3,
      NumFacture: "FAC-2024-003",
      CodeGestio: "GEST-001",
      Adresse: "789 Boulevard Saint-Germain",
      Ville: "Marseille",
      CP: "13001",
      DateEdition: "2024-02-01",
      MontantTotalHT: 2000.0,
      MontantTotalTTC: 2400.0,
      MontantTotalAPayer: 2400.0,
    },
    {
      PKFacture: 4,
      NumFacture: "FAC-2024-004",
      CodeGestio: "GEST-003",
      Adresse: "321 Rue de Rivoli",
      Ville: "Toulouse",
      CP: "31000",
      DateEdition: "2024-02-10",
      MontantTotalHT: 1500.0,
      MontantTotalTTC: 1800.0,
      MontantTotalAPayer: 1800.0,
    },
  ];

  const breadcrumbItems = [
    { label: "Le parc", href: "/pages/dashboard" },
    { label: "Liste des factures", href: "/pages/factures" },
    { label: "Factures en attente", href: "/pages/factures/pending" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      {/* Facture Menu */}
      <FactureMenu activeTab="pending" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div className="mb-6">
          <h2 className="text-2xl font-bold text-gray-900 mb-2">
            Factures en attente de paiement
          </h2>
          <p className="text-gray-600">
            {factures.length} facture{factures.length > 1 ? "s" : ""} en attente
            de paiement
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

export default PendingFacturesPage;
