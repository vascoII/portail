"use client";
import React from "react";
import { useRouter } from "next/navigation";
import BaseLayout from "../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../components/Layout/Breadcrumb";
import InterventionCard from "../../../components/Cards/InterventionCard";
import { useInterventions } from "../../../hooks/useInterventions";

const InterventionDetailPage: React.FC = () => {
  const router = useRouter();
  const { id } = router.query;
  const { interventions, loading, error } = useInterventions();

  const intervention = interventions.find((i) => i.id === id);

  const breadcrumbItems = [
    { label: "Interventions", href: "/interventions" },
    { label: `Intervention ${intervention?.numero || id}` },
  ];

  if (loading) {
    return (
      <BaseLayout>
        <div className="text-center">
          <div className="spinner-border" role="status">
            <span className="sr-only">Chargement...</span>
          </div>
        </div>
      </BaseLayout>
    );
  }

  if (error || !intervention) {
    return (
      <BaseLayout>
        <div className="alert alert-danger">
          Erreur : {error || "Intervention non trouvée"}
        </div>
      </BaseLayout>
    );
  }

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Détail de l&apos;intervention</h2>

      <div className="row">
        <div className="col-md-8">
          <InterventionCard intervention={intervention} />
        </div>
      </div>
    </BaseLayout>
  );
};

export default InterventionDetailPage;
