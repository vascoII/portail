"use client";
import React from "react";
import { useRouter } from "next/navigation";
import BaseLayout from "@/src/shared/components/Layout/BaseLayout";
import Breadcrumb from "@/src/shared/components/Layout/Breadcrumb";
import Button from "@/src/shared/components/UI/Button";
import Alert from "@/src/shared/components/UI/Alert";

const OperatorViewPage: React.FC = () => {
  const router = useRouter();
  const { id } = router.query;

  // Données d'exemple pour l'opérateur
  const operator = {
    id: id as string,
    name: "Dupont",
    firstName: "Jean",
    email: "jean.dupont@techem.fr",
    phone: "01 23 45 67 89",
    role: "Administrateur",
    status: "Actif",
    lastConnection: "2024-01-15",
    createdAt: "2023-06-01",
    nbConnections: 156,
    nbActions: 1247,
  };

  const breadcrumbItems = [
    { label: "Administration", href: "/admin" },
    { label: "Opérateurs", href: "/operators" },
    { label: `${operator.firstName} ${operator.name}` },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <div className="row">
        <div className="col-md-6">
          <h2>Détail de l'opérateur</h2>
        </div>
        <div className="col-md-6 text-right">
          <Button
            variant="warning"
            href={`/operators/${id}/edit`}
            className="mr-2"
          >
            <i className="fa fa-edit"></i> Modifier
          </Button>
          <Button variant="info" href="/operators">
            <i className="fa fa-arrow-left"></i> Retour
          </Button>
        </div>
      </div>

      <div className="row">
        <div className="col-md-8">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Informations personnelles</h3>
            </div>
            <div className="panel-body">
              <div className="row">
                <div className="col-md-6">
                  <div className="form-group">
                    <label>Nom</label>
                    <p className="form-control-static">{operator.name}</p>
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="form-group">
                    <label>Prénom</label>
                    <p className="form-control-static">{operator.firstName}</p>
                  </div>
                </div>
              </div>
              <div className="row">
                <div className="col-md-6">
                  <div className="form-group">
                    <label>Email</label>
                    <p className="form-control-static">{operator.email}</p>
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="form-group">
                    <label>Téléphone</label>
                    <p className="form-control-static">{operator.phone}</p>
                  </div>
                </div>
              </div>
              <div className="row">
                <div className="col-md-6">
                  <div className="form-group">
                    <label>Rôle</label>
                    <p className="form-control-static">
                      <span
                        className={`label label-${
                          operator.role === "Administrateur"
                            ? "danger"
                            : operator.role === "Opérateur"
                            ? "primary"
                            : "info"
                        }`}
                      >
                        {operator.role}
                      </span>
                    </p>
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="form-group">
                    <label>Statut</label>
                    <p className="form-control-static">
                      <span
                        className={`label label-${
                          operator.status === "Actif" ? "success" : "default"
                        }`}
                      >
                        {operator.status}
                      </span>
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div className="col-md-4">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Statistiques</h3>
            </div>
            <div className="panel-body">
              <div className="row">
                <div className="col-md-6">
                  <div className="stat-box text-center">
                    <h4>{operator.nbConnections}</h4>
                    <p>Connexions</p>
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="stat-box text-center">
                    <h4>{operator.nbActions}</h4>
                    <p>Actions</p>
                  </div>
                </div>
              </div>
              <hr />
              <div className="form-group">
                <label>Dernière connexion</label>
                <p className="form-control-static">
                  {new Date(operator.lastConnection).toLocaleDateString(
                    "fr-FR"
                  )}
                </p>
              </div>
              <div className="form-group">
                <label>Date de création</label>
                <p className="form-control-static">
                  {new Date(operator.createdAt).toLocaleDateString("fr-FR")}
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </BaseLayout>
  );
};

export default OperatorViewPage;
