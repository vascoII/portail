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

      <div className="max-w-4xl mx-auto px-4 py-8">
        <div className="bg-white rounded-lg shadow-lg border border-gray-200 overflow-hidden">
          {/* Header */}
          <div className="bg-gradient-to-r from-blue-600 to-blue-700 px-6 py-4">
            <h1 className="text-2xl font-bold text-white">Mentions légales</h1>
          </div>

          {/* Content */}
          <div className="p-6 space-y-8">
            <div className="space-y-6">
              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    1
                  </span>
                  Éditeur du site
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
                    Téléphone : 01 23 45 67 89
                    <br />
                    Email : contact@techem.fr
                  </p>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    2
                  </span>
                  Directeur de la publication
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700">
                    M. Jean Dupont, Directeur Général
                  </p>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    3
                  </span>
                  Hébergement
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    Le site est hébergé par :
                    <br />
                    <strong className="text-gray-900">OVH</strong>
                    <br />
                    2 rue Kellermann, 59100 Roubaix
                    <br />
                    Téléphone : 1007
                  </p>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    4
                  </span>
                  Propriété intellectuelle
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    L'ensemble de ce site relève de la législation française et
                    internationale sur le droit d'auteur et la propriété
                    intellectuelle. Tous les droits de reproduction sont
                    réservés, y compris pour les documents téléchargeables et
                    les représentations iconographiques et photographiques.
                  </p>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    5
                  </span>
                  Collecte et traitement des données personnelles
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    Conformément à la loi "Informatique et Libertés" du 6
                    janvier 1978 modifiée et au Règlement Général sur la
                    Protection des Données (RGPD), vous disposez d'un droit
                    d'accès, de rectification, de suppression et d'opposition
                    aux données personnelles vous concernant.
                  </p>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    6
                  </span>
                  Cookies
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    Ce site utilise des cookies pour améliorer votre expérience
                    de navigation et analyser le trafic du site. En continuant à
                    utiliser ce site, vous acceptez notre utilisation des
                    cookies.
                  </p>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    7
                  </span>
                  Responsabilité
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    Les informations contenues sur ce site sont aussi précises
                    que possible et le site remis à jour à différentes périodes
                    de l'année, mais peut toutefois contenir des inexactitudes
                    ou des omissions.
                  </p>
                </div>
              </section>

              <section className="border-b border-gray-200 pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    8
                  </span>
                  Droit applicable
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    Tout litige en relation avec l'utilisation du site
                    www.techem.fr est soumis au droit français. Il est fait
                    attribution exclusive de juridiction aux tribunaux
                    compétents de Paris.
                  </p>
                </div>
              </section>

              <section className="pb-6">
                <h2 className="text-xl font-semibold text-gray-900 mb-4 flex items-center">
                  <span className="bg-blue-100 text-blue-800 text-sm font-medium px-2.5 py-0.5 rounded-full mr-3">
                    9
                  </span>
                  Contact
                </h2>
                <div className="pl-8">
                  <p className="text-gray-700 leading-relaxed">
                    Pour toute question concernant ces mentions légales, vous
                    pouvez nous contacter à l'adresse suivante :
                    <br />
                    Email : legal@techem.fr
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

export default LegalNoticesPage;
