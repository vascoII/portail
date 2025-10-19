"use client";

import React, { useEffect } from "react";
import { useRouter } from "next/navigation";
import Link from "next/link";
import Image from "next/image";
import { useAuth } from "@/hooks/useAuth";
import LoginForm from "@/components/Forms/LoginForm";
import { LoginFormData } from "@/types/auth";
import { useDataStore } from "@/store/dataStore";

const LoginPage: React.FC = () => {
  const router = useRouter();
  const { login, isLoading, error, isAuthenticated } = useAuth();
  const { loginData } = useDataStore();

  // Rediriger si déjà connecté
  useEffect(() => {
    if (isAuthenticated) {
      router.push("/dashboard");
    }
  }, [isAuthenticated, router]);

  // Cleanup effect: ensure we're properly logged out when visiting login page
  useEffect(() => {
    // If we have loginData but no valid authentication, clear it
    if (loginData && !isAuthenticated) {
      console.log("Clearing stale login data on login page");
      // The useAuth hook will handle the cleanup
    }
  }, [loginData, isAuthenticated]);

  const handleLogin = async (credentials: LoginFormData): Promise<void> => {
    try {
      await login(credentials);
      // La redirection sera gérée par useEffect
    } catch (error) {
      // L'erreur est gérée par le hook useAuth
      console.error("Login failed:", error);
    }
  };

  if (isAuthenticated) {
    return (
      <div className="min-h-screen flex items-center justify-center">
        <div className="text-center">
          <div className="animate-spin rounded-full h-8 w-8 border-b-2 border-blue-600 mx-auto"></div>
          <p className="mt-2 text-gray-600">Redirection en cours...</p>
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
      <div className="sm:mx-auto sm:w-full sm:max-w-md" style={{ zIndex: 1 }}>
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
          Connexion
        </h2>
        <p className="mt-2 text-center text-sm text-gray-600">
          Accédez à votre espace client Techem
        </p>
      </div>

      <div
        className="mt-8 sm:mx-auto sm:w-full sm:max-w-md"
        style={{ zIndex: 1 }}
      >
        <div className="bg-white py-8 px-4 shadow-xl sm:rounded-lg sm:px-10">
          {/* Formulaire de connexion */}
          <LoginForm
            onSubmit={handleLogin}
            loading={isLoading}
            error={error?.message || null}
          />

          {/* Debug: Show stored login data (remove in production) */}
          {loginData && (
            <div className="mt-4 p-4 bg-gray-100 rounded-lg">
              <h3 className="text-sm font-medium text-gray-700 mb-2">
                Debug: Login Data Stored
              </h3>
              <pre className="text-xs text-gray-600 overflow-auto max-h-32">
                {JSON.stringify(loginData, null, 2)}
              </pre>
            </div>
          )}

          {/* Informations supplémentaires */}
          <div className="mt-6">
            <div className="relative">
              <div className="absolute inset-0 flex items-center">
                <div className="w-full border-t border-gray-300" />
              </div>
              <div className="relative flex justify-center text-sm">
                <span className="px-2 bg-white text-gray-500">
                  Besoin d'aide ?
                </span>
              </div>
            </div>

            <div className="mt-6 text-center">
              <p className="text-sm text-gray-600">
                Contactez le support technique au{" "}
                <a
                  href="tel:+33123456789"
                  className="font-medium text-blue-600 hover:text-blue-500"
                >
                  01 23 45 67 89
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

export default LoginPage;
