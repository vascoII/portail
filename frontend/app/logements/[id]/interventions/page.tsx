"use client";
import React from "react";
import { useRouter } from "next/navigation";
import BaseLayout from "@/src/shared/components/Layout/BaseLayout";
import Breadcrumb from "@/src/shared/components/Layout/Breadcrumb";
import InterventionsList from "@/src/features/intervention/components/InterventionsList";
import { useInterventions } from "@/src/features/intervention/hooks/useInterventions";

const LogementInterventionsPage: React.FC = () => {
  const router = useRouter();
  const { id } = router.query;
  const { interventions, loading, error } = useInterventions(
    undefined,
    id as string
  );

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: `Logement ${id}`, href: `/logements/${id}` },
    { label: "Interventions" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Interventions du logement {id}</h2>

      <div className="row">
        <div className="col-md-12">
          <InterventionsList
            interventions={interventions}
            loading={loading}
            error={error}
            showFilters={true}
          />
        </div>
      </div>
    </BaseLayout>
  );
};

export default LogementInterventionsPage;
