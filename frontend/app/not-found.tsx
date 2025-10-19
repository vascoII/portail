"use client";

import React from "react";
import Link from "next/link";
import Image from "next/image";

const NotFoundPage: React.FC = () => {
  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col py-12 sm:px-6 lg:px-8">
      {/* Fond */}
      <div
        className="absolute top-0 left-0 right-0 w-full h-64 bg-top bg-no-repeat bg-cover pointer-events-none"
        style={{
          backgroundImage: "url('/images/login-bg.png')",
          zIndex: 1,
        }}
      />

      <div className="sm:mx-auto sm:w-full sm:max-w-md relative z-10">
        {/* Logo */}
        <div className="flex justify-center">
          <Link href="/dashboard" className="flex items-center">
            <div className="flex-shrink-0">
              <Image
                width={0}
                height={0}
                className="h-20 w-auto"
                src="/images/logo.svg"
                alt="Techem"
                onError={(e) => {
                  e.currentTarget.style.display = "none";
                  e.currentTarget.nextElementSibling?.classList.remove(
                    "hidden"
                  );
                }}
              />
              <div className="hidden h-12 w-32 bg-blue-600 rounded-lg flex items-center justify-center">
                <span className="text-white font-bold text-xl">TECHEM</span>
              </div>
            </div>
          </Link>
        </div>

        {/* Titre */}
        <h2 className="mt-6 text-center text-3xl font-extrabold text-gray-900">
          Page introuvable
        </h2>
        <p className="mt-2 text-center text-sm text-gray-600">
          La page que vous recherchez n&apos;existe pas ou a été déplacée
        </p>
      </div>

      {/* Contenu */}
      <div className="mt-8 mx-auto w-full lg:w-3/4 max-w-5xl relative z-10">
        <div className="bg-white mt-6 py-8 px-4 shadow-xl sm:rounded-lg sm:px-10">
          <div className="text-center">
            {/* Icône 404 */}
            <div className="mb-6">
              <div className="mx-auto w-24 h-24 bg-red-100 rounded-full flex items-center justify-center">
                <svg
                  className="w-12 h-12 text-red-600"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth={2}
                    d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L3.732 16.5c-.77.833.192 2.5 1.732 2.5z"
                  />
                </svg>
              </div>
            </div>

            {/* Message d'erreur */}
            <h3 className="text-2xl font-bold text-gray-900 mb-4">
              Erreur 404
            </h3>
            <p className="text-gray-600 mb-8">
              Désolé, la page que vous recherchez n&apos;a pas pu être trouvée.
              <br />
              Vérifiez l&apos;URL ou retournez à la page d&apos;accueil.
            </p>

            {/* Boutons d'action */}
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <Link
                href="/dashboard"
                className="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors"
              >
                <svg
                  className="w-5 h-5 mr-2"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth={2}
                    d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                  />
                </svg>
                Retour à l&apos;accueil
              </Link>

              <button
                onClick={() => window.history.back()}
                className="inline-flex items-center px-6 py-3 border border-gray-300 text-base font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors"
              >
                <svg
                  className="w-5 h-5 mr-2"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    strokeLinecap="round"
                    strokeLinejoin="round"
                    strokeWidth={2}
                    d="M10 19l-7-7m0 0l7-7m-7 7h18"
                  />
                </svg>
                Page précédente
              </button>
            </div>
          </div>
        </div>

        {/* Footer */}
        <div className="mt-8 text-center">
          <p className="mt-2 text-xs text-gray-400">
            © 2025 Techem France. Tous droits réservés.
          </p>
        </div>
      </div>
    </div>
  );
};

export default NotFoundPage;
