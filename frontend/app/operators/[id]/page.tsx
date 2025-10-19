"use client";

import React from "react";
import { useParams } from "next/navigation";
import BaseLayout from "../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../components/Layout/Breadcrumb";
import { OperatorDetail } from "../../../components/Operator";

const OperatorDetailPage: React.FC = () => {
  const params = useParams();
  const id = params.id as string;

  // Mock data - in a real app, this would come from an API
  const operatorData = {
    PKUser: parseInt(id),
    UserName: `gestion${id}`,
    FirstName: "Jean",
    LastName: "Dupont",
    EMail: "jean.dupont@example.com",
    Phone: "0123456789",
    Job: "Gestionnaire",
    Adresse: "123 Rue de la Paix",
    Cp: "75001",
    Ville: "Paris",
  };

  const assignedBuildings = [
    {
      PkImmeuble: 1,
      Ref: "REF-001",
      Numero: "NUM-001",
      Adresse1: "123 Rue de la Paix",
      Cp: "75001",
      Ville: "Paris",
    },
    {
      PkImmeuble: 2,
      Ref: "REF-002",
      Numero: "NUM-002",
      Adresse1: "456 Avenue des Champs",
      Cp: "69001",
      Ville: "Lyon",
    },
    {
      PkImmeuble: 3,
      Ref: "REF-003",
      Numero: "NUM-003",
      Adresse1: "789 Boulevard Saint-Germain",
      Cp: "13001",
      Ville: "Marseille",
    },
  ];

  const availableBuildings = [
    {
      PkImmeuble: 4,
      Ref: "REF-004",
      Numero: "NUM-004",
      Adresse1: "321 Rue de Rivoli",
      Cp: "31000",
      Ville: "Toulouse",
    },
    {
      PkImmeuble: 5,
      Ref: "REF-005",
      Numero: "NUM-005",
      Adresse1: "654 Place de la République",
      Cp: "06000",
      Ville: "Nice",
    },
  ];

  const breadcrumbItems = [
    { label: "Liste des gestionnaires", href: "/operators" },
    {
      label: `${operatorData.FirstName} ${operatorData.LastName}`,
      href: `/operators/${id}`,
    },
  ];

  const handleAddBuildings = async (buildingIds: number[]) => {
    console.log("Adding buildings:", buildingIds);
    // In a real app, this would make an API call
    await new Promise((resolve) => setTimeout(resolve, 1000));
  };

  const handleRemoveBuildings = async (buildingIds: number[]) => {
    console.log("Removing buildings:", buildingIds);
    // In a real app, this would make an API call
    await new Promise((resolve) => setTimeout(resolve, 1000));
  };

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <OperatorDetail
          operator={operatorData}
          assignedBuildings={assignedBuildings}
          availableBuildings={availableBuildings}
          onAddBuildings={handleAddBuildings}
          onRemoveBuildings={handleRemoveBuildings}
        />
      </div>
    </BaseLayout>
  );
};

export default OperatorDetailPage;
