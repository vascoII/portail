"use client";
import React from "react";
import { useRouter } from "next/navigation";
import BaseLayout from "@/components/Layout/BaseLayout";
import Breadcrumb from "@/components/Layout/Breadcrumb";
import InterventionsList from "@/components/Lists/InterventionsList";
import { useInterventions } from "@/hooks/useInterventions";

const LogementLeaksPage: React.FC = () => {
  const router = useRouter();
  const { id } = router.query;
  const { interventions, loading, error } = useInterventions(
    undefined,
    id as string
  );

  // Filtrer les interventions pour ne garder que les fuites
  const leaks = interventions.filter(
    (intervention) =>
      intervention.type.toLowerCase().includes("fuite") ||
      intervention.type.toLowerCase().includes("leak")
  );

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: `Logement ${id}`, href: `/logements/${id}` },
    { label: "Fuites" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Fuites du logement {id}</h2>

      <div className="row">
        <div className="col-md-12">
          <InterventionsList
            interventions={leaks}
            loading={loading}
            error={error}
            showFilters={true}
          />
        </div>
      </div>
    </BaseLayout>
  );
};

export default LogementLeaksPage;
