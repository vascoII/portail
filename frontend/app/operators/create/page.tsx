"use client";

import React from "react";
import BaseLayout from "@/src/shared/components/Layout/BaseLayout";
import Breadcrumb from "@/src/shared/components/Layout/Breadcrumb";
import { OperatorForm } from "@/src/features/operator/components";

const CreateOperatorPage: React.FC = () => {
  const breadcrumbItems = [
    { label: "Liste des gestionnaires", href: "/operators" },
    { label: "Création de compte", href: "/operators/create" },
  ];

  const handleSubmit = async (data: any) => {
    console.log("Creating operator:", data);
    // In a real app, this would make an API call
    await new Promise((resolve) => setTimeout(resolve, 2000));
  };

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <OperatorForm onSubmit={handleSubmit} isEdit={false} />
      </div>
    </BaseLayout>
  );
};

export default CreateOperatorPage;
