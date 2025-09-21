import React from "react";
import BaseLayout from "../../components/Layout/BaseLayout";
import Breadcrumb from "../../components/Layout/Breadcrumb";
import LogementsList from "../../components/Lists/LogementsList";
import { useLogements } from "../../hooks/useLogements";

const LogementsListPage: React.FC = () => {
  const { logements, loading, error } = useLogements();

  const breadcrumbItems = [{ label: "Logements", href: "/logements" }];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Liste des logements</h2>

      <LogementsList logements={logements} loading={loading} error={error} />
    </BaseLayout>
  );
};

export default LogementsListPage;
