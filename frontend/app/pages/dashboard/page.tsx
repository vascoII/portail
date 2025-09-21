"use client";

import React from "react";
import BaseLayout from "../../components/Layout/BaseLayout";
import Breadcrumb from "../../components/Layout/Breadcrumb";
import ImmeublesList from "../../components/Lists/ImmeublesList";
import { useImmeubles } from "../../hooks/useImmeubles";

const DashboardPage: React.FC = () => {
  const { immeubles, loading, error } = useImmeubles();

  const breadcrumbItems = [{ label: "Le parc", href: "/dashboard" }];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Liste des immeubles</h2>

      <ImmeublesList immeubles={immeubles} loading={loading} error={error} />
    </BaseLayout>
  );
};

export default DashboardPage;
