"use client";

import React, { useState } from "react";
import Link from "next/link";
import BaseLayout from "@/components/Layout/BaseLayout";
import Breadcrumb from "@/components/Layout/Breadcrumb";
import { OperatorFilters, OperatorList } from "@/components/Operator";

interface FilterState {
  search: string;
}

const OperatorsPage: React.FC = () => {
  const [filters, setFilters] = useState<FilterState>({
    search: "",
  });

  // Mock data - in a real app, this would come from an API
  const operators = [
    {
      PKUser: 1,
      UserName: "admin",
      FirstName: "Jean",
      LastName: "Dupont",
      EMail: "jean.dupont@example.com",
      Phone: "0123456789",
      Job: "Administrateur",
      NbImmeubles: 15,
      Adresse: "123 Rue de la Paix",
      Cp: "75001",
      Ville: "Paris",
    },
    {
      PKUser: 2,
      UserName: "gestion1",
      FirstName: "Marie",
      LastName: "Martin",
      EMail: "marie.martin@example.com",
      Phone: "0123456790",
      Job: "Gestionnaire",
      NbImmeubles: 8,
      Adresse: "456 Avenue des Champs",
      Cp: "69001",
      Ville: "Lyon",
    },
    {
      PKUser: 3,
      UserName: "gestion2",
      FirstName: "Pierre",
      LastName: "Durand",
      EMail: "pierre.durand@example.com",
      Phone: "0123456791",
      Job: "Gestionnaire",
      NbImmeubles: 12,
      Adresse: "789 Boulevard Saint-Germain",
      Cp: "13001",
      Ville: "Marseille",
    },
    {
      PKUser: 4,
      UserName: "tech1",
      FirstName: "Sophie",
      LastName: "Leroy",
      EMail: "sophie.leroy@example.com",
      Phone: "0123456792",
      Job: "Technicien",
      NbImmeubles: 5,
      Adresse: "321 Rue de Rivoli",
      Cp: "31000",
      Ville: "Toulouse",
    },
  ];

  const breadcrumbItems = [
    { label: "Liste des gestionnaires", href: "/operators" },
  ];

  const handleDelete = async (id: number) => {
    // In a real app, this would make an API call
    console.log("Deleting operator:", id);
    // Simulate API call
    await new Promise((resolve) => setTimeout(resolve, 1000));
  };

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div className="flex items-center justify-between mb-8">
          <h1 className="text-3xl font-bold text-gray-900">
            Gestion des gestionnaires
          </h1>
          <Link
            href="/operators/create"
            className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors duration-200 flex items-center"
          >
            <i className="fas fa-plus mr-2"></i>
            Créer un compte
          </Link>
        </div>

        <OperatorFilters onFiltersChange={setFilters} />

        <OperatorList
          operators={operators}
          filters={filters}
          loading={false}
          error={null}
          onDelete={handleDelete}
        />
      </div>
    </BaseLayout>
  );
};

export default OperatorsPage;
