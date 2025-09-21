import React from "react";
import BaseLayout from "../../components/Layout/BaseLayout";
import Breadcrumb from "../../components/Layout/Breadcrumb";
import Button from "../../components/UI/Button";
import Alert from "../../components/UI/Alert";

const OperatorsListPage: React.FC = () => {
  const breadcrumbItems = [
    { label: "Administration", href: "/admin" },
    { label: "Opérateurs" },
  ];

  // Données d'exemple pour les opérateurs
  const operators = [
    {
      id: "1",
      name: "Jean Dupont",
      email: "jean.dupont@techem.fr",
      role: "Administrateur",
      status: "Actif",
      lastConnection: "2024-01-15",
      createdAt: "2023-06-01",
    },
    {
      id: "2",
      name: "Marie Martin",
      email: "marie.martin@techem.fr",
      role: "Opérateur",
      status: "Actif",
      lastConnection: "2024-01-14",
      createdAt: "2023-08-15",
    },
    {
      id: "3",
      name: "Pierre Durand",
      email: "pierre.durand@techem.fr",
      role: "Technicien",
      status: "Inactif",
      lastConnection: "2024-01-10",
      createdAt: "2023-09-20",
    },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <div className="row">
        <div className="col-md-6">
          <h2>Gestion des opérateurs</h2>
        </div>
        <div className="col-md-6 text-right">
          <Button variant="primary" href="/operators/create">
            <i className="fa fa-plus"></i> Nouvel opérateur
          </Button>
        </div>
      </div>

      <div className="row">
        <div className="col-md-12">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Liste des opérateurs</h3>
            </div>
            <div className="panel-body">
              <div className="table-responsive">
                <table className="table table-striped">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Email</th>
                      <th>Rôle</th>
                      <th>Statut</th>
                      <th>Dernière connexion</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    {operators.map((operator) => (
                      <tr key={operator.id}>
                        <td>{operator.name}</td>
                        <td>{operator.email}</td>
                        <td>
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
                        </td>
                        <td>
                          <span
                            className={`label label-${
                              operator.status === "Actif"
                                ? "success"
                                : "default"
                            }`}
                          >
                            {operator.status}
                          </span>
                        </td>
                        <td>
                          {new Date(operator.lastConnection).toLocaleDateString(
                            "fr-FR"
                          )}
                        </td>
                        <td>
                          <div className="btn-group">
                            <Button
                              variant="info"
                              size="sm"
                              href={`/operators/${operator.id}/view`}
                            >
                              <i className="fa fa-eye"></i>
                            </Button>
                            <Button
                              variant="warning"
                              size="sm"
                              href={`/operators/${operator.id}/edit`}
                            >
                              <i className="fa fa-edit"></i>
                            </Button>
                          </div>
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </BaseLayout>
  );
};

export default OperatorsListPage;
