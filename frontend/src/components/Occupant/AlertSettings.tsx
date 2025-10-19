"use client";

import React, { useState } from "react";

interface AlertSettingsProps {
  initialSettings?: {
    seuilConsoActif: boolean;
    seuilConsoEmail: string;
    seuilConsoEF: number;
    seuilConsoEC: number;
  };
  onSave?: (settings: AlertSettings) => void;
}

interface AlertSettings {
  seuilConsoActif: boolean;
  seuilConsoEmail: string;
  seuilConsoEF: number;
  seuilConsoEC: number;
}

const AlertSettings: React.FC<AlertSettingsProps> = ({
  initialSettings = {
    seuilConsoActif: false,
    seuilConsoEmail: "",
    seuilConsoEF: 0,
    seuilConsoEC: 0,
  },
  onSave,
}) => {
  const [settings, setSettings] = useState<AlertSettings>(initialSettings);
  const [isLoading, setIsLoading] = useState(false);

  const handleInputChange = (
    field: keyof AlertSettings,
    value: string | boolean | number
  ) => {
    setSettings((prev) => ({
      ...prev,
      [field]: value,
    }));
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setIsLoading(true);

    try {
      // Simulate API call
      await new Promise((resolve) => setTimeout(resolve, 1000));
      onSave?.(settings);
    } catch (error) {
      console.error("Error saving alert settings:", error);
    } finally {
      setIsLoading(false);
    }
  };

  return (
    <div className="max-w-4xl mx-auto">
      <div className="bg-white rounded-lg shadow-md p-6">
        <h2 className="text-2xl font-bold text-gray-800 mb-6">
          Paramètre de l'alerte
        </h2>

        <form onSubmit={handleSubmit} className="space-y-6">
          {/* Alert Activation */}
          <div className="bg-blue-50 border border-blue-200 rounded-lg p-6">
            <div className="flex items-center space-x-3 mb-4">
              <input
                type="checkbox"
                id="seuilConsoActif"
                checked={settings.seuilConsoActif}
                onChange={(e) =>
                  handleInputChange("seuilConsoActif", e.target.checked)
                }
                className="w-5 h-5 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500"
              />
              <label
                htmlFor="seuilConsoActif"
                className="text-lg font-semibold text-gray-800"
              >
                Activer l'alerte
              </label>
            </div>

            <div className="w-full max-w-md">
              <label
                htmlFor="seuilConsoEmail"
                className="block text-sm font-medium text-gray-700 mb-2"
              >
                E-mail de réception
              </label>
              <input
                type="email"
                id="seuilConsoEmail"
                value={settings.seuilConsoEmail}
                onChange={(e) =>
                  handleInputChange("seuilConsoEmail", e.target.value)
                }
                placeholder="E-mail de réception"
                className="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg"
                required={settings.seuilConsoActif}
                disabled={!settings.seuilConsoActif}
              />
            </div>
          </div>

          {/* Water Consumption Thresholds */}
          <div className="space-y-6">
            <h3 className="text-lg font-semibold text-gray-800">
              Seuils d'alerte de consommation
            </h3>

            {/* Cold Water */}
            <div className="flex items-center space-x-6 p-6 border border-gray-200 rounded-lg bg-gray-50">
              <div className="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center">
                <i className="fas fa-tint text-blue-600 text-2xl"></i>
              </div>
              <div className="flex-1">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label
                      htmlFor="seuilConsoEF"
                      className="block text-sm font-medium text-gray-700 mb-2"
                    >
                      Seuil d'alerte en m³
                    </label>
                    <input
                      type="number"
                      id="seuilConsoEF"
                      value={settings.seuilConsoEF}
                      onChange={(e) =>
                        handleInputChange(
                          "seuilConsoEF",
                          parseFloat(e.target.value) || 0
                        )
                      }
                      placeholder="Seuil d'alerte en m³"
                      className="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg"
                      disabled={!settings.seuilConsoActif}
                    />
                  </div>
                  <div className="flex items-center">
                    <div className="text-center">
                      <div className="text-lg font-semibold text-gray-800">
                        Eau
                      </div>
                      <div className="text-lg font-semibold text-gray-800">
                        froide
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            {/* Hot Water */}
            <div className="flex items-center space-x-6 p-6 border border-gray-200 rounded-lg bg-gray-50">
              <div className="w-16 h-16 bg-red-100 rounded-lg flex items-center justify-center">
                <i className="fas fa-tint text-red-600 text-2xl"></i>
              </div>
              <div className="flex-1">
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  <div>
                    <label
                      htmlFor="seuilConsoEC"
                      className="block text-sm font-medium text-gray-700 mb-2"
                    >
                      Seuil d'alerte en m³
                    </label>
                    <input
                      type="number"
                      id="seuilConsoEC"
                      value={settings.seuilConsoEC}
                      onChange={(e) =>
                        handleInputChange(
                          "seuilConsoEC",
                          parseFloat(e.target.value) || 0
                        )
                      }
                      placeholder="Seuil d'alerte en m³"
                      className="w-full px-4 py-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-lg"
                      disabled={!settings.seuilConsoActif}
                    />
                  </div>
                  <div className="flex items-center">
                    <div className="text-center">
                      <div className="text-lg font-semibold text-gray-800">
                        Eau
                      </div>
                      <div className="text-lg font-semibold text-gray-800">
                        chaude
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          {/* Info Consumption Button */}
          <div className="flex justify-end">
            <button
              type="button"
              className="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition-colors duration-200 flex items-center"
            >
              <i className="fas fa-download mr-2"></i>
              Info Conso
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
                "Enregistrer"
              )}
            </button>
          </div>
        </form>

        {/* Information Panel */}
        <div className="mt-8 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
          <div className="flex items-start space-x-3">
            <i className="fas fa-info-circle text-yellow-600 text-xl mt-1"></i>
            <div>
              <h4 className="font-semibold text-yellow-800 mb-2">
                Comment fonctionnent les alertes ?
              </h4>
              <p className="text-sm text-yellow-700">
                Vous recevrez un e-mail automatique lorsque votre consommation
                d'eau dépassera les seuils définis. Les alertes sont vérifiées
                quotidiennement et vous permettent de détecter rapidement les
                fuites ou les consommations anormales.
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default AlertSettings;
