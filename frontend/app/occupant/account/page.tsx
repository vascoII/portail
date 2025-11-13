"use client";

import React from "react";
import BaseLayout from "@/src/shared/components/Layout/BaseLayout";
import Breadcrumb from "@/src/shared/components/Layout/Breadcrumb";
import { OccupantAccount, OccupantMenu } from "@/src/features/occupant/components";

const AccountPage: React.FC = () => {
  // Mock data - in a real app, this would come from an API
  const logementData = {
    Occupant: {
      Ref: "OCC-001",
    },
  };

  const occupantData = {
    PkOccupant: 1,
    Ref: "OCC-001",
    Nom: "Jean Dupont",
    DateArrivee: "2024-01-15",
    Email: "jean.dupont@example.com",
    Telephone: "0123456789",
  };

  const breadcrumbItems = [
    { label: `Logement ${logementData.Occupant.Ref}`, href: "/occupant" },
    { label: "Mon compte", href: "/occupant/account" },
  ];

  const handleSave = (data: any) => {
    console.log("Account data saved:", data);
    // In a real app, this would save to the backend
  };

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      {/* Occupant Menu */}
      <OccupantMenu logement={logementData} activeTab="account" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <OccupantAccount occupant={occupantData} onSave={handleSave} />
      </div>
    </BaseLayout>
  );
};

export default AccountPage;
