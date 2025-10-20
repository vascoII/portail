"use client";

import React from "react";
import BaseLayout from "../../../src/components/Layout/BaseLayout";
import Breadcrumb from "../../../src/components/Layout/Breadcrumb";
import {
  ConsumptionSimulator,
  OccupantMenu,
} from "../../../src/components/Occupant";

const SimulateurPage: React.FC = () => {
  // Mock data - in a real app, this would come from an API
  const logementData = {
    Occupant: {
      Ref: "OCC-001",
    },
  };

  const breadcrumbItems = [
    { label: `Logement ${logementData.Occupant.Ref}`, href: "/occupant" },
    { label: "Simulateur de consommation", href: "/occupant/simulateur" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      {/* Occupant Menu */}
      <OccupantMenu logement={logementData} activeTab="simulateur" />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <ConsumptionSimulator />
      </div>
    </BaseLayout>
  );
};

export default SimulateurPage;
