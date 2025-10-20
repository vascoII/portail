import React from "react";
import Link from "next/link";

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

interface LogementCardProps {
  logement: Logement;
  className?: string;
}

const LogementCard: React.FC<LogementCardProps> = ({
  logement,
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
              Référence : <span>{logement.occupant.ref}</span>
            </strong>
          </p>
          <p>
            <strong>
              N° d'immeuble : <span>{logement.numero}</span>
            </strong>
          </p>
          <p>{logement.adresse}</p>
          <p>
            {logement.cp} {logement.ville}
          </p>
        </div>
      </div>

      <div className="meta user clearfix">
        <div className="icons">
          <i className="icon-user"></i>
        </div>
        <div className="data">
          <p>
            <strong>
              Occupant : <span>{logement.occupant.nom}</span>
            </strong>
          </p>
          <p>
            <strong>
              Date d'arrivée : <span>{logement.occupant.dateArrivee}</span>
            </strong>
          </p>
        </div>
      </div>

      <div className="app">
        <div className="inner">
          <strong>{logement.nbAppareils}</strong> Appareils
        </div>
      </div>

      <div className="stats clearfix">
        {logement.nbCompteurs.eauFroide > 0 && (
          <div className="item">
            <div className="value">{logement.nbCompteurs.eauFroide}</div>
            <div className="title">Eau froide</div>
          </div>
        )}
        {logement.nbCompteurs.eauChaude > 0 && (
          <div className="item">
            <div className="value">{logement.nbCompteurs.eauChaude}</div>
            <div className="title">Eau chaude</div>
          </div>
        )}
        {logement.nbCompteurs.repartiteurs > 0 && (
          <div className="item">
            <div className="value">{logement.nbCompteurs.repartiteurs}</div>
            <div className="title">Répartiteurs</div>
          </div>
        )}
        {logement.nbCompteurs.cet > 0 && (
          <div className="item">
            <div className="value">{logement.nbCompteurs.cet}</div>
            <div className="title">Compteur d'énergie</div>
          </div>
        )}
        {logement.nbCompteurs.electricite > 0 && (
          <div className="item">
            <div className="value">{logement.nbCompteurs.electricite}</div>
            <div className="title">Electricité</div>
          </div>
        )}
        {logement.nbCompteurs.gaz > 0 && (
          <div className="item">
            <div className="value">{logement.nbCompteurs.gaz}</div>
            <div className="title">Gaz</div>
          </div>
        )}
      </div>

      <div className="actions">
        <Link href={`/logements/${logement.id}`} className="btn btn-primary">
          Voir les détails
        </Link>
      </div>
    </div>
  );
};

export default LogementCard;
