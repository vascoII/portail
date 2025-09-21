"use client";
import React from "react";
import BaseLayout from "../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../components/Layout/Breadcrumb";

const LegalNoticesPage: React.FC = () => {
  const breadcrumbItems = [
    { label: "Accueil", href: "/dashboard" },
    { label: "Mentions légales" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <div className="row">
        <div className="col-md-12">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h2 className="panel-title">Mentions légales</h2>
            </div>
            <div className="panel-body">
              <div className="legal-content">
                <h3>1. Éditeur du site</h3>
                <p>
                  <strong>Techem France</strong>
                  <br />
                  Société par actions simplifiée au capital de 1 000 000 €
                  <br />
                  RCS Paris B 123 456 789
                  <br />
                  Siège social : 123 Avenue des Champs-Élysées, 75008 Paris
                  <br />
                  Téléphone : 01 23 45 67 89
                  <br />
                  Email : contact@techem.fr
                </p>

                <h3>2. Directeur de la publication</h3>
                <p>M. Jean Dupont, Directeur Général</p>

                <h3>3. Hébergement</h3>
                <p>
                  Le site est hébergé par :
                  <br />
                  <strong>OVH</strong>
                  <br />
                  2 rue Kellermann, 59100 Roubaix
                  <br />
                  Téléphone : 1007
                </p>

                <h3>4. Propriété intellectuelle</h3>
                <p>
                  L'ensemble de ce site relève de la législation française et
                  internationale sur le droit d'auteur et la propriété
                  intellectuelle. Tous les droits de reproduction sont réservés,
                  y compris pour les documents téléchargeables et les
                  représentations iconographiques et photographiques.
                </p>

                <h3>5. Collecte et traitement des données personnelles</h3>
                <p>
                  Conformément à la loi "Informatique et Libertés" du 6 janvier
                  1978 modifiée et au Règlement Général sur la Protection des
                  Données (RGPD), vous disposez d'un droit d'accès, de
                  rectification, de suppression et d'opposition aux données
                  personnelles vous concernant.
                </p>

                <h3>6. Cookies</h3>
                <p>
                  Ce site utilise des cookies pour améliorer votre expérience de
                  navigation et analyser le trafic du site. En continuant à
                  utiliser ce site, vous acceptez notre utilisation des cookies.
                </p>

                <h3>7. Responsabilité</h3>
                <p>
                  Les informations contenues sur ce site sont aussi précises que
                  possible et le site remis à jour à différentes périodes de
                  l'année, mais peut toutefois contenir des inexactitudes ou des
                  omissions.
                </p>

                <h3>8. Droit applicable</h3>
                <p>
                  Tout litige en relation avec l'utilisation du site
                  www.techem.fr est soumis au droit français. Il est fait
                  attribution exclusive de juridiction aux tribunaux compétents
                  de Paris.
                </p>

                <h3>9. Contact</h3>
                <p>
                  Pour toute question concernant ces mentions légales, vous
                  pouvez nous contacter à l'adresse suivante :
                  <br />
                  Email : legal@techem.fr
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

export default LegalNoticesPage;
