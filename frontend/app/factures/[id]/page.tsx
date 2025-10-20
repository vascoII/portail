"use client";

import React from "react";
import { useParams } from "next/navigation";
import BaseLayout from "../../../src/components/Layout/BaseLayout";
import Breadcrumb from "../../../src/components/Layout/Breadcrumb";
import { FactureDetail, FactureMenu } from "../../../src/components/Facture";

const FactureDetailPage: React.FC = () => {
  const params = useParams();
  const id = params.id as string;

  // Mock data - in a real app, this would come from an API
  const factureData = {
    PKFacture: parseInt(id),
    NumFacture: `FAC-2024-${id.padStart(3, "0")}`,
    CodeGestio: `GEST-${id}`,
    Adresse: "123 Rue de la Paix",
    Ville: "Paris",
    CP: "75001",
    DateEdition: "2024-01-15",
    MontantTotalHT: 1200.0,
    MontantTotalTTC: 1440.0,
    MontantTotalAPayer: 1440.0,
    TVA: 240.0,
    Details: [
      {
        Description: "Prestation de maintenance compteurs",
        Quantite: 1,
        PrixUnitaire: 800.0,
        MontantHT: 800.0,
        TVA: 160.0,
        MontantTTC: 960.0,
      },
      {
        Description: "Installation nouveaux compteurs",
        Quantite: 2,
        PrixUnitaire: 200.0,
        MontantHT: 400.0,
        TVA: 80.0,
        MontantTTC: 480.0,
      },
    ],
  };

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: "Liste des factures", href: "/factures" },
    { label: `Facture ${factureData.NumFacture}`, href: `/factures/${id}` },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      {/* Facture Menu */}
      <FactureMenu activeTab="detail" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <FactureDetail facture={factureData} />
      </div>
    </BaseLayout>
  );
};

export default FactureDetailPage;
