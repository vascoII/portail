import React from "react";
import Link from "next/link";

interface Anomalie {
  id: string;
  numero: string;
  dateCreation: string;
  type: string;
  description: string;
  statut: "ouverte" | "en_cours" | "resolue";
  priorite: "basse" | "normale" | "haute" | "critique";
  immeuble?: string;
  logement?: string;
}

interface AnomaliesListProps {
  anomalies: Anomalie[];
  loading?: boolean;
  error?: string;
  className?: string;
  showFilters?: boolean;
  onFilterChange?: (filters: {
    statut?: string;
    priorite?: string;
    type?: string;
  }) => void;
}

const AnomaliesList: React.FC<AnomaliesListProps> = ({
  anomalies,
  loading = false,
  error,
  className = "",
  showFilters = false,
  onFilterChange,
}) => {
  const [filters, setFilters] = React.useState({
    statut: "",
    priorite: "",
    type: "",
  });

  const handleFilterChange = (key: string, value: string) => {
    const newFilters = { ...filters, [key]: value };
    setFilters(newFilters);
    onFilterChange?.(newFilters);
  };

  const getStatusClass = (statut: string) => {
    switch (statut) {
      case "ouverte":
        return "status-open";
      case "en_cours":
        return "status-in-progress";
      case "resolue":
        return "status-resolved";
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

  if (loading) {
    return (
      <div className={`anomalies-list ${className}`}>
        <div className="text-center">
          <div className="spinner-border" role="status">
            <span className="sr-only">Chargement...</span>
          </div>
        </div>
      </div>
    );
  }

  if (error) {
    return (
      <div className={`anomalies-list ${className}`}>
        <div className="alert alert-danger" role="alert">
          {error}
        </div>
      </div>
    );
  }

  if (anomalies.length === 0) {
    return (
      <div className={`anomalies-list ${className}`}>
        <div className="text-center">
          <p>Aucune anomalie trouvée.</p>
        </div>
      </div>
    );
  }

  return (
    <div className={`anomalies-list ${className}`}>
      {showFilters && (
        <div className="filters mb-4">
          <div className="row">
            <div className="col-md-4">
              <select
                className="form-control"
                value={filters.statut}
                onChange={(e) => handleFilterChange("statut", e.target.value)}
              >
                <option value="">Tous les statuts</option>
                <option value="ouverte">Ouverte</option>
                <option value="en_cours">En cours</option>
                <option value="resolue">Résolue</option>
              </select>
            </div>
            <div className="col-md-4">
              <select
                className="form-control"
                value={filters.priorite}
                onChange={(e) => handleFilterChange("priorite", e.target.value)}
              >
                <option value="">Toutes les priorités</option>
                <option value="basse">Basse</option>
                <option value="normale">Normale</option>
                <option value="haute">Haute</option>
                <option value="critique">Critique</option>
              </select>
            </div>
            <div className="col-md-4">
              <input
                type="text"
                className="form-control"
                placeholder="Type d&apos;anomalie"
                value={filters.type}
                onChange={(e) => handleFilterChange("type", e.target.value)}
              />
            </div>
          </div>
        </div>
      )}

      <div className="table-responsive">
        <table className="table table-striped">
          <thead>
            <tr>
              <th>N°</th>
              <th>Type</th>
              <th>Description</th>
              <th>Statut</th>
              <th>Priorité</th>
              <th>Date</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            {anomalies.map((anomalie) => (
              <tr key={anomalie.id}>
                <td>{anomalie.numero}</td>
                <td>{anomalie.type}</td>
                <td>{anomalie.description}</td>
                <td>
                  <span className={`badge ${getStatusClass(anomalie.statut)}`}>
                    {anomalie.statut.replace("_", " ").toUpperCase()}
                  </span>
                </td>
                <td>
                  <span
                    className={`priority ${getPriorityClass(
                      anomalie.priorite
                    )}`}
                  >
                    {anomalie.priorite.toUpperCase()}
                  </span>
                </td>
                <td>{anomalie.dateCreation}</td>
                <td>
                  <Link
                    href={`/anomalies/${anomalie.id}`}
                    className="btn btn-sm btn-primary"
                  >
                    Voir
                  </Link>
                </td>
              </tr>
            ))}
          </tbody>
        </table>
      </div>
    </div>
  );
};

export default AnomaliesList;
