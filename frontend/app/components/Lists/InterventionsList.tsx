import React from "react";
import InterventionCard from "../Cards/InterventionCard";

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

interface InterventionsListProps {
  interventions: Intervention[];
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

const InterventionsList: React.FC<InterventionsListProps> = ({
  interventions,
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

  if (loading) {
    return (
      <div className={`interventions-list ${className}`}>
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
      <div className={`interventions-list ${className}`}>
        <div className="alert alert-danger" role="alert">
          {error}
        </div>
      </div>
    );
  }

  if (interventions.length === 0) {
    return (
      <div className={`interventions-list ${className}`}>
        <div className="text-center">
          <p>Aucune intervention trouvée.</p>
        </div>
      </div>
    );
  }

  return (
    <div className={`interventions-list ${className}`}>
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
                <option value="ouvert">Ouvert</option>
                <option value="en_cours">En cours</option>
                <option value="ferme">Fermé</option>
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
                placeholder="Type d'intervention"
                value={filters.type}
                onChange={(e) => handleFilterChange("type", e.target.value)}
              />
            </div>
          </div>
        </div>
      )}

      <div className="row">
        {interventions.map((intervention) => (
          <div key={intervention.id} className="col-md-6 col-lg-4 mb-4">
            <InterventionCard intervention={intervention} />
          </div>
        ))}
      </div>
    </div>
  );
};

export default InterventionsList;
