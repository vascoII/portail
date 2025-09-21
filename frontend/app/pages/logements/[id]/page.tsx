"use client";
import React from "react";
import { useRouter } from "next/navigation";
import BaseLayout from "../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../components/Layout/Breadcrumb";
import LogementCard from "../../../components/Cards/LogementCard";
import StatusPanel from "../../../components/Panels/StatusPanel";
import WaterPanel from "../../../components/Energy/WaterPanel";
import HeatingPanel from "../../../components/Energy/HeatingPanel";
import { useLogements } from "../../../hooks/useLogements";
import { useConsumption } from "../../../hooks/useConsumption";

const LogementDetailPage: React.FC = () => {
  const router = useRouter();
  const { id } = router.query;
  const { logements, loading, error } = useLogements();
  const { data: waterData } = useConsumption(id as string, "eau");
  const { data: heatingData } = useConsumption(id as string, "chauffage");

  const logement = logements.find((l) => l.id === id);

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    { label: `Logement ${logement?.occupant.ref || id}` },
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

  if (error || !logement) {
    return (
      <BaseLayout>
        <div className="alert alert-danger">
          Erreur : {error || "Logement non trouvé"}
        </div>
      </BaseLayout>
    );
  }

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Aperçu du logement</h2>

      <div className="row panel-area building-detail-area">
        <div className="col-md-8 col-sm-6 block block-1">
          <LogementCard logement={logement} />
        </div>

        <div className="col-md-4 col-sm-6 block block-2">
          <StatusPanel
            title="Statut"
            value={75}
            maxValue={100}
            color="#4CAF50"
            isActive={true}
          />
        </div>
      </div>

      <div className="row panel-area">
        <div className="col-md-12">
          <ul className="nav nav-tabs" role="tablist">
            <li role="presentation" className="active">
              <a
                href="#tab-1"
                aria-controls="home"
                role="tab"
                data-toggle="tab"
              >
                <div className="inner">
                  <span className="icon icon-water94"></span>
                  <span className="text">Eau froide</span>
                </div>
              </a>
            </li>
            <li role="presentation">
              <a
                href="#tab-2"
                aria-controls="home"
                role="tab"
                data-toggle="tab"
              >
                <div className="inner">
                  <span className="icon icon-water94"></span>
                  <span className="text">Eau chaude</span>
                </div>
              </a>
            </li>
            <li role="presentation">
              <a
                href="#tab-3"
                aria-controls="home"
                role="tab"
                data-toggle="tab"
              >
                <div className="inner">
                  <span className="icon icon-squares36"></span>
                  <span className="text">Chauffage</span>
                </div>
              </a>
            </li>
            <li role="presentation">
              <a
                href="#tab-4"
                aria-controls="home"
                role="tab"
                data-toggle="tab"
              >
                <div className="inner">
                  <span className="icon icon-speedometer10"></span>
                  <span className="text">Électricité</span>
                </div>
              </a>
            </li>
          </ul>

          <div className="tab-content">
            <div role="tabpanel" className="tab-pane active" id="tab-1">
              <WaterPanel
                title="Eau froide"
                data={waterData}
                color="#2196F3"
                nbCompteurs={1}
              />
            </div>
            <div role="tabpanel" className="tab-pane" id="tab-2">
              <WaterPanel
                title="Eau chaude"
                data={waterData}
                color="#FF9800"
                nbCompteurs={1}
              />
            </div>
            <div role="tabpanel" className="tab-pane" id="tab-3">
              <HeatingPanel
                title="Chauffage"
                data={heatingData}
                color="#4CAF50"
                nbCompteurs={1}
              />
            </div>
            <div role="tabpanel" className="tab-pane" id="tab-4">
              <div className="panel panel-default">
                <div className="panel-body">
                  <p>Données d'électricité en cours de développement...</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </BaseLayout>
  );
};

export default LogementDetailPage;
