"use client";

import React from "react";
import { useParams } from "next/navigation";
import BaseLayout from "@/src/shared/components/Layout/BaseLayout";
import Breadcrumb from "@/src/shared/components/Layout/Breadcrumb";
import { OperatorForm } from "@/components/Operator";

const EditOperatorPage: React.FC = () => {
  const params = useParams();
  const id = params.id as string;

  // Mock data - in a real app, this would come from an API
  const operatorData = {
    job: "Gestionnaire",
    lastname: "Dupont",
    firstname: "Jean",
    phone: "0123456789",
    email: "jean.dupont@example.com",
    emailConfirm: "jean.dupont@example.com",
  };

  const breadcrumbItems = [
    { label: "Liste des gestionnaires", href: "/operators" },
    { label: `Utilisateur #${id}`, href: `/operators/${id}` },
    { label: "Édition", href: `/operators/${id}/edit` },
  ];

  const handleSubmit = async (data: any) => {
    console.log("Updating operator:", data);
    // In a real app, this would make an API call
    await new Promise((resolve) => setTimeout(resolve, 2000));
  };

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <OperatorForm
          initialData={operatorData}
          onSubmit={handleSubmit}
          isEdit={true}
        />
      </div>
    </BaseLayout>
  );
};

export default EditOperatorPage;
