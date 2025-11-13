import React from "react";
import ImmeubleCard from "@/src/shared/components/Cards/ImmeubleCard";

interface Immeuble {
  id: string;
  numero: string;
  adresse: string;
  ville: string;
  cp: string;
  nbLogements: number;
  nbAnomalies: number;
  nbDysfonctionnements: number;
  nbInterventions: number;
  nbFuite: number;
}

interface ImmeublesListProps {
  immeubles: Immeuble[];
  loading?: boolean;
  error?: string;
  className?: string;
}

const ImmeublesList: React.FC<ImmeublesListProps> = ({
  immeubles,
  loading = false,
  error,
  className = "",
}) => {
  if (loading) {
    return (
      <div className={`immeubles-list ${className}`}>
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
      <div className={`immeubles-list ${className}`}>
        <div className="alert alert-danger" role="alert">
          {error}
        </div>
      </div>
    );
  }

  if (immeubles.length === 0) {
    return (
      <div className={`immeubles-list ${className}`}>
        <div className="text-center">
          <p>Aucun immeuble trouvé.</p>
        </div>
      </div>
    );
  }

  return (
    <div className={`immeubles-list ${className}`}>
      <div className="row">
        {immeubles.map((immeuble) => (
          <div key={immeuble.id} className="col-md-6 col-lg-4 mb-4">
            <ImmeubleCard immeuble={immeuble} />
          </div>
        ))}
      </div>
    </div>
  );
};

export default ImmeublesList;
