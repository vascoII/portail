"use client";

import React, { useState } from "react";

interface InterventionModalProps {
  isOpen: boolean;
  onClose: () => void;
}

const InterventionModal: React.FC<InterventionModalProps> = ({
  isOpen,
  onClose,
}) => {
  const [dateBegin, setDateBegin] = useState("");
  const [dateEnd, setDateEnd] = useState("");
  const [showWarning, setShowWarning] = useState(false);

  const handleSubmit = (e: React.FormEvent, docType: string) => {
    e.preventDefault();

    if (!dateBegin || !dateEnd) {
      setShowWarning(true);
      return;
    }

    setShowWarning(false);
    // Handle form submission here
    console.log("Submitting intervention form:", {
      docType,
      dateBegin,
      dateEnd,
    });
  };

  if (!isOpen) return null;

  return (
    <div className="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
      <div className="bg-white rounded-lg p-6 max-w-md w-full mx-4 relative">
        {/* Close button */}
        <button
          onClick={onClose}
          className="absolute top-4 right-4 text-gray-500 hover:text-gray-700"
        >
          <i className="fas fa-times text-xl"></i>
        </button>

        <h4 className="text-xl font-semibold mb-6">Livret d'intervention</h4>

        <form className="space-y-4">
          <div className="grid grid-cols-2 gap-4">
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">
                Du
              </label>
              <input
                type="date"
                value={dateBegin}
                onChange={(e) => setDateBegin(e.target.value)}
                className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">
                Au
              </label>
              <input
                type="date"
                value={dateEnd}
                onChange={(e) => setDateEnd(e.target.value)}
                className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
          </div>

          {showWarning && (
            <div className="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded">
              Vous devez remplir les deux champs de dates
            </div>
          )}

          <div className="space-y-2">
            <button
              type="button"
              onClick={(e) => handleSubmit(e, "synthese-inte")}
              className="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition-colors duration-200"
            >
              Synthèse des interventions
            </button>
            <button
              type="button"
              onClick={(e) => handleSubmit(e, "detail-inte")}
              className="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-md transition-colors duration-200"
            >
              Détail des interventions
            </button>
            <button
              type="button"
              onClick={(e) => handleSubmit(e, "detail-excel-inte")}
              className="w-full bg-orange-600 hover:bg-orange-700 text-white py-2 px-4 rounded-md transition-colors duration-200"
            >
              Détail des interventions (Excel)
            </button>
          </div>
        </form>
      </div>
    </div>
  );
};

export default InterventionModal;
