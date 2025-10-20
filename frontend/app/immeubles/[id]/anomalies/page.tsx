"use client";
import React from "react";
import { useRouter } from "next/navigation";
import BaseLayout from "@/components/Layout/BaseLayout";
import Breadcrumb from "@/components/Layout/Breadcrumb";
import AnomaliesList from "@/components/Lists/AnomaliesList";
import { useInterventions } from "@/hooks/useInterventions";

const ImmeubleAnomaliesPage: React.FC = () => {
  const router = useRouter();
  const { id } = router.query;
  const { interventions, loading, error } = useInterventions(id as string);

  // Filtrer les interventions pour ne garder que les anomalies
  const anomalies = interventions.filter(
    (intervention) =>
      intervention.type.toLowerCase().includes("anomalie") ||
      intervention.type.toLowerCase().includes("anomaly")
  );

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: `Immeuble ${id}`, href: `/immeubles/${id}` },
    { label: "Anomalies" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Anomalies de l&apos;immeuble {id}</h2>

      <div className="row">
        <div className="col-md-12">
          <AnomaliesList
            anomalies={anomalies}
            loading={loading}
            error={error}
            showFilters={true}
          />
        </div>
      </div>
    </BaseLayout>
  );
};

export default ImmeubleAnomaliesPage;
