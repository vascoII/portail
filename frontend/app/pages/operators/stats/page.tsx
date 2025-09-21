import React from "react";
import BaseLayout from "../../components/Layout/BaseLayout";
import Breadcrumb from "../../components/Layout/Breadcrumb";

const OperatorsStatsPage: React.FC = () => {
  const breadcrumbItems = [
    { label: "Administration", href: "/admin" },
    { label: "Opérateurs", href: "/operators" },
    { label: "Statistiques" },
  ];

  // Données d'exemple pour les statistiques
  const stats = {
    totalOperators: 25,
    activeOperators: 22,
    inactiveOperators: 3,
    totalConnections: 1247,
    avgConnectionsPerDay: 45,
    topOperators: [
      { name: "Jean Dupont", connections: 156, actions: 1247 },
      { name: "Marie Martin", connections: 142, actions: 1103 },
      { name: "Pierre Durand", connections: 128, actions: 987 },
    ],
  };

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Statistiques des connexions</h2>

      <div className="row">
        <div className="col-md-3">
          <div className="panel panel-primary">
            <div className="panel-heading">
              <h3 className="panel-title">Total opérateurs</h3>
            </div>
            <div className="panel-body">
              <h2 className="text-center">{stats.totalOperators}</h2>
            </div>
          </div>
        </div>
        <div className="col-md-3">
          <div className="panel panel-success">
            <div className="panel-heading">
              <h3 className="panel-title">Actifs</h3>
            </div>
            <div className="panel-body">
              <h2 className="text-center">{stats.activeOperators}</h2>
            </div>
          </div>
        </div>
        <div className="col-md-3">
          <div className="panel panel-warning">
            <div className="panel-heading">
              <h3 className="panel-title">Inactifs</h3>
            </div>
            <div className="panel-body">
              <h2 className="text-center">{stats.inactiveOperators}</h2>
            </div>
          </div>
        </div>
        <div className="col-md-3">
          <div className="panel panel-info">
            <div className="panel-heading">
              <h3 className="panel-title">Connexions totales</h3>
            </div>
            <div className="panel-body">
              <h2 className="text-center">{stats.totalConnections}</h2>
            </div>
          </div>
        </div>
      </div>

      <div className="row">
        <div className="col-md-6">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Top opérateurs</h3>
            </div>
            <div className="panel-body">
              <div className="table-responsive">
                <table className="table table-striped">
                  <thead>
                    <tr>
                      <th>Nom</th>
                      <th>Connexions</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    {stats.topOperators.map((operator, index) => (
                      <tr key={index}>
                        <td>{operator.name}</td>
                        <td>
                          <span className="badge badge-primary">
                            {operator.connections}
                          </span>
                        </td>
                        <td>
                          <span className="badge badge-success">
                            {operator.actions}
                          </span>
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <div className="col-md-6">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Moyennes</h3>
            </div>
            <div className="panel-body">
              <div className="row">
                <div className="col-md-6">
                  <div className="stat-box text-center">
                    <h3>{stats.avgConnectionsPerDay}</h3>
                    <p>Connexions/jour</p>
                  </div>
                </div>
                <div className="col-md-6">
                  <div className="stat-box text-center">
                    <h3>
                      {(stats.totalConnections / stats.totalOperators).toFixed(
                        1
                      )}
                    </h3>
                    <p>Connexions/opérateur</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </BaseLayout>
  );
};

export default OperatorsStatsPage;
