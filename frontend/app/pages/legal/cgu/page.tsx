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

      <div className="max-w-4xl mx-auto px-4 py-8">
        <div className="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">
          {/* Header */}
          <div className="bg-gradient-to-r from-green-600 to-green-700 px-6 py-4">
            <h1 className="text-2xl font-bold text-white">
              Conditions générales d'utilisation
            </h1>
          </div>

          {/* Content */}
          <div className="p-6 space-y-8">
            <div className="space-y-6">
              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    1
                  </span>
                  Objet
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    Les présentes conditions générales d'utilisation (CGU) ont
                    pour objet de définir les modalités et conditions
                    d'utilisation du portail client Techem France accessible à
                    l'adresse www.techem.fr (ci-après "le Site").
                  </p>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    2
                  </span>
                  Acceptation des conditions
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    L'utilisation du Site implique l'acceptation pleine et
                    entière des présentes CGU. Si vous n'acceptez pas ces
                    conditions, vous ne devez pas utiliser le Site.
                  </p>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    3
                  </span>
                  Accès au Site
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    L'accès au Site est réservé aux clients de Techem France
                    disposant d'un compte utilisateur valide. L'accès se fait
                    par authentification avec un identifiant et un mot de passe
                    personnels.
                  </p>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    4
                  </span>
                  Utilisation du Site
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed mb-4">
                    Le Site permet aux clients de Techem France de :
                  </p>
                  <ul className="list-disc list-inside space-y-2 text-gray-700">
                    <li>Consulter leurs données de consommation énergétique</li>
                    <li>Visualiser leurs immeubles et logements</li>
                    <li>Suivre leurs interventions et anomalies</li>
                    <li>Accéder à leurs factures</li>
                    <li>Gérer leur compte utilisateur</li>
                  </ul>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    5
                  </span>
                  Obligations de l'utilisateur
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed mb-4">
                    L'utilisateur s'engage à :
                  </p>
                  <ul className="list-disc list-inside space-y-2 text-gray-700">
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
                      Ne pas tenter de contourner les mesures de sécurité du
                      Site
                    </li>
                    <li>
                      Informer immédiatement Techem France de toute utilisation
                      non autorisée de son compte
                    </li>
                  </ul>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    6
                  </span>
                  Propriété intellectuelle
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    Le Site et son contenu (textes, images, logos, graphismes,
                    etc.) sont protégés par les droits de propriété
                    intellectuelle et sont la propriété exclusive de Techem
                    France ou de ses partenaires.
                  </p>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    7
                  </span>
                  Protection des données personnelles
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    Techem France s'engage à protéger la confidentialité des
                    données personnelles de ses utilisateurs conformément à la
                    réglementation en vigueur (RGPD). Pour plus d'informations,
                    consultez notre politique de confidentialité.
                  </p>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    8
                  </span>
                  Disponibilité du Site
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    Techem France s'efforce d'assurer une disponibilité du Site
                    24h/24 et 7j/7, mais ne peut garantir une disponibilité
                    absolue. Le Site peut être temporairement indisponible pour
                    des raisons de maintenance ou de mise à jour.
                  </p>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    9
                  </span>
                  Responsabilité
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    Techem France ne saurait être tenue responsable des dommages
                    directs ou indirects résultant de l'utilisation du Site ou
                    de l'impossibilité d'y accéder.
                  </p>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    10
                  </span>
                  Modification des CGU
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    Techem France se réserve le droit de modifier les présentes
                    CGU à tout moment. Les modifications entrent en vigueur dès
                    leur publication sur le Site. Il appartient à l'utilisateur
                    de consulter régulièrement les CGU.
                  </p>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    11
                  </span>
                  Droit applicable et juridiction
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    Les présentes CGU sont soumises au droit français. En cas de
                    litige, les tribunaux français seront seuls compétents.
                  </p>
                </div>
              </section>

              <section className="pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-green-100 text-green-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    12
                  </span>
                  Contact
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    Pour toute question concernant ces CGU, vous pouvez nous
                    contacter :
                    <br />
                    Email : support@techem.fr
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

export default CGUPage;
