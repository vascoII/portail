"use client";

import React from "react";
import BaseLayout from "@/src/shared/components/Layout/BaseLayout";
import Breadcrumb from "@/src/shared/components/Layout/Breadcrumb";
import { OperatorStats } from "@/components/Operator";

const OperatorStatsPage: React.FC = () => {
  // Mock data - in a real app, this would come from an API
  const statsData = [
    { date: "2024-01-01", value: 150 },
    { date: "2024-02-01", value: 180 },
    { date: "2024-03-01", value: 165 },
    { date: "2024-04-01", value: 200 },
    { date: "2024-05-01", value: 220 },
    { date: "2024-06-01", value: 190 },
    { date: "2024-07-01", value: 210 },
    { date: "2024-08-01", value: 240 },
    { date: "2024-09-01", value: 230 },
    { date: "2024-10-01", value: 250 },
    { date: "2024-11-01", value: 270 },
    { date: "2024-12-01", value: 280 },
  ];

  const breadcrumbItems = [
    { label: "Gestionnaire", href: "/operators" },
    { label: "Statistiques de connexion", href: "/operators/stats" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />

      <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <OperatorStats stats={statsData} />
      </div>
    </BaseLayout>
  );
};

export default OperatorStatsPage;
