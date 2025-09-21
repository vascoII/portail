"use client";
import React from "react";
import { useRouter } from "next/navigation";
import BaseLayout from "../../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../../components/Layout/Breadcrumb";
import AnomaliesList from "../../../../components/Lists/AnomaliesList";
import { useInterventions } from "../../../../hooks/useInterventions";

const LogementAnomaliesPage: React.FC = () => {
  const router = useRouter();
  const { id } = router.query;
  const { interventions, loading, error } = useInterventions(
    undefined,
    id as string
  );

  // Filtrer les interventions pour ne garder que les anomalies
  const anomalies = interventions.filter(
    (intervention) =>
      intervention.type.toLowerCase().includes("anomalie") ||
      intervention.type.toLowerCase().includes("anomaly")
  );

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: `Logement ${id}`, href: `/logements/${id}` },
    { label: "Anomalies" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Anomalies du logement {id}</h2>

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

export default LogementAnomaliesPage;
