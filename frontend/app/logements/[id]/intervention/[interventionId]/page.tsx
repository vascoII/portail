"use client";
import React from "react";
import { useRouter } from "next/navigation";
import BaseLayout from "../../../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../../../components/Layout/Breadcrumb";
import InterventionCard from "../../../../../components/Cards/InterventionCard";
import { useInterventions } from "../../../../../hooks/useInterventions";

const LogementInterventionDetailPage: React.FC = () => {
  const router = useRouter();
  const { id, interventionId } = router.query;
  const { interventions, loading, error } = useInterventions(
    undefined,
    id as string
  );

  const intervention = interventions.find((i) => i.id === interventionId);

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: `Logement ${id}`, href: `/logements/${id}` },
    { label: "Interventions", href: `/logements/${id}/interventions` },
    { label: `Intervention ${intervention?.numero || interventionId}` },
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
        <div className="col-md-4">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Actions</h3>
            </div>
            <div className="panel-body">
              <div className="list-group">
                <a
                  href={`/logements/${id}/interventions`}
                  className="list-group-item"
                >
                  <i className="fa fa-arrow-left"></i> Retour aux interventions
                </a>
                <a href={`/logements/${id}`} className="list-group-item">
                  <i className="fa fa-home"></i> Retour au logement
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </BaseLayout>
  );
};

export default LogementInterventionDetailPage;
