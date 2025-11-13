"use client"

import React from "react";
import BaseLayout from "@/src/shared/components/Layout/BaseLayout";
import Breadcrumb from "@/src/shared/components/Layout/Breadcrumb";
import { useAuth } from "@/src/shared/hooks/useAuth";
import LogementsList from "@/components/Lists/LogementsList";
import { useLogements } from "@/hooks/useLogements";
import StatusPanel from "@/src/shared/components/Panels/StatusPanel";

const OccupantDashboardPage: React.FC = () => {
  const { user } = useAuth();
  const { logements, loading, error } = useLogements();

  // Filtrer les logements de l'occupant connecté
  const occupantLogements = logements.filter(
    (logement) => logement.occupant.id === user?.id
  );

  const breadcrumbItems = [
    { label: "Mon espace", href: "/occupant/dashboard" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Mon tableau de bord</h2>
      <p className="text-muted">
        Bienvenue {user?.name || user?.firstName || "Occupant"}
      </p>

      <div className="row">
        <div className="col-md-12">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Mes logements</h3>
            </div>
            <div className="panel-body">
              <LogementsList
                logements={occupantLogements}
                loading={loading}
                error={error}
              />
            </div>
          </div>
        </div>
      </div>

      <div className="row">
        <div className="col-md-4">
          <StatusPanel
            title="Consommation eau"
            value={75}
            maxValue={100}
            color="#2196F3"
            isActive={true}
          />
        </div>
        <div className="col-md-4">
          <StatusPanel
            title="Consommation chauffage"
            value={60}
            maxValue={100}
            color="#FF9800"
            isActive={true}
          />
        </div>
        <div className="col-md-4">
          <StatusPanel
            title="Consommation électricité"
            value={85}
            maxValue={100}
            color="#4CAF50"
            isActive={true}
          />
        </div>
      </div>

      <div className="row">
        <div className="col-md-12">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Actions rapides</h3>
            </div>
            <div className="panel-body">
              <div className="row">
                <div className="col-md-3">
                  <a
                    href="/occupant/alertes"
                    className="btn btn-primary btn-block"
                  >
                    <i className="fa fa-bell"></i> Mes alertes
                  </a>
                </div>
                <div className="col-md-3">
                  <a
                    href="/occupant/simulateur"
                    className="btn btn-info btn-block"
                  >
                    <i className="fa fa-calculator"></i> Simulateur
                  </a>
                </div>
                <div className="col-md-3">
                  <a
                    href="/occupant/account"
                    className="btn btn-success btn-block"
                  >
                    <i className="fa fa-user"></i> Mon compte
                  </a>
                </div>
                <div className="col-md-3">
                  <a href="/search" className="btn btn-warning btn-block">
                    <i className="fa fa-search"></i> Recherche
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </BaseLayout>
  );
};

export default OccupantDashboardPage;
