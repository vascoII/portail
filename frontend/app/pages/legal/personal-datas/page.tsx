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

      <div className="max-w-4xl mx-auto px-4 py-8">
        <div className="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">
          {/* Header */}
          <div className="bg-gradient-to-r from-purple-600 to-purple-700 px-6 py-4">
            <h1 className="text-2xl font-bold text-white">
              Politique de protection des données personnelles
            </h1>
          </div>

          {/* Content */}
          <div className="p-6 space-y-8">
            {/* Alert Info */}
            <div className="bg-blue-50 border border-blue-200 rounded-lg p-4">
              <div className="flex items-start">
                <div className="flex-shrink-0">
                  <svg
                    className="h-5 w-5 text-blue-400"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fillRule="evenodd"
                      d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                      clipRule="evenodd"
                    />
                  </svg>
                </div>
                <div className="ml-3">
                  <p className="text-sm text-blue-700">
                    Cette page décrit comment Techem France collecte, utilise et
                    protège vos données personnelles conformément au RGPD.
                  </p>
                </div>
              </div>
            </div>

            <div className="space-y-6">
              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-purple-100 text-purple-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    1
                  </span>
                  Responsable du traitement
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    <strong className="text-gray-900">Techem France</strong>
                    <br />
                    Société par actions simplifiée au capital de 1 000 000 €
                    <br />
                    RCS Paris B 123 456 789
                    <br />
                    Siège social : 123 Avenue des Champs-Élysées, 75008 Paris
                    <br />
                    Email : dpo@techem.fr
                  </p>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-purple-100 text-purple-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    2
                  </span>
                  Données collectées
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed mb-4">
                    Nous collectons les données suivantes :
                  </p>
                  <ul className="list-disc list-inside space-y-2 text-gray-700">
                    <li>
                      <strong className="text-gray-900">
                        Données d'identification :
                      </strong>{" "}
                      nom, prénom, email, numéro de téléphone
                    </li>
                    <li>
                      <strong className="text-gray-900">
                        Données de connexion :
                      </strong>{" "}
                      identifiant, mot de passe (chiffré)
                    </li>
                    <li>
                      <strong className="text-gray-900">
                        Données de consommation :
                      </strong>{" "}
                      relevés de compteurs, données énergétiques
                    </li>
                    <li>
                      <strong className="text-gray-900">
                        Données techniques :
                      </strong>{" "}
                      adresse IP, cookies, logs de connexion
                    </li>
                  </ul>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-purple-100 text-purple-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    3
                  </span>
                  Finalités du traitement
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed mb-4">
                    Vos données sont utilisées pour :
                  </p>
                  <ul className="list-disc list-inside space-y-2 text-gray-700">
                    <li>Fournir les services du portail client</li>
                    <li>Gérer votre compte utilisateur</li>
                    <li>Traiter vos demandes et réclamations</li>
                    <li>Respecter nos obligations légales</li>
                    <li>Améliorer nos services</li>
                  </ul>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-purple-100 text-purple-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    4
                  </span>
                  Base légale
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed mb-4">
                    Le traitement de vos données repose sur :
                  </p>
                  <ul className="list-disc list-inside space-y-2 text-gray-700">
                    <li>
                      <strong className="text-gray-900">
                        L'exécution du contrat :
                      </strong>{" "}
                      fourniture des services énergétiques
                    </li>
                    <li>
                      <strong className="text-gray-900">
                        L'intérêt légitime :
                      </strong>{" "}
                      amélioration des services, sécurité
                    </li>
                    <li>
                      <strong className="text-gray-900">
                        L'obligation légale :
                      </strong>{" "}
                      conservation des données de facturation
                    </li>
                  </ul>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-purple-100 text-purple-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    5
                  </span>
                  Conservation des données
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed mb-4">
                    Vos données sont conservées pendant la durée nécessaire aux
                    finalités pour lesquelles elles sont collectées :
                  </p>
                  <ul className="list-disc list-inside space-y-2 text-gray-700">
                    <li>
                      <strong className="text-gray-900">
                        Données de compte :
                      </strong>{" "}
                      3 ans après la fin de la relation contractuelle
                    </li>
                    <li>
                      <strong className="text-gray-900">
                        Données de facturation :
                      </strong>{" "}
                      10 ans (obligation légale)
                    </li>
                    <li>
                      <strong className="text-gray-900">
                        Données de consommation :
                      </strong>{" "}
                      5 ans
                    </li>
                  </ul>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-purple-100 text-purple-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    6
                  </span>
                  Partage des données
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed mb-4">
                    Vos données peuvent être partagées avec :
                  </p>
                  <ul className="list-disc list-inside space-y-2 text-gray-700">
                    <li>
                      Nos prestataires techniques (hébergement, maintenance)
                    </li>
                    <li>Les autorités compétentes (sur demande légale)</li>
                    <li>
                      Nos partenaires commerciaux (avec votre consentement)
                    </li>
                  </ul>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-purple-100 text-purple-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    7
                  </span>
                  Vos droits
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed mb-4">
                    Conformément au RGPD, vous disposez des droits suivants :
                  </p>
                  <ul className="list-disc list-inside space-y-2 text-gray-700">
                    <li>
                      <strong className="text-gray-900">Droit d'accès :</strong>{" "}
                      consulter vos données
                    </li>
                    <li>
                      <strong className="text-gray-900">
                        Droit de rectification :
                      </strong>{" "}
                      corriger vos données
                    </li>
                    <li>
                      <strong className="text-gray-900">
                        Droit d'effacement :
                      </strong>{" "}
                      supprimer vos données
                    </li>
                    <li>
                      <strong className="text-gray-900">
                        Droit à la portabilité :
                      </strong>{" "}
                      récupérer vos données
                    </li>
                    <li>
                      <strong className="text-gray-900">
                        Droit d'opposition :
                      </strong>{" "}
                      vous opposer au traitement
                    </li>
                    <li>
                      <strong className="text-gray-900">
                        Droit de limitation :
                      </strong>{" "}
                      limiter le traitement
                    </li>
                  </ul>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-purple-100 text-purple-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    8
                  </span>
                  Exercice de vos droits
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed mb-4">
                    Pour exercer vos droits, contactez-nous :
                  </p>
                  <ul className="list-disc list-inside space-y-2 text-gray-700">
                    <li>Email : dpo@techem.fr</li>
                    <li>
                      Courrier : Techem France - DPO, 123 Avenue des
                      Champs-Élysées, 75008 Paris
                    </li>
                    <li>Téléphone : 01 23 45 67 89</li>
                  </ul>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-purple-100 text-purple-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    9
                  </span>
                  Sécurité des données
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed mb-4">
                    Nous mettons en œuvre des mesures techniques et
                    organisationnelles appropriées pour protéger vos données
                    contre :
                  </p>
                  <ul className="list-disc list-inside space-y-2 text-gray-700">
                    <li>L'accès non autorisé</li>
                    <li>La divulgation</li>
                    <li>La modification</li>
                    <li>La destruction</li>
                  </ul>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-purple-100 text-purple-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    10
                  </span>
                  Cookies
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    Notre site utilise des cookies pour améliorer votre
                    expérience de navigation. Vous pouvez gérer vos préférences
                    de cookies dans les paramètres de votre navigateur.
                  </p>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-purple-100 text-purple-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    11
                  </span>
                  Réclamations
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed mb-4">
                    Si vous estimez que vos droits ne sont pas respectés, vous
                    pouvez saisir la CNIL :
                  </p>
                  <p className="text-gray-700 leading-relaxed">
                    <strong className="text-gray-900">CNIL</strong>
                    <br />
                    3 Place de Fontenoy - TSA 80715 - 75334 PARIS CEDEX 07
                    <br />
                    Téléphone : 01 53 73 22 22
                    <br />
                    Site web : www.cnil.fr
                  </p>
                </div>
              </section>

              <section className="pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-purple-100 text-purple-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    12
                  </span>
                  Contact
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    Pour toute question concernant la protection de vos données
                    :
                    <br />
                    Email : dpo@techem.fr
                    <br />
                    Téléphone : 01 23 45 67 89
                  </p>
                </div>
              </section>
            </div>

            {/* Footer */}
            <div className="bg-gray-50 rounded-lg p-4 mt-8">
              <p className="text-sm text-gray-500 text-center">
                <span className="inline-flex items-center">
                  <svg
                    className="w-4 h-4 mr-2"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fillRule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z"
                      clipRule="evenodd"
                    />
                  </svg>
                  Dernière mise à jour :{" "}
                  {new Date().toLocaleDateString("fr-FR")}
                </span>
              </p>
            </div>
          </div>
        </div>
      </div>
    </BaseLayout>
  );
};

export default PersonalDatasPage;
