"use client";

import React, { useState } from "react";

interface OperatorFormData {
  job: string;
  lastname: string;
  firstname: string;
  phone: string;
  email: string;
  emailConfirm: string;
}

interface OperatorFormProps {
  initialData?: Partial<OperatorFormData>;
  onSubmit: (data: OperatorFormData) => Promise<void>;
  isEdit?: boolean;
}

const OperatorForm: React.FC<OperatorFormProps> = ({
  initialData = {},
  onSubmit,
  isEdit = false,
}) => {
  const [formData, setFormData] = useState<OperatorFormData>({
    job: initialData.job || "",
    lastname: initialData.lastname || "",
    firstname: initialData.firstname || "",
    phone: initialData.phone || "",
    email: initialData.email || "",
    emailConfirm: initialData.emailConfirm || "",
  });

  const [errors, setErrors] = useState<Partial<OperatorFormData>>({});
  const [isLoading, setIsLoading] = useState(false);

  const handleInputChange = (field: keyof OperatorFormData, value: string) => {
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
    const newErrors: Partial<OperatorFormData> = {};

    if (!formData.job.trim()) {
      newErrors.job = "Le poste est requis";
    }

    if (!formData.lastname.trim()) {
      newErrors.lastname = "Le nom est requis";
    }

    if (!formData.firstname.trim()) {
      newErrors.firstname = "Le prénom est requis";
    }

    if (!formData.phone.trim()) {
      newErrors.phone = "Le téléphone est requis";
    } else if (!/^[0-9]{10}$/.test(formData.phone.replace(/\s/g, ""))) {
      newErrors.phone = "Le téléphone doit contenir 10 chiffres";
    }

    if (!formData.email.trim()) {
      newErrors.email = "L'e-mail est requis";
    } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(formData.email)) {
      newErrors.email = "L'e-mail n'est pas valide";
    }

    if (!formData.emailConfirm.trim()) {
      newErrors.emailConfirm = "La confirmation d'e-mail est requise";
    } else if (formData.email !== formData.emailConfirm) {
      newErrors.emailConfirm = "Les e-mails ne correspondent pas";
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
      await onSubmit(formData);
    } catch (error) {
      console.error("Error submitting form:", error);
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <div className="max-w-2xl mx-auto">
      <div className="bg-white rounded-lg shadow-md p-6">
        <h2 className="text-2xl font-bold text-gray-800 mb-6">
          {isEdit ? "Modifier le gestionnaire" : "Créer un gestionnaire"}
        </h2>

        <form onSubmit={handleSubmit} className="space-y-6">
          {/* Job */}
          <div>
            <label
              htmlFor="job"
              className="block text-sm font-medium text-gray-700 mb-2"
            >
              Poste <span className="text-red-500">*</span>
            </label>
            <select
              id="job"
              value={formData.job}
              onChange={(e) => handleInputChange("job", e.target.value)}
              className={`w-full px-4 py-3 border rounded-md focus:outline-none focus:ring-2 ${
                errors.job
                  ? "border-red-300 focus:ring-red-500"
                  : "border-gray-300 focus:ring-blue-500"
              }`}
            >
              <option value="">Sélectionner un poste</option>
              <option value="Administrateur">Administrateur</option>
              <option value="Gestionnaire">Gestionnaire</option>
              <option value="Technicien">Technicien</option>
              <option value="Superviseur">Superviseur</option>
            </select>
            {errors.job && (
              <p className="mt-1 text-sm text-red-600">{errors.job}</p>
            )}
          </div>

          {/* Name Fields */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label
                htmlFor="lastname"
                className="block text-sm font-medium text-gray-700 mb-2"
              >
                Nom <span className="text-red-500">*</span>
              </label>
              <input
                type="text"
                id="lastname"
                value={formData.lastname}
                onChange={(e) => handleInputChange("lastname", e.target.value)}
                className={`w-full px-4 py-3 border rounded-md focus:outline-none focus:ring-2 ${
                  errors.lastname
                    ? "border-red-300 focus:ring-red-500"
                    : "border-gray-300 focus:ring-blue-500"
                }`}
                placeholder="Nom de famille"
              />
              {errors.lastname && (
                <p className="mt-1 text-sm text-red-600">{errors.lastname}</p>
              )}
            </div>

            <div>
              <label
                htmlFor="firstname"
                className="block text-sm font-medium text-gray-700 mb-2"
              >
                Prénom <span className="text-red-500">*</span>
              </label>
              <input
                type="text"
                id="firstname"
                value={formData.firstname}
                onChange={(e) => handleInputChange("firstname", e.target.value)}
                className={`w-full px-4 py-3 border rounded-md focus:outline-none focus:ring-2 ${
                  errors.firstname
                    ? "border-red-300 focus:ring-red-500"
                    : "border-gray-300 focus:ring-blue-500"
                }`}
                placeholder="Prénom"
              />
              {errors.firstname && (
                <p className="mt-1 text-sm text-red-600">{errors.firstname}</p>
              )}
            </div>
          </div>

          {/* Phone */}
          <div>
            <label
              htmlFor="phone"
              className="block text-sm font-medium text-gray-700 mb-2"
            >
              Téléphone <span className="text-red-500">*</span>
            </label>
            <input
              type="tel"
              id="phone"
              value={formData.phone}
              onChange={(e) => handleInputChange("phone", e.target.value)}
              className={`w-full px-4 py-3 border rounded-md focus:outline-none focus:ring-2 ${
                errors.phone
                  ? "border-red-300 focus:ring-red-500"
                  : "border-gray-300 focus:ring-blue-500"
              }`}
              placeholder="0123456789"
              maxLength={10}
            />
            {errors.phone && (
              <p className="mt-1 text-sm text-red-600">{errors.phone}</p>
            )}
          </div>

          {/* Email Fields */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div>
              <label
                htmlFor="email"
                className="block text-sm font-medium text-gray-700 mb-2"
              >
                E-mail <span className="text-red-500">*</span>
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
                placeholder="email@example.com"
              />
              {errors.email && (
                <p className="mt-1 text-sm text-red-600">{errors.email}</p>
              )}
            </div>

            <div>
              <label
                htmlFor="emailConfirm"
                className="block text-sm font-medium text-gray-700 mb-2"
              >
                Confirmer l'e-mail <span className="text-red-500">*</span>
              </label>
              <input
                type="email"
                id="emailConfirm"
                value={formData.emailConfirm}
                onChange={(e) =>
                  handleInputChange("emailConfirm", e.target.value)
                }
                className={`w-full px-4 py-3 border rounded-md focus:outline-none focus:ring-2 ${
                  errors.emailConfirm
                    ? "border-red-300 focus:ring-red-500"
                    : "border-gray-300 focus:ring-blue-500"
                }`}
                placeholder="email@example.com"
              />
              {errors.emailConfirm && (
                <p className="mt-1 text-sm text-red-600">
                  {errors.emailConfirm}
                </p>
              )}
            </div>
          </div>

          {/* Submit Button */}
          <div className="flex items-center justify-between pt-6 border-t border-gray-200">
            <div className="text-sm text-gray-500">
              <span className="text-red-500">*</span> Champs obligatoires
            </div>
            <button
              type="submit"
              disabled={isLoading}
              className="bg-blue-600 hover:bg-blue-700 disabled:bg-gray-400 text-white px-8 py-3 rounded-lg text-lg font-semibold transition-colors duration-200"
            >
              {isLoading ? (
                <div className="flex items-center">
                  <div className="animate-spin rounded-full h-5 w-5 border-b-2 border-white mr-2"></div>
                  {isEdit ? "Modification..." : "Création..."}
                </div>
              ) : isEdit ? (
                "Modifier"
              ) : (
                "Créer le compte"
              )}
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default OperatorForm;
