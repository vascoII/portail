"use client"

import React from "react";
import BaseLayout from "@/src/shared/components/Layout/BaseLayout";
import Breadcrumb from "@/src/shared/components/Layout/Breadcrumb";
import Button from "@/src/shared/components/UI/Button";
import Alert from "@/src/shared/components/UI/Alert";

const TicketsListPage: React.FC = () => {
  const breadcrumbItems = [
    { label: "Support", href: "/support" },
    { label: "Tickets" },
  ];

  // Données d'exemple pour les tickets
  const tickets = [
    {
      id: "TKT-001",
      title: "Problème de connexion",
      description: "Impossible de se connecter au portail",
      status: "Ouvert",
      priority: "Haute",
      assignee: "Jean Dupont",
      createdAt: "2024-01-15",
      updatedAt: "2024-01-15",
    },
    {
      id: "TKT-002",
      title: "Données manquantes",
      description: "Les données de consommation ne s'affichent pas",
      status: "En cours",
      priority: "Normale",
      assignee: "Marie Martin",
      createdAt: "2024-01-14",
      updatedAt: "2024-01-16",
    },
    {
      id: "TKT-003",
      title: "Erreur de facturation",
      description: "Montant incorrect sur la facture",
      status: "Fermé",
      priority: "Critique",
      assignee: "Pierre Durand",
      createdAt: "2024-01-10",
      updatedAt: "2024-01-12",
    },
  ];

  const getStatusClass = (status: string) => {
    switch (status) {
      case "Ouvert":
        return "label-warning";
      case "En cours":
        return "label-info";
      case "Fermé":
        return "label-success";
      default:
        return "label-default";
    }
  };

  const getPriorityClass = (priority: string) => {
    switch (priority) {
      case "Critique":
        return "label-danger";
      case "Haute":
        return "label-warning";
      case "Normale":
        return "label-primary";
      case "Basse":
        return "label-default";
      default:
        return "label-default";
    }
  };

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <div className="row">
        <div className="col-md-6">
          <h2>Gestion des tickets</h2>
        </div>
        <div className="col-md-6 text-right">
          <Button variant="primary" href="/tickets/create">
            <i className="fa fa-plus"></i> Nouveau ticket
          </Button>
        </div>
      </div>

      <div className="row">
        <div className="col-md-12">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Liste des tickets</h3>
            </div>
            <div className="panel-body">
              <div className="table-responsive">
                <table className="table table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Titre</th>
                      <th>Statut</th>
                      <th>Priorité</th>
                      <th>Assigné à</th>
                      <th>Créé le</th>
                      <th>Actions</th>
                    </tr>
                  </thead>
                  <tbody>
                    {tickets.map((ticket) => (
                      <tr key={ticket.id}>
                        <td>
                          <strong>{ticket.id}</strong>
                        </td>
                        <td>{ticket.title}</td>
                        <td>
                          <span
                            className={`label ${getStatusClass(ticket.status)}`}
                          >
                            {ticket.status}
                          </span>
                        </td>
                        <td>
                          <span
                            className={`label ${getPriorityClass(
                              ticket.priority
                            )}`}
                          >
                            {ticket.priority}
                          </span>
                        </td>
                        <td>{ticket.assignee}</td>
                        <td>
                          {new Date(ticket.createdAt).toLocaleDateString(
                            "fr-FR"
                          )}
                        </td>
                        <td>
                          <div className="btn-group">
                            <Button
                              variant="info"
                              size="sm"
                              href={`/tickets/${ticket.id}`}
                            >
                              <i className="fa fa-eye"></i>
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

export default TicketsListPage;
