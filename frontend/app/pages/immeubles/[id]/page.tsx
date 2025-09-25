"use client";

import React from "react";
import { useParams } from "next/navigation";
import BaseLayout from "../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../components/Layout/Breadcrumb";
import { ImmeubleDetail, ImmeubleMenu } from "../../../components/Immeuble";

const ImmeubleDetailPage: React.FC = () => {
  const params = useParams();
  const id = params.id as string;

  // Mock data - in a real app, this would come from an API
  const immeubleData = {
    Immeuble: {
      PkImmeuble: parseInt(id),
      Ref: `REF-${id}`,
      Numero: `NUM-${id}`,
      Nom: `Immeuble ${id}`,
      Adresse1: "123 Rue de la Paix",
      Adresse2: "Bâtiment A",
      Adresse3: "",
      Cp: "75001",
      Ville: "Paris",
      HasTelereleve: true,
      HasTransfertFichiers: true,
    },
    NbLogements: 24,
    NbAppareils: 48,
    NbCompteursEF: 24,
    NbCompteursEC: 24,
    NbCompteursRepart: 0,
    NbCompteursCET: 0,
    NbCompteursElect: 0,
    NbCompteursGaz: 0,
    NbCompteursCapteur: 0,
    NbFuites: 2,
    NbAnomalies: 5,
    NbDysfonctionnements: 1,
    NbDepannages: 1,
    NbDepannagesTotal: 3,
    GPS: {
      x: 2.3522,
      y: 48.8566,
    },
  };

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: "Liste des immeubles", href: "/immeubles" },
    {
      label: `Immeuble ${immeubleData.Immeuble.Ref}`,
      href: `/immeubles/${id}`,
    },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      {/* Immeuble Menu */}
      <ImmeubleMenu immeuble={immeubleData} />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 className="text-2xl font-bold text-gray-900 mb-8">
          Aperçu de l'immeuble {immeubleData.Immeuble.Ref}
        </h2>

        <ImmeubleDetail immeuble={immeubleData} isDemo={true} />
      </div>
    </BaseLayout>
  );
};

export default ImmeubleDetailPage;
