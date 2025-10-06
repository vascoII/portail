"use client";
import React, { useState } from "react";
import { useRouter } from "next/navigation";
import Link from "next/link";
import Alert from "../../components/UI/Alert";
import Button from "../../components/UI/Button";
import Input from "../../components/UI/Input";
import {
  AUTH_ENDPOINTS,
  DEFAULT_HEADERS,
  handleApiError,
} from "../../config/api";

const ResetPasswordPage: React.FC = () => {
  const [email, setEmail] = useState("");
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const [success, setSuccess] = useState(false);
  const router = useRouter();

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    setError(null);

    try {
      const response = await fetch(AUTH_ENDPOINTS.RESET_PASSWORD, {
        method: "POST",
        headers: DEFAULT_HEADERS,
        body: JSON.stringify({ email }),
      });

      if (response.ok) {
        setSuccess(true);
      } else {
        const errorData = await response.json();
        const apiError = handleApiError({
          response: { data: errorData, status: response.status },
        });
        setError(apiError.message);
      }
    } catch (err) {
      const apiError = handleApiError(err);
      setError(apiError.message);
    } finally {
      setLoading(false);
    }
  };

  if (success) {
    return (
      <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div
          className="absolute inset-0 w-full h-64 bg-top bg-no-repeat bg-contain pointer-events-none"
          style={{
            backgroundImage: "url('/images/login-bg.png')",
            zIndex: 1,
          }}
        />
        <div className="sm:mx-auto sm:w-full sm:max-w-md" style={{zIndex: 1}}>
          {/* Logo */}
          <div className="flex justify-center">
            <Link href="/pages/dashboard" className="flex items-center">
              <div className="flex-shrink-0">
                <img
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
            Email envoyé !
          </h2>
          <p className="mt-2 text-center text-sm text-gray-600">
            Vérifiez votre boîte de réception
          </p>
        </div>

        <div className="mt-8 sm:mx-auto sm:w-full sm:max-w-md" style={{zIndex: 1}}>
          <div className="bg-white py-8 px-4 shadow-xl sm:rounded-lg sm:px-10">
            {/* Message de succès */}
            <div className="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
              <div className="flex items-start">
                <div className="flex-shrink-0">
                  <svg
                    className="h-5 w-5 text-green-400"
                    fill="currentColor"
                    viewBox="0 0 20 20"
                  >
                    <path
                      fillRule="evenodd"
                      d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                      clipRule="evenodd"
                    />
                  </svg>
                </div>
                <div className="ml-3">
                  <h3 className="text-sm font-medium text-green-800">
                    Email de réinitialisation envoyé
                  </h3>
                  <p className="mt-1 text-sm text-green-700">
                    Si un compte existe avec cette adresse email, vous recevrez
                    un lien de réinitialisation de mot de passe dans quelques
                    minutes.
                  </p>
                </div>
              </div>
            </div>

            {/* Bouton de retour */}
            <div className="text-center">
              <Link
                href="/pages/login"
                className="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200"
              >
                Retour à la connexion
              </Link>
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
                href="/pages/rgpd"
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
  }

  return (
    <div className="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 flex flex-col justify-center py-12 sm:px-6 lg:px-8">
      <div
        className="absolute top-0 left-0 right-0 w-full h-64 bg-top bg-no-repeat bg-cover pointer-events-none"
        style={{
          backgroundImage: "url('/images/login-bg.png')",
          zIndex: 1,
        }}
      />
      <div className="sm:mx-auto sm:w-full sm:max-w-md" style={{zIndex: 1}}>
        {/* Logo */}
        <div className="flex justify-center">
          <Link href="/pages/dashboard" className="flex items-center">
            <div className="flex-shrink-0">
              <img
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
          Mot de passe oublié
        </h2>
        <p className="mt-2 text-center text-sm text-gray-600">
          Entrez votre adresse email pour recevoir un lien de réinitialisation
        </p>
      </div>

      <div className="mt-8 sm:mx-auto sm:w-full sm:max-w-md" style={{zIndex: 1}}>
        <div className="bg-white py-8 px-4 shadow-xl sm:rounded-lg sm:px-10">
          {/* Message d'erreur */}
          {error && (
            <div className="mb-6">
              <div className="bg-red-50 border border-red-200 rounded-lg p-4">
                <div className="flex items-start">
                  <div className="flex-shrink-0">
                    <svg
                      className="h-5 w-5 text-red-400"
                      fill="currentColor"
                      viewBox="0 0 20 20"
                    >
                      <path
                        fillRule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z"
                        clipRule="evenodd"
                      />
                    </svg>
                  </div>
                  <div className="ml-3">
                    <p className="text-sm text-red-700">{error}</p>
                  </div>
                </div>
              </div>
            </div>
          )}

          {/* Formulaire */}
          <form onSubmit={handleSubmit} className="space-y-6">
            <div>
              <label
                htmlFor="email"
                className="block text-sm font-medium text-gray-700 mb-2"
              >
                Adresse email
              </label>
              <input
                id="email"
                name="email"
                type="email"
                autoComplete="email"
                required
                value={email}
                onChange={(e) => setEmail(e.target.value)}
                className="appearance-none relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500 focus:z-10 sm:text-sm"
                placeholder="votre@email.com"
              />
            </div>

            <div>
              <button
                type="submit"
                disabled={loading}
                className="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200"
              >
                {loading ? (
                  <div className="flex items-center">
                    <svg
                      className="animate-spin -ml-1 mr-3 h-5 w-5 text-white"
                      xmlns="http://www.w3.org/2000/svg"
                      fill="none"
                      viewBox="0 0 24 24"
                    >
                      <circle
                        className="opacity-25"
                        cx="12"
                        cy="12"
                        r="10"
                        stroke="currentColor"
                        strokeWidth="4"
                      ></circle>
                      <path
                        className="opacity-75"
                        fill="currentColor"
                        d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
                      ></path>
                    </svg>
                    Envoi en cours...
                  </div>
                ) : (
                  "Envoyer le lien de réinitialisation"
                )}
              </button>
            </div>
          </form>

          {/* Lien de retour */}
          <div className="mt-6 text-center">
            <Link
              href="/pages/login"
              className="text-sm text-blue-600 hover:text-blue-500 transition-colors duration-200"
            >
              ← Retour à la connexion
            </Link>
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
          </div>
          <p className="mt-2 text-xs text-gray-400">
            © 2025 Techem France. Tous droits réservés.
          </p>
        </div>
      </div>
    </div>
  );
};

export default ResetPasswordPage;
