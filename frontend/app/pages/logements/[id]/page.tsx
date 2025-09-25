"use client";

import React from "react";
import { useParams, useSearchParams } from "next/navigation";
import BaseLayout from "../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../components/Layout/Breadcrumb";
import { LogementDetail, LogementMenu } from "../../../components/Logement";

const LogementDetailPage: React.FC = () => {
  const params = useParams();
  const searchParams = useSearchParams();
  const id = params.id as string;
  const gestion = searchParams.get("gestion") === "true";

  // Mock data - in a real app, this would come from an API
  const logementData = {
    Logement: {
      PkLogement: parseInt(id),
      Ref: `LOG-${id}`,
      NumOrdre: `L${id}`,
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
      PkOccupant: parseInt(id),
      Ref: `OCC-${id}`,
      Nom: `Occupant ${id}`,
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
    NbFuites: 1,
    NbAnomalies: 2,
    NbDysfonctionnements: 0,
    NbDepannages: 1,
    NbDepannagesTotal: 3,
    TicketsInterEnabled: true,
    NbTicketsInter: 1,
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
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      {/* Logement Menu */}
      <LogementMenu logement={logementData} />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <h2 className="text-2xl font-bold text-gray-900 mb-8">
          Aperçu du logement
        </h2>

        <LogementDetail
          logement={logementData}
          isGestionMode={gestion}
          showChgtOccupant={true}
        />
      </div>
    </BaseLayout>
  );
};

export default LogementDetailPage;
