"use client";

import React, { useState } from "react";

interface OccupantAccountProps {
  occupant: {
    PkOccupant: number;
    Ref: string;
    Nom: string;
    DateArrivee: string;
    Email?: string;
    Telephone?: string;
  };
  onSave?: (data: OccupantAccountData) => void;
}

interface OccupantAccountData {
  email: string;
  telephone: string;
  rgpdConsent: boolean;
}

const OccupantAccount: React.FC<OccupantAccountProps> = ({
  occupant,
  onSave,
}) => {
  const [formData, setFormData] = useState<OccupantAccountData>({
    email: occupant.Email || "",
    telephone: occupant.Telephone || "",
    rgpdConsent: false,
  });
  const [isLoading, setIsLoading] = useState(false);
  const [errors, setErrors] = useState<Partial<OccupantAccountData>>({});

  const handleInputChange = (
    field: keyof OccupantAccountData,
    value: string | boolean
  ) => {
    setFormData((prev) => ({
      ...prev,
      [field]: value,
    }));

    // Clear error when user starts typing
    if (errors[field]) {
      setErrors((prev) => ({
        ...prev,
        [field]: undefined,
      }));
    }
  };

  const validateForm = (): boolean => {
    const newErrors: Partial<OccupantAccountData> = {};

    if (!formData.email) {
      newErrors.email = "L'adresse e-mail est requise";
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)) {
      newErrors.email = "L'adresse e-mail n'est pas valide";
    }

    if (!formData.telephone) {
      newErrors.telephone = "Le numéro de téléphone est requis";
    } else if (!/^[0-9]{10}$/.test(formData.telephone)) {
      newErrors.telephone = "Le numéro de téléphone doit contenir 10 chiffres";
    }

    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();

    if (!validateForm()) {
      return;
    }

    setIsLoading(true);

    try {
      // Simulate API call
      await new Promise((resolve) => setTimeout(resolve, 1000));
      onSave?.(formData);
    } catch (error) {
      console.error("Error saving account data:", error);
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <div className="max-w-4xl mx-auto">
      <div className="bg-white rounded-lg shadow-md p-6">
        <h2 className="text-2xl font-bold text-gray-800 mb-6">Mon compte</h2>

        {/* Occupant Info */}
        <div className="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-6">
          <div className="flex items-start space-x-4">
            <div className="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center">
              <i className="fas fa-user text-blue-600 text-2xl"></i>
            </div>
            <div>
              <h3 className="text-lg font-semibold text-gray-800">
                Informations personnelles
              </h3>
              <div className="mt-2 space-y-1">
                <p className="text-sm text-gray-600">
                  <strong>Nom :</strong> {occupant.Nom}
                </p>
                <p className="text-sm text-gray-600">
                  <strong>Référence :</strong> {occupant.Ref}
                </p>
                <p className="text-sm text-gray-600">
                  <strong>Date d'arrivée :</strong>{" "}
                  {new Date(occupant.DateArrivee).toLocaleDateString("fr-FR")}
                </p>
              </div>
            </div>
          </div>
        </div>

        <form onSubmit={handleSubmit} className="space-y-6">
          {/* Contact Information */}
          <div className="space-y-4">
            <h3 className="text-lg font-semibold text-gray-800">
              Coordonnées de contact
            </h3>

            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              <div>
                <label
                  htmlFor="email"
                  className="block text-sm font-medium text-gray-700 mb-2"
                >
                  Adresse e-mail
                </label>
                <input
                  type="email"
                  id="email"
                  value={formData.email}
                  onChange={(e) => handleInputChange("email", e.target.value)}
                  className={`w-full px-4 py-3 border rounded-md focus:outline-none focus:ring-2 ${
                    errors.email
                      ? "border-red-300 focus:ring-red-500"
                      : "border-gray-300 focus:ring-blue-500"
                  }`}
                  placeholder="votre@email.com"
                />
                {errors.email && (
                  <p className="mt-1 text-sm text-red-600">{errors.email}</p>
                )}
              </div>

              <div>
                <label
                  htmlFor="telephone"
                  className="block text-sm font-medium text-gray-700 mb-2"
                >
                  Numéro de téléphone
                </label>
                <input
                  type="tel"
                  id="telephone"
                  value={formData.telephone}
                  onChange={(e) =>
                    handleInputChange("telephone", e.target.value)
                  }
                  className={`w-full px-4 py-3 border rounded-md focus:outline-none focus:ring-2 ${
                    errors.telephone
                      ? "border-red-300 focus:ring-red-500"
                      : "border-gray-300 focus:ring-blue-500"
                  }`}
                  placeholder="0123456789"
                  maxLength={10}
                />
                {errors.telephone && (
                  <p className="mt-1 text-sm text-red-600">
                    {errors.telephone}
                  </p>
                )}
              </div>
            </div>
          </div>

          {/* RGPD Consent */}
          <div className="bg-gray-50 border border-gray-200 rounded-lg p-6">
            <h3 className="text-lg font-semibold text-gray-800 mb-4">
              Consentement RGPD
            </h3>
            <div className="flex items-start space-x-3">
              <input
                type="checkbox"
                id="rgpdConsent"
                checked={formData.rgpdConsent}
                onChange={(e) =>
                  handleInputChange("rgpdConsent", e.target.checked)
                }
                className="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 mt-1"
              />
              <label htmlFor="rgpdConsent" className="text-sm text-gray-700">
                J'autorise mon gestionnaire à accéder à mes données de
                consommation pour l'analyse et la gestion de mon logement. Je
                comprends que ces données seront utilisées dans le respect de la
                réglementation RGPD.
              </label>
            </div>
          </div>

          {/* Password Change Section */}
          <div className="bg-yellow-50 border border-yellow-200 rounded-lg p-6">
            <h3 className="text-lg font-semibold text-gray-800 mb-4">
              Changer le mot de passe
            </h3>
            <p className="text-sm text-gray-600 mb-4">
              Pour des raisons de sécurité, vous pouvez changer votre mot de
              passe à tout moment.
            </p>
            <button
              type="button"
              className="bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-2 rounded-lg transition-colors duration-200"
            >
              <i className="fas fa-key mr-2"></i>
              Changer le mot de passe
            </button>
          </div>

          {/* Save Button */}
          <div className="text-center">
            <button
              type="submit"
              disabled={isLoading}
              className="bg-green-600 hover:bg-green-700 disabled:bg-gray-400 text-white px-8 py-3 rounded-lg text-lg font-semibold transition-colors duration-200"
            >
              {isLoading ? (
                <div className="flex items-center">
                  <div className="animate-spin rounded-full h-5 w-5 border-b-2 border-white mr-2"></div>
                  Enregistrement...
                </div>
              ) : (
                "Enregistrer les modifications"
              )}
            </button>
          </div>
        </form>

        {/* Information Panel */}
        <div className="mt-8 p-4 bg-blue-50 border border-blue-200 rounded-lg">
          <div className="flex items-start space-x-3">
            <i className="fas fa-info-circle text-blue-600 text-xl mt-1"></i>
            <div>
              <h4 className="font-semibold text-blue-800 mb-2">
                Protection de vos données
              </h4>
              <p className="text-sm text-blue-700">
                Vos informations personnelles sont protégées et ne seront jamais
                partagées avec des tiers sans votre consentement explicite. Nous
                utilisons des protocoles de sécurité avancés pour protéger vos
                données.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default OccupantAccount;
