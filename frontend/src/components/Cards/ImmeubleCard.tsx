import React from "react";
import Link from "next/link";

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

interface ImmeubleCardProps {
  immeuble: Immeuble;
  className?: string;
}

const ImmeubleCard: React.FC<ImmeubleCardProps> = ({
  immeuble,
  className = "",
}) => {
  return (
    <div className={`panel panel-primary parc_summary panel-info ${className}`}>
      <div className="meta clearfix">
        <div className="icons">
          <i className="icon-opened33"></i>
        </div>
        <div className="data">
          <p>
            <strong>
              N° d'immeuble : <span>{immeuble.numero}</span>
            </strong>
          </p>
          <p>{immeuble.adresse}</p>
          <p>
            {immeuble.cp} {immeuble.ville}
          </p>
        </div>
      </div>

      <div className="app">
        <div className="inner">
          <strong>{immeuble.nbLogements}</strong> Logements
        </div>
      </div>

      <div className="stats clearfix">
        <div className="item">
          <div className="value">{immeuble.nbAnomalies}</div>
          <div className="title">Anomalies</div>
        </div>
        <div className="item">
          <div className="value">{immeuble.nbDysfonctionnements}</div>
          <div className="title">Dysfonctionnements</div>
        </div>
        <div className="item">
          <div className="value">{immeuble.nbInterventions}</div>
          <div className="title">Interventions</div>
        </div>
        <div className="item">
          <div className="value">{immeuble.nbFuite}</div>
          <div className="title">Fuites</div>
        </div>
      </div>

      <div className="actions">
        <Link href={`/pages/immeubles/${immeuble.id}`} className="btn btn-primary">
          Voir les détails
        </Link>
      </div>
    </div>
  );
};

export default ImmeubleCard;
