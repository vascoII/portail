"use client";
import React from "react";
import { useRouter } from "next/navigation";
import BaseLayout from "@/src/shared/components/Layout/BaseLayout";
import Breadcrumb from "@/src/shared/components/Layout/Breadcrumb";
import InterventionsList from "@/src/features/intervention/components/InterventionsList";
import { useInterventions } from "@/src/features/intervention/hooks/useInterventions";

const ImmeubleInterventionsPage: React.FC = () => {
  const router = useRouter();
  const { id } = router.query;
  const { interventions, loading, error } = useInterventions(id as string);

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: `Immeuble ${id}`, href: `/immeubles/${id}` },
    { label: "Interventions" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Interventions de l&apos;immeuble {id}</h2>

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

export default ImmeubleInterventionsPage;
