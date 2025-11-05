"use client";

import React, { useState } from "react";
import Link from "next/link";
import Image from "next/image";
import ReleveForm from "@/components/Forms/ReleveForm";
import { ReleveFormData } from "@/src/types/releve";

const RelevePage: React.FC = () => {
  const [isLoading, setIsLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const [success, setSuccess] = useState(false);

  const handleReleveSubmit = async (data: ReleveFormData): Promise<void> => {
    setIsLoading(true);
    setError(null);
    setSuccess(false);
    try {
      const response = await fetch("/api/releve/generate", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(data),
      });

      if (!response.ok) {
        const errorData = await response.json();
        throw new Error(errorData.message || "Erreur lors de l'envoi du relevé.");
      }

      setSuccess(true);
    } catch (err: any) {
      setError(err.message || "Une erreur est survenue.");
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
      <div
        className="absolute top-0 left-0 right-0 w-full h-64 bg-top bg-no-repeat bg-cover pointer-events-none"
        style={{
          backgroundImage: "url('/images/login-bg.png')",
          zIndex: 1,
        }}
      />
      <div className="sm:mx-auto sm:w-full sm:max-w-md" style={{ zIndex: 1 }}>
        {/* Logo */}
        <div className="flex justify-center">
          <Link href="/" className="flex items-center">
            <div className="flex-shrink-0">
              <Image
                width={0}
                height={0}
                className="h-20 w-auto"
                src="/images/logo.svg"
                alt="Techem"
                onError={(e) => {
                  // Fallback si l'image n'existe pas
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
          Transmettre votre relevé de compteurs
        </h2>
        <p className="mt-2 text-center text-sm text-gray-600">
          Le releveur s’est présenté à votre résidence mais n’a pas pu accéder à votre logement pour le relevé de vos compteurs d’eau.
          Vous avez la possibilité de relever et nous transmettre via le formulaire ci-dessous votre consommation d'eau.
        </p>
      </div>

      <div
        className="mt-8 sm:mx-auto sm:w-full sm:max-w-md"
        style={{ zIndex: 1 }}
      >
        <div className="bg-white py-8 px-4 shadow-xl sm:rounded-lg sm:px-10">
          {/* Formulaire de connexion */}
          <ReleveForm onSubmit={handleReleveSubmit} loading={isLoading} error={error} success={success} />

          {/* Informations supplémentaires */}
          <div className="mt-6">
            <div className="relative">
              <div className="absolute inset-0 flex items-center">
                <div className="w-full border-t border-gray-300" />
              </div>
              <div className="relative flex justify-center text-sm">
                <span className="px-2 bg-white text-gray-500">
                  Besoin d&apos;aide ?
                </span>
              </div>
            </div>

            <div className="mt-6 text-center">
              <p className="text-sm text-gray-600">
                Contactez le support technique au{" "}
                <a
                  href="tel:0146012067"
                  className="font-medium text-blue-600 hover:text-blue-500"
                >
                  01 46 01 20 67
                </a>
              </p>
            </div>
          </div>
        </div>

        {/* Footer */}
        <div className="mt-8 text-center">
          <div className="flex justify-center space-x-6 text-sm text-gray-500">
            <Link
              target="_blank"
              href="https://www.techem.com/fr/fr/mentions-legales"
              className="hover:text-gray-700 transition-colors"
            >
              Mentions légales
            </Link>
            <Link
              target="_blank"
              href="https://www.techem.com/fr/fr/politique-de-confidentialite/protection-des-donnees"
              className="hover:text-gray-700 transition-colors"
            >
              Protection des Données
            </Link>
            <Link
              target="_blank"
              href="https://www.techem.com/fr/fr/politique-de-confidentialite"
              className="hover:text-gray-700 transition-colors"
            >
              Politique de confidentialité
            </Link>
            <Link
              target="_blank"
              href="/rgpd"
              className="hover:text-gray-700 transition-colors"
            >
              RGPD
            </Link>
          </div>
          <p className="mt-2 text-xs text-gray-400">
            © 2025 Techem France. Tous droits réservés.
          </p>
        </div>
      </div>
    </div>
  );
};

export default RelevePage;
