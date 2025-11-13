"use client";

import React from "react";
import BaseLayout from "@/src/shared/components/Layout/BaseLayout";
import Breadcrumb from "@/src/shared/components/Layout/Breadcrumb";
import { AlertSettings, OccupantMenu } from "@/src/features/occupant/components";

const AlertesPage: React.FC = () => {
  // Mock data - in a real app, this would come from an API
  const logementData = {
    Occupant: {
      Ref: "OCC-001",
    },
  };

  const initialSettings = {
    seuilConsoActif: false,
    seuilConsoEmail: "jean.dupont@example.com",
    seuilConsoEF: 50,
    seuilConsoEC: 30,
  };

  const breadcrumbItems = [
    { label: `Logement ${logementData.Occupant.Ref}`, href: "/occupant" },
    { label: "Mes alertes", href: "/occupant/alertes" },
  ];

  const handleSave = (settings: any) => {
    console.log("Alert settings saved:", settings);
    // In a real app, this would save to the backend
  };

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      {/* Occupant Menu */}
      <OccupantMenu logement={logementData} activeTab="alertes" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <AlertSettings initialSettings={initialSettings} onSave={handleSave} />
      </div>
    </BaseLayout>
  );
};

export default AlertesPage;
