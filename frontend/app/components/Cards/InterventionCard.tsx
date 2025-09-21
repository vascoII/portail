import React from "react";
import Link from "next/link";

interface Intervention {
  id: string;
  numero: string;
  dateCreation: string;
  statut: "ouvert" | "en_cours" | "ferme";
  type: string;
  description: string;
  priorite: "basse" | "normale" | "haute" | "critique";
  technicien?: string;
  dateIntervention?: string;
}

interface InterventionCardProps {
  intervention: Intervention;
  className?: string;
}

const InterventionCard: React.FC<InterventionCardProps> = ({
  intervention,
  className = "",
}) => {
  const getStatusClass = (statut: string) => {
    switch (statut) {
      case "ouvert":
        return "status-open";
      case "en_cours":
        return "status-in-progress";
      case "ferme":
        return "status-closed";
      default:
        return "status-unknown";
    }
  };

  const getPriorityClass = (priorite: string) => {
    switch (priorite) {
      case "critique":
        return "priority-critical";
      case "haute":
        return "priority-high";
      case "normale":
        return "priority-normal";
      case "basse":
        return "priority-low";
      default:
        return "priority-normal";
    }
  };

  return (
    <div className={`panel panel-default intervention-card ${className}`}>
      <div className="panel-heading">
        <div className="row">
          <div className="col-md-8">
            <h4 className="panel-title">Intervention #{intervention.numero}</h4>
          </div>
          <div className="col-md-4 text-right">
            <span className={`badge ${getStatusClass(intervention.statut)}`}>
              {intervention.statut.replace("_", " ").toUpperCase()}
            </span>
          </div>
        </div>
      </div>

      <div className="panel-body">
        <div className="row">
          <div className="col-md-6">
            <p>
              <strong>Type :</strong> {intervention.type}
            </p>
            <p>
              <strong>Date de création :</strong> {intervention.dateCreation}
            </p>
            {intervention.dateIntervention && (
              <p>
                <strong>Date d'intervention :</strong>{" "}
                {intervention.dateIntervention}
              </p>
            )}
          </div>
          <div className="col-md-6">
            <p>
              <strong>Priorité :</strong>
              <span
                className={`priority ${getPriorityClass(
                  intervention.priorite
                )}`}
              >
                {intervention.priorite.toUpperCase()}
              </span>
            </p>
            {intervention.technicien && (
              <p>
                <strong>Technicien :</strong> {intervention.technicien}
              </p>
            )}
          </div>
        </div>

        <div className="row">
          <div className="col-md-12">
            <p>
              <strong>Description :</strong>
            </p>
            <p className="description">{intervention.description}</p>
          </div>
        </div>
      </div>

      <div className="panel-footer">
        <Link
          href={`/interventions/${intervention.id}`}
          className="btn btn-primary btn-sm"
        >
          Voir les détails
        </Link>
      </div>
    </div>
  );
};

export default InterventionCard;
