"use client";
import React from "react";
import BaseLayout from "../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../components/Layout/Breadcrumb";

const CGUPage: React.FC = () => {
  const breadcrumbItems = [
    { label: "Accueil", href: "/dashboard" },
    { label: "Conditions générales d'utilisation" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <div className="row">
        <div className="col-md-12">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h2 className="panel-title">
                Conditions générales d'utilisation
              </h2>
            </div>
            <div className="panel-body">
              <div className="cgu-content">
                <h3>1. Objet</h3>
                <p>
                  Les présentes conditions générales d'utilisation (CGU) ont
                  pour objet de définir les modalités et conditions
                  d'utilisation du portail client Techem France accessible à
                  l'adresse www.techem.fr (ci-après "le Site").
                </p>

                <h3>2. Acceptation des conditions</h3>
                <p>
                  L'utilisation du Site implique l'acceptation pleine et entière
                  des présentes CGU. Si vous n'acceptez pas ces conditions, vous
                  ne devez pas utiliser le Site.
                </p>

                <h3>3. Accès au Site</h3>
                <p>
                  L'accès au Site est réservé aux clients de Techem France
                  disposant d'un compte utilisateur valide. L'accès se fait par
                  authentification avec un identifiant et un mot de passe
                  personnels.
                </p>

                <h3>4. Utilisation du Site</h3>
                <p>Le Site permet aux clients de Techem France de :</p>
                <ul>
                  <li>Consulter leurs données de consommation énergétique</li>
                  <li>Visualiser leurs immeubles et logements</li>
                  <li>Suivre leurs interventions et anomalies</li>
                  <li>Accéder à leurs factures</li>
                  <li>Gérer leur compte utilisateur</li>
                </ul>

                <h3>5. Obligations de l'utilisateur</h3>
                <p>L'utilisateur s'engage à :</p>
                <ul>
                  <li>
                    Fournir des informations exactes et à jour lors de
                    l'inscription
                  </li>
                  <li>
                    Maintenir la confidentialité de ses identifiants de
                    connexion
                  </li>
                  <li>
                    Ne pas utiliser le Site à des fins illégales ou non
                    autorisées
                  </li>
                  <li>
                    Ne pas tenter de contourner les mesures de sécurité du Site
                  </li>
                  <li>
                    Informer immédiatement Techem France de toute utilisation
                    non autorisée de son compte
                  </li>
                </ul>

                <h3>6. Propriété intellectuelle</h3>
                <p>
                  Le Site et son contenu (textes, images, logos, graphismes,
                  etc.) sont protégés par les droits de propriété intellectuelle
                  et sont la propriété exclusive de Techem France ou de ses
                  partenaires.
                </p>

                <h3>7. Protection des données personnelles</h3>
                <p>
                  Techem France s'engage à protéger la confidentialité des
                  données personnelles de ses utilisateurs conformément à la
                  réglementation en vigueur (RGPD). Pour plus d'informations,
                  consultez notre politique de confidentialité.
                </p>

                <h3>8. Disponibilité du Site</h3>
                <p>
                  Techem France s'efforce d'assurer une disponibilité du Site
                  24h/24 et 7j/7, mais ne peut garantir une disponibilité
                  absolue. Le Site peut être temporairement indisponible pour
                  des raisons de maintenance ou de mise à jour.
                </p>

                <h3>9. Responsabilité</h3>
                <p>
                  Techem France ne saurait être tenue responsable des dommages
                  directs ou indirects résultant de l'utilisation du Site ou de
                  l'impossibilité d'y accéder.
                </p>

                <h3>10. Modification des CGU</h3>
                <p>
                  Techem France se réserve le droit de modifier les présentes
                  CGU à tout moment. Les modifications entrent en vigueur dès
                  leur publication sur le Site. Il appartient à l'utilisateur de
                  consulter régulièrement les CGU.
                </p>

                <h3>11. Droit applicable et juridiction</h3>
                <p>
                  Les présentes CGU sont soumises au droit français. En cas de
                  litige, les tribunaux français seront seuls compétents.
                </p>

                <h3>12. Contact</h3>
                <p>
                  Pour toute question concernant ces CGU, vous pouvez nous
                  contacter :
                  <br />
                  Email : support@techem.fr
                  <br />
                  Téléphone : 01 23 45 67 89
                </p>

                <p className="text-muted">
                  <small>
                    Dernière mise à jour :{" "}
                    {new Date().toLocaleDateString("fr-FR")}
                  </small>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </BaseLayout>
  );
};

export default CGUPage;
