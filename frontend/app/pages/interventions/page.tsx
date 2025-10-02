"use client"

import React from "react";
import BaseLayout from "../../components/Layout/BaseLayout";
import Breadcrumb from "../../components/Layout/Breadcrumb";
import InterventionsList from "../../components/Lists/InterventionsList";
import { useInterventions } from "../../hooks/useInterventions";

const InterventionsListPage: React.FC = () => {
  const { interventions, loading, error } = useInterventions();

  const breadcrumbItems = [{ label: "Interventions", href: "/interventions" }];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Liste des interventions</h2>

      <InterventionsList
        interventions={interventions}
        loading={loading}
        error={error}
        showFilters={true}
      />
    </BaseLayout>
  );
};

export default InterventionsListPage;
