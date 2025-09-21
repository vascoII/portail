import React from "react";
import BaseLayout from "../../components/Layout/BaseLayout";
import Breadcrumb from "../../components/Layout/Breadcrumb";
import SearchForm from "../../components/Forms/SearchForm";

const SearchPage: React.FC = () => {
  const breadcrumbItems = [{ label: "Recherche", href: "/search" }];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Recherche</h2>

      <div className="panel panel-default">
        <div className="panel-body">
          <SearchForm isCodeForm={false} />
        </div>
      </div>
    </BaseLayout>
  );
};

export default SearchPage;
