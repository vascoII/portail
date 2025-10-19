"use client";

import React from "react";
import { useParams } from "next/navigation";
import BaseLayout from "../../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../../components/Layout/Breadcrumb";
import { LogementEdit, LogementMenu } from "../../../../components/Logement";

const LogementEditPage: React.FC = () => {
  const params = useParams();
  const id = params.id as string;

  // Mock data - in a real app, this would come from an API
  const logementData = {
    Logement: {
      PkLogement: parseInt(id),
    },
    Immeuble: {
      PkImmeuble: 1,
      Ref: "REF-001",
    },
    Occupant: {
      Ref: `OCC-${id}`,
      Nom: `Occupant ${id}`,
      DateArrivee: "2024-01-15",
    },
    NbFuites: 1,
    NbAnomalies: 2,
    NbDysfonctionnements: 0,
    NbDepannages: 1,
    NbDepannagesTotal: 3,
    LogementEF: {
      NbFuites: 0,
      NbAnomalies: 1,
    },
    LogementEC: {
      NbFuites: 1,
      NbAnomalies: 1,
    },
  };

  const occupantData = {
    newTelmobile: "0123456789",
    newEmail: "occupant@example.com",
  };

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: "Liste des immeubles", href: "/immeubles" },
    {
      label: `Immeuble ${logementData.Immeuble.Ref}`,
      href: `/immeubles/${logementData.Immeuble.PkImmeuble}`,
    },
    {
      label: "Liste des logements",
      href: `/logements?immeuble=${logementData.Immeuble.PkImmeuble}`,
    },
    {
      label: `Logement ${logementData.Occupant.Ref}`,
      href: `/logements/${id}`,
    },
    { label: "Modifier", href: `/logements/${id}/edit` },
  ];

  const handleSubmit = (data: { email: string; phone: string }) => {
    console.log("Submitting occupant data:", data);
    // In a real app, this would make an API call
    alert("Modification enregistrée avec succès!");
  };

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      {/* Logement Menu */}
      <LogementMenu logement={logementData} activeTab="edit" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 className="text-2xl font-bold text-gray-900 mb-8">
          Modifier les coordonnées de l&apos;occupant
        </h2>

        <LogementEdit
          logement={logementData}
          occupant={occupantData}
          changeInProgress={false}
          onSubmit={handleSubmit}
        />
      </div>
    </BaseLayout>
  );
};

export default LogementEditPage;
