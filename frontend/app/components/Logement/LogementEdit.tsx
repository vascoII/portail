"use client";

import React, { useState, useEffect } from "react";

interface LogementEditProps {
  logement: {
    Logement: {
      PkLogement: number;
    };
    Occupant: {
      Ref: string;
      Nom: string;
      DateArrivee: string;
    };
  };
  occupant?: {
    newTelmobile?: string;
    newEmail?: string;
  };
  changeInProgress?: boolean;
  onSubmit: (data: { email: string; phone: string }) => void;
}

const LogementEdit: React.FC<LogementEditProps> = ({
  logement,
  occupant,
  changeInProgress = false,
  onSubmit,
}) => {
  const [formData, setFormData] = useState({
    email: occupant?.newEmail || "",
    phone: occupant?.newTelmobile || "",
  });
  const [errors, setErrors] = useState<{ [key: string]: string }>({});
  const [isEditing, setIsEditing] = useState(false);

  const validateForm = () => {
    const newErrors: { [key: string]: string } = {};

    if (!formData.email) {
      newErrors.email = "Adresse e-mail requise";
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)) {
      newErrors.email = "Adresse e-mail invalide";
    }

    if (!formData.phone) {
      newErrors.phone = "Numéro de téléphone requis";
    } else if (!/^[0-9]{10}$/.test(formData.phone)) {
      newErrors.phone =
        "Veuillez saisir un numéro de téléphone valide à 10 chiffres";
    }

    setErrors(newErrors);
    return Object.keys(newErrors).length === 0;
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (validateForm()) {
      onSubmit(formData);
    }
  };

  const handleInputChange = (field: string, value: string) => {
    setFormData((prev) => ({
      ...prev,
      [field]: value,
    }));

    // Clear error when user starts typing
    if (errors[field]) {
      setErrors((prev) => ({
        ...prev,
        [field]: "",
      }));
    }
  };

  const toggleEditing = () => {
    setIsEditing(!isEditing);
    if (!isEditing) {
      // Reset form when starting to edit
      setFormData({
        email: occupant?.newEmail || "",
        phone: occupant?.newTelmobile || "",
      });
      setErrors({});
    }
  };

  return (
    <div className="bg-white rounded-lg shadow-md p-6">
      <div className="flex items-start space-x-4">
        <div className="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
          <i className="fas fa-user text-blue-600 text-xl"></i>
        </div>
        <div className="flex-1">
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <p className="text-lg font-semibold text-gray-800">
                <strong>Occupant :</strong> {logement.Occupant.Nom}
              </p>
              <p className="text-sm text-gray-600">
                <strong>Date d'arrivée :</strong>{" "}
                {new Date(logement.Occupant.DateArrivee).toLocaleDateString(
                  "fr-FR"
                )}
              </p>
            </div>

            <div>
              <h4 className="text-lg font-semibold text-gray-800 mb-4">
                Nouvelles coordonnées
              </h4>

              {changeInProgress && (
                <div className="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded mb-4">
                  <p className="font-medium">
                    Une demande de changement est actuellement en attente de
                    traitement par les équipes Techem. Vous pouvez néanmoins
                    modifier les données de cette demande :
                  </p>
                </div>
              )}

              <form onSubmit={handleSubmit} className="space-y-4">
                <div>
                  <label className="block text-sm font-medium text-gray-700 mb-2">
                    <i className="fas fa-phone mr-2"></i>
                    Téléphone
                  </label>
                  <div className="relative">
                    <input
                      type="text"
                      value={formData.phone}
                      onChange={(e) =>
                        handleInputChange("phone", e.target.value)
                      }
                      pattern="^[0-9]{10}$"
                      required
                      disabled={!isEditing}
                      className={`w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 ${
                        errors.phone
                          ? "border-red-300 focus:ring-red-500"
                          : "border-gray-300"
                      } ${!isEditing ? "bg-gray-50 text-gray-500" : ""}`}
                      placeholder="Entrez le numéro de téléphone"
                    />
                    {!isEditing && (
                      <button
                        type="button"
                        onClick={toggleEditing}
                        className="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                      >
                        <i className="fas fa-pencil"></i>
                      </button>
                    )}
                  </div>
                  {errors.phone && (
                    <p className="mt-1 text-sm text-red-600">{errors.phone}</p>
                  )}
                </div>

                <div>
                  <label className="block text-sm font-medium text-gray-700 mb-2">
                    <i className="fas fa-envelope mr-2"></i>
                    E-mail
                  </label>
                  <div className="relative">
                    <input
                      type="email"
                      value={formData.email}
                      onChange={(e) =>
                        handleInputChange("email", e.target.value)
                      }
                      required
                      disabled={!isEditing}
                      className={`w-full px-3 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 ${
                        errors.email
                          ? "border-red-300 focus:ring-red-500"
                          : "border-gray-300"
                      } ${!isEditing ? "bg-gray-50 text-gray-500" : ""}`}
                      placeholder="Entrez l'adresse e-mail"
                    />
                    {!isEditing && (
                      <button
                        type="button"
                        onClick={toggleEditing}
                        className="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600"
                      >
                        <i className="fas fa-pencil"></i>
                      </button>
                    )}
                  </div>
                  {errors.email && (
                    <p className="mt-1 text-sm text-red-600">{errors.email}</p>
                  )}
                </div>

                {isEditing && (
                  <div className="flex space-x-2">
                    <button
                      type="button"
                      onClick={toggleEditing}
                      className="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors duration-200"
                    >
                      Annuler
                    </button>
                    <button
                      type="submit"
                      className="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors duration-200"
                    >
                      Enregistrer
                    </button>
                  </div>
                )}
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default LogementEdit;
