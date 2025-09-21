"use client";
import React from "react";
import { useRouter } from "next/navigation";
import BaseLayout from "../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../components/Layout/Breadcrumb";
import LogementsList from "../../../components/Lists/LogementsList";
import { useLogements } from "../../../hooks/useLogements";

const ImmeubleDetailPage: React.FC = () => {
  const router = useRouter();
  const { id } = router.query;
  const { logements, loading, error } = useLogements(id as string);

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: `Immeuble ${id}`, href: `/immeubles/${id}` },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Détail de l'immeuble {id}</h2>

      <div className="row panel-area building-detail-area">
        <div className="col-md-12">
          <LogementsList
            logements={logements}
            loading={loading}
            error={error}
          />
        </div>
      </div>
    </BaseLayout>
  );
};

export default ImmeubleDetailPage;
