import React from "react";
import BaseLayout from "../../components/Layout/BaseLayout";
import Breadcrumb from "../../components/Layout/Breadcrumb";
import Alert from "../../components/UI/Alert";

const OccupantAlertesPage: React.FC = () => {
  const breadcrumbItems = [
    { label: "Mon espace", href: "/occupant/dashboard" },
    { label: "Mes alertes" },
  ];

  // Données d'exemple pour les alertes
  const alertes = [
    {
      id: "1",
      type: "warning",
      title: "Consommation d'eau élevée",
      message: "Votre consommation d'eau a augmenté de 15% ce mois",
      date: "2024-01-15",
      isRead: false,
    },
    {
      id: "2",
      type: "info",
      title: "Maintenance programmée",
      message: "Une maintenance est prévue le 20 janvier 2024",
      date: "2024-01-10",
      isRead: true,
    },
    {
      id: "3",
      type: "success",
      title: "Facture disponible",
      message: "Votre facture de décembre 2023 est disponible",
      date: "2024-01-05",
      isRead: true,
    },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Mes alertes</h2>

      <div className="row">
        <div className="col-md-12">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Notifications</h3>
            </div>
            <div className="panel-body">
              {alertes.length === 0 ? (
                <div className="text-center text-muted">
                  <i className="fa fa-bell-slash fa-3x"></i>
                  <p>Aucune alerte pour le moment</p>
                </div>
              ) : (
                <div className="list-group">
                  {alertes.map((alerte) => (
                    <div
                      key={alerte.id}
                      className={`list-group-item ${
                        !alerte.isRead ? "unread" : ""
                      }`}
                    >
                      <div className="row">
                        <div className="col-md-1">
                          <i
                            className={`fa fa-${
                              alerte.type === "warning"
                                ? "exclamation-triangle"
                                : alerte.type === "info"
                                ? "info-circle"
                                : "check-circle"
                            } text-${alerte.type}`}
                          ></i>
                        </div>
                        <div className="col-md-8">
                          <h5 className="list-group-item-heading">
                            {alerte.title}
                          </h5>
                          <p className="list-group-item-text">
                            {alerte.message}
                          </p>
                        </div>
                        <div className="col-md-3 text-right">
                          <small className="text-muted">
                            {new Date(alerte.date).toLocaleDateString("fr-FR")}
                          </small>
                        </div>
                      </div>
                    </div>
                  ))}
                </div>
              )}
            </div>
          </div>
        </div>
      </div>
    </BaseLayout>
  );
};

export default OccupantAlertesPage;
