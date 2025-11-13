"use client";
import React, { useState } from "react";
import { useRouter } from "next/navigation";
import BaseLayout from "@/src/shared/components/Layout/BaseLayout";
import Breadcrumb from "@/src/shared/components/Layout/Breadcrumb";
import Button from "@/src/shared/components/UI/Button";
import Input from "@/src/shared/components/UI/Input";
import Select from "@/src/shared/components/UI/Select";
import Alert from "@/src/shared/components/UI/Alert";

const TicketDetailPage: React.FC = () => {
  const router = useRouter();
  const { id } = router.query;
  const [newComment, setNewComment] = useState("");
  const [loading, setLoading] = useState(false);

  // Données d'exemple pour le ticket
  const ticket = {
    id: id as string,
    title: "Problème de connexion",
    description:
      "Impossible de se connecter au portail depuis hier. L'erreur 'Connexion refusée' s'affiche.",
    status: "En cours",
    priority: "Haute",
    assignee: "Jean Dupont",
    createdAt: "2024-01-15",
    updatedAt: "2024-01-16",
    comments: [
      {
        id: "1",
        author: "Jean Dupont",
        content:
          "J'ai vérifié les logs, il semble y avoir un problème avec l'authentification.",
        createdAt: "2024-01-15 14:30",
      },
      {
        id: "2",
        author: "Marie Martin",
        content:
          "J'ai testé la connexion et tout fonctionne de mon côté. Pouvez-vous essayer de vider le cache ?",
        createdAt: "2024-01-16 09:15",
      },
    ],
  };

  const breadcrumbItems = [
    { label: "Support", href: "/support" },
    { label: "Tickets", href: "/tickets" },
    { label: `Ticket ${ticket.id}` },
  ];

  const handleAddComment = async (e: React.FormEvent) => {
    e.preventDefault();
    if (!newComment.trim()) return;

    setLoading(true);
    try {
      // Simulation de l'ajout d'un commentaire
      await new Promise((resolve) => setTimeout(resolve, 500));
      setNewComment("");
      // Ici, on pourrait mettre à jour la liste des commentaires
    } catch (err) {
      console.error("Erreur lors de l'ajout du commentaire");
    } finally {
      setLoading(false);
    }
  };

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
        <div className="col-md-8">
          <h2>Ticket {ticket.id}</h2>
        </div>
        <div className="col-md-4 text-right">
          <Button variant="info" href="/tickets">
            <i className="fa fa-arrow-left"></i> Retour
          </Button>
        </div>
      </div>

      <div className="row">
        <div className="col-md-8">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">{ticket.title}</h3>
            </div>
            <div className="panel-body">
              <p>{ticket.description}</p>

              <div className="row">
                <div className="col-md-6">
                  <strong>Statut:</strong>{" "}
                  <span className={`label ${getStatusClass(ticket.status)}`}>
                    {ticket.status}
                  </span>
                </div>
                <div className="col-md-6">
                  <strong>Priorité:</strong>{" "}
                  <span
                    className={`label ${getPriorityClass(ticket.priority)}`}
                  >
                    {ticket.priority}
                  </span>
                </div>
              </div>
              <div className="row">
                <div className="col-md-6">
                  <strong>Assigné à:</strong> {ticket.assignee}
                </div>
                <div className="col-md-6">
                  <strong>Créé le:</strong>{" "}
                  {new Date(ticket.createdAt).toLocaleDateString("fr-FR")}
                </div>
              </div>
            </div>
          </div>

          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Commentaires</h3>
            </div>
            <div className="panel-body">
              {ticket.comments.map((comment) => (
                <div key={comment.id} className="comment">
                  <div className="comment-header">
                    <strong>{comment.author}</strong>
                    <span className="text-muted pull-right">
                      {comment.createdAt}
                    </span>
                  </div>
                  <div className="comment-body">
                    <p>{comment.content}</p>
                  </div>
                  <hr />
                </div>
              ))}

              <form onSubmit={handleAddComment}>
                <div className="form-group">
                  <label htmlFor="newComment">Ajouter un commentaire</label>
                  <textarea
                    id="newComment"
                    className="form-control"
                    rows={3}
                    value={newComment}
                    onChange={(e) => setNewComment(e.target.value)}
                    placeholder="Votre commentaire..."
                    required
                  />
                </div>
                <Button
                  type="submit"
                  variant="primary"
                  loading={loading}
                  disabled={loading}
                >
                  {loading ? "Ajout..." : "Ajouter"}
                </Button>
              </form>
            </div>
          </div>
        </div>

        <div className="col-md-4">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Actions</h3>
            </div>
            <div className="panel-body">
              <div className="list-group">
                <a href="#" className="list-group-item">
                  <i className="fa fa-edit"></i> Modifier le statut
                </a>
                <a href="#" className="list-group-item">
                  <i className="fa fa-user"></i> Réassigner
                </a>
                <a href="#" className="list-group-item">
                  <i className="fa fa-close"></i> Fermer le ticket
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </BaseLayout>
  );
};

export default TicketDetailPage;
