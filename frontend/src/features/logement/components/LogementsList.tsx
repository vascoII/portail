import React from "react";
import LogementCard from "@/src/shared/components/Cards/LogementCard";

interface Logement {
  id: string;
  numero: string;
  adresse: string;
  ville: string;
  cp: string;
  occupant: {
    ref: string;
    nom: string;
    dateArrivee: string;
  };
  nbAppareils: number;
  nbCompteurs: {
    eauFroide: number;
    eauChaude: number;
    repartiteurs: number;
    cet: number;
    electricite: number;
    gaz: number;
  };
}

interface LogementsListProps {
  logements: Logement[];
  loading?: boolean;
  error?: string;
  className?: string;
}

const LogementsList: React.FC<LogementsListProps> = ({
  logements,
  loading = false,
  error,
  className = "",
}) => {
  if (loading) {
    return (
      <div className={`logements-list ${className}`}>
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
      <div className={`logements-list ${className}`}>
        <div className="alert alert-danger" role="alert">
          {error}
        </div>
      </div>
    );
  }

  if (logements.length === 0) {
    return (
      <div className={`logements-list ${className}`}>
        <div className="text-center">
          <p>Aucun logement trouvé.</p>
        </div>
      </div>
    );
  }

  return (
    <div className={`logements-list ${className}`}>
      <div className="row">
        {logements.map((logement) => (
          <div key={logement.id} className="col-md-6 col-lg-4 mb-4">
            <LogementCard logement={logement} />
          </div>
        ))}
      </div>
    </div>
  );
};

export default LogementsList;
