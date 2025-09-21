import React from "react";
import BaseLayout from "../../components/Layout/BaseLayout";
import Breadcrumb from "../../components/Layout/Breadcrumb";

const FacturesListPage: React.FC = () => {
  const breadcrumbItems = [{ label: "Factures", href: "/factures" }];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Liste des factures</h2>

      <div className="panel panel-default">
        <div className="panel-body">
          <p>Page des factures en cours de développement...</p>
        </div>
      </div>
    </BaseLayout>
  );
};

export default FacturesListPage;
