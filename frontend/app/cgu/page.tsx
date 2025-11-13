"use client";

import { useState } from "react";
import Image from "next/image";
import { useDataStore } from "@/src/store/dataStore";
import { CGUForm } from "@/src/shared/components/CGU/CGUForm";
import { OccupantCGUContent } from "@/src/shared/components/CGU/OccupantCGUContent";
import { ClientCGUContent } from "@/src/shared/components/CGU/ClientCGUContent";

export default function CGUPage() {
  const loginData = useDataStore((state) => state.loginData);
  const [error, setError] = useState<string | null>(null);
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (
    email: string,
    emailConfirm: string,
    acceptedCGU: boolean
  ) => {
    setError(null);
    setLoading(true);

    try {
      // Validation côté client
      if (email !== emailConfirm) {
        setError("Les deux adresses email ne correspondent pas");
        setLoading(false);
        return;
      }

      if (!acceptedCGU) {
        setError("Vous devez accepter les Conditions Générales d'Utilisation");
        setLoading(false);
        return;
      }

      // Validation email
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        setError("Veuillez entrer une adresse email valide");
        setLoading(false);
        return;
      }

      // Appels API
      await Promise.all([
        fetch("/api/security/patch-cgu", {
          method: "PATCH",
          headers: {
            "Content-Type": "application/json",
          },
        }),
        fetch("/api/security/patch-email", {
          method: "PATCH",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify({ email }),
        }),
      ]);

      // Redirection (à implémenter plus tard)
      console.log("CGU accepted, redirecting...");
    } catch (error) {
      console.error("Error accepting CGU:", error);
      setError("Une erreur est survenue lors de la validation des CGU");
    } finally {
      setLoading(false);
    }
  };

  // Déterminer le contenu selon le type d'utilisateur
  const renderCGUContent = () => {
    if (!loginData?.userType) return null;

    switch (loginData.userType) {
      case "O":
        return <OccupantCGUContent />;
      case "C":
      case "G":
        return <ClientCGUContent />;
      default:
        return <ClientCGUContent />;
    }
  };

  return (
    <div className="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
      <div className="max-w-2xl w-full space-y-8">
        {/* Logo */}
        <div className="text-center">
          <Image
            width={0}
            height={0}
            className="h-20 w-auto mx-auto"
            src="/images/logo.svg"
            alt="Techem Logo"
          />
        </div>

        {/* Title */}
        <div className="text-center">
          <h2 className="text-3xl font-extrabold text-gray-900">
            Première connexion
          </h2>
          <p className="mt-2 text-sm text-gray-600">
            Vous devez valider les CGU pour pouvoir accéder à l'espace client.
          </p>
        </div>

        {/* CGU Content */}
        <div className="bg-white shadow rounded-lg p-6 max-h-96 overflow-y-auto">
          {renderCGUContent()}
        </div>

        {/* Error Message */}
        {error && (
          <div className="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded">
            {error}
          </div>
        )}

        {/* Form */}
        <CGUForm onSubmit={handleSubmit} loading={loading} />
      </div>
    </div>
  );
}
