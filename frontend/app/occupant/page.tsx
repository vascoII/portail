"use client";

import React, { useState } from "react";
import BaseLayout from "@/src/shared/components/Layout/BaseLayout";
import Breadcrumb from "@/src/shared/components/Layout/Breadcrumb";
import { OccupantDashboard, OccupantMenu } from "@/src/features/occupant/components";

const OccupantPage: React.FC = () => {
  const [rgpdConsent, setRgpdConsent] = useState(false);

  // Mock data - in a real app, this would come from an API
  const logementData = {
    Logement: {
      PkLogement: 1,
      Ref: "LOG-001",
      NumOrdre: "L1",
      NumBatiment: "A",
      NumEscalier: "1",
      NumEtage: "2",
      AdrBatiment: "123 Rue de la Paix",
    },
    Immeuble: {
      PkImmeuble: 1,
      Ref: "REF-001",
      Numero: "NUM-001",
      Cp: "75001",
      Ville: "Paris",
      HasTelereleve: true,
      HasNoteOccupant: true,
    },
    Occupant: {
      PkOccupant: 1,
      Ref: "OCC-001",
      Nom: "Jean Dupont",
      DateArrivee: "2024-01-15",
    },
    NbAppareils: 4,
    NbCompteursEF: 1,
    NbCompteursEC: 1,
    NbCompteursRepart: 1,
    NbCompteursCET: 0,
    NbCompteursElect: 1,
    NbCompteursGaz: 0,
    NbCompteursCapteur: 0,
    NbFuites: 0,
    NbAnomalies: 0,
    NbDysfonctionnements: 0,
    NbDepannages: 0,
    NbDepannagesTotal: 0,
  };

  const breadcrumbItems = [
    { label: `Logement ${logementData.Occupant.Ref}`, href: "/occupant" },
  ];

  const handleRgpdChange = (value: boolean) => {
    setRgpdConsent(value);
    // In a real app, this would save to the backend
    console.log("RGPD consent changed:", value);
  };

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      {/* Occupant Menu */}
      <OccupantMenu logement={logementData} activeTab="dashboard" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 className="text-2xl font-bold text-gray-900 mb-8">
          Aperçu du logement
        </h2>

        <OccupantDashboard
          logement={logementData}
          rgpdCheckboxValue={rgpdConsent}
          onRgpdChange={handleRgpdChange}
        />
      </div>
    </BaseLayout>
  );
};

export default OccupantPage;
