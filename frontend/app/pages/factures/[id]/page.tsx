"use client";
import React from "react";
import { useRouter } from "next/navigation";
import BaseLayout from "../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../components/Layout/Breadcrumb";

const FactureDetailPage: React.FC = () => {
  const router = useRouter();
  const { id } = router.query;

  const breadcrumbItems = [
    { label: "Factures", href: "/factures" },
    { label: `Facture ${id}` },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Détail de la facture</h2>

      <div className="panel panel-default">
        <div className="panel-body">
          <p>Détail de la facture {id} en cours de développement...</p>
        </div>
      </div>
    </BaseLayout>
  );
};

export default FactureDetailPage;
