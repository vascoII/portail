"use client";
import React from "react";
import BaseLayout from "../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../components/Layout/Breadcrumb";
import Alert from "../../../components/UI/Alert";

const PersonalDatasPage: React.FC = () => {
  const breadcrumbItems = [
    { label: "Accueil", href: "/dashboard" },
    { label: "Données personnelles" },
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
                Politique de protection des données personnelles
              </h2>
            </div>
            <div className="panel-body">
              <Alert
                type="info"
                message="Cette page décrit comment Techem France collecte, utilise et protège vos données personnelles conformément au RGPD."
              />

              <div className="privacy-content">
                <h3>1. Responsable du traitement</h3>
                <p>
                  <strong>Techem France</strong>
                  <br />
                  Société par actions simplifiée au capital de 1 000 000 €
                  <br />
                  RCS Paris B 123 456 789
                  <br />
                  Siège social : 123 Avenue des Champs-Élysées, 75008 Paris
                  <br />
                  Email : dpo@techem.fr
                </p>

                <h3>2. Données collectées</h3>
                <p>Nous collectons les données suivantes :</p>
                <ul>
                  <li>
                    <strong>Données d'identification :</strong> nom, prénom,
                    email, numéro de téléphone
                  </li>
                  <li>
                    <strong>Données de connexion :</strong> identifiant, mot de
                    passe (chiffré)
                  </li>
                  <li>
                    <strong>Données de consommation :</strong> relevés de
                    compteurs, données énergétiques
                  </li>
                  <li>
                    <strong>Données techniques :</strong> adresse IP, cookies,
                    logs de connexion
                  </li>
                </ul>

                <h3>3. Finalités du traitement</h3>
                <p>Vos données sont utilisées pour :</p>
                <ul>
                  <li>Fournir les services du portail client</li>
                  <li>Gérer votre compte utilisateur</li>
                  <li>Traiter vos demandes et réclamations</li>
                  <li>Respecter nos obligations légales</li>
                  <li>Améliorer nos services</li>
                </ul>

                <h3>4. Base légale</h3>
                <p>Le traitement de vos données repose sur :</p>
                <ul>
                  <li>
                    <strong>L'exécution du contrat :</strong> fourniture des
                    services énergétiques
                  </li>
                  <li>
                    <strong>L'intérêt légitime :</strong> amélioration des
                    services, sécurité
                  </li>
                  <li>
                    <strong>L'obligation légale :</strong> conservation des
                    données de facturation
                  </li>
                </ul>

                <h3>5. Conservation des données</h3>
                <p>
                  Vos données sont conservées pendant la durée nécessaire aux
                  finalités pour lesquelles elles sont collectées :
                </p>
                <ul>
                  <li>
                    <strong>Données de compte :</strong> 3 ans après la fin de
                    la relation contractuelle
                  </li>
                  <li>
                    <strong>Données de facturation :</strong> 10 ans (obligation
                    légale)
                  </li>
                  <li>
                    <strong>Données de consommation :</strong> 5 ans
                  </li>
                </ul>

                <h3>6. Partage des données</h3>
                <p>Vos données peuvent être partagées avec :</p>
                <ul>
                  <li>
                    Nos prestataires techniques (hébergement, maintenance)
                  </li>
                  <li>Les autorités compétentes (sur demande légale)</li>
                  <li>Nos partenaires commerciaux (avec votre consentement)</li>
                </ul>

                <h3>7. Vos droits</h3>
                <p>Conformément au RGPD, vous disposez des droits suivants :</p>
                <ul>
                  <li>
                    <strong>Droit d'accès :</strong> consulter vos données
                  </li>
                  <li>
                    <strong>Droit de rectification :</strong> corriger vos
                    données
                  </li>
                  <li>
                    <strong>Droit d'effacement :</strong> supprimer vos données
                  </li>
                  <li>
                    <strong>Droit à la portabilité :</strong> récupérer vos
                    données
                  </li>
                  <li>
                    <strong>Droit d'opposition :</strong> vous opposer au
                    traitement
                  </li>
                  <li>
                    <strong>Droit de limitation :</strong> limiter le traitement
                  </li>
                </ul>

                <h3>8. Exercice de vos droits</h3>
                <p>Pour exercer vos droits, contactez-nous :</p>
                <ul>
                  <li>Email : dpo@techem.fr</li>
                  <li>
                    Courrier : Techem France - DPO, 123 Avenue des
                    Champs-Élysées, 75008 Paris
                  </li>
                  <li>Téléphone : 01 23 45 67 89</li>
                </ul>

                <h3>9. Sécurité des données</h3>
                <p>
                  Nous mettons en œuvre des mesures techniques et
                  organisationnelles appropriées pour protéger vos données
                  contre :
                </p>
                <ul>
                  <li>L'accès non autorisé</li>
                  <li>La divulgation</li>
                  <li>La modification</li>
                  <li>La destruction</li>
                </ul>

                <h3>10. Cookies</h3>
                <p>
                  Notre site utilise des cookies pour améliorer votre expérience
                  de navigation. Vous pouvez gérer vos préférences de cookies
                  dans les paramètres de votre navigateur.
                </p>

                <h3>11. Réclamations</h3>
                <p>
                  Si vous estimez que vos droits ne sont pas respectés, vous
                  pouvez saisir la CNIL :
                </p>
                <p>
                  <strong>CNIL</strong>
                  <br />
                  3 Place de Fontenoy - TSA 80715 - 75334 PARIS CEDEX 07
                  <br />
                  Téléphone : 01 53 73 22 22
                  <br />
                  Site web : www.cnil.fr
                </p>

                <h3>12. Contact</h3>
                <p>
                  Pour toute question concernant la protection de vos données :
                  <br />
                  Email : dpo@techem.fr
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

export default PersonalDatasPage;
