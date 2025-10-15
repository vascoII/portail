"use client";
import React from "react";
import { useRouter } from "next/navigation";
import BaseLayout from "../../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../../components/Layout/Breadcrumb";
import InterventionsList from "../../../../components/Lists/InterventionsList";
import { useInterventions } from "../../../../hooks/useInterventions";

const ImmeubleDysfunctionsPage: React.FC = () => {
  const router = useRouter();
  const { id } = router.query;
  const { interventions, loading, error } = useInterventions(id as string);

  // Filtrer les interventions pour ne garder que les dysfonctionnements
  const dysfunctions = interventions.filter(
    (intervention) =>
      intervention.type.toLowerCase().includes("dysfonctionnement") ||
      intervention.type.toLowerCase().includes("dysfunction")
  );

  const breadcrumbItems = [
    { label: "Le parc", href: "/pages/dashboard" },
    { label: `Immeuble ${id}`, href: `/pages/immeubles/${id}` },
    { label: "Dysfonctionnements" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Dysfonctionnements de l&apos;immeuble {id}</h2>

      <div className="row">
        <div className="col-md-12">
          <InterventionsList
            interventions={dysfunctions}
            loading={loading}
            error={error}
            showFilters={true}
          />
        </div>
      </div>
    </BaseLayout>
  );
};

export default ImmeubleDysfunctionsPage;
