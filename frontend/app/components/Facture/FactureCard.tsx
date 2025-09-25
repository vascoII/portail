"use client";

import React from "react";
import Link from "next/link";

interface FactureCardProps {
  facture: {
    PKFacture: number;
    NumFacture: string;
    CodeGestio: string;
    Adresse: string;
    Ville: string;
    CP: string;
    DateEdition: string;
    MontantTotalHT: number;
    MontantTotalTTC: number;
    MontantTotalAPayer: number;
  };
}

const FactureCard: React.FC<FactureCardProps> = ({ facture }) => {
  const formatCurrency = (amount: number) => {
    return new Intl.NumberFormat("fr-FR", {
      style: "currency",
      currency: "EUR",
    }).format(amount);
  };

  const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString("fr-FR");
  };

  const getAmountColor = (amount: number) => {
    if (amount >= 5000) return "text-red-600";
    if (amount >= 1000) return "text-orange-600";
    return "text-green-600";
  };

  const getAmountBgColor = (amount: number) => {
    if (amount >= 5000) return "bg-red-50 border-red-200";
    if (amount >= 1000) return "bg-orange-50 border-orange-200";
    return "bg-green-50 border-green-200";
  };

  return (
    <div className="bg-white rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 border border-gray-200">
      <div className="p-6">
        {/* Header */}
        <div className="flex items-start justify-between mb-4">
          <div className="flex-1">
            <div className="flex items-center space-x-3 mb-2">
              <div className="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                <i className="fas fa-file-invoice text-blue-600 text-lg"></i>
              </div>
              <div>
                <h3 className="text-lg font-semibold text-gray-800">
                  {facture.NumFacture}
                </h3>
                <p className="text-sm text-gray-600">
                  Code: {facture.CodeGestio}
                </p>
              </div>
            </div>
          </div>

          {/* Download Button */}
          <Link
            href={`/factures/download/${facture.PKFacture}`}
            target="_blank"
            className="bg-blue-600 hover:bg-blue-700 text-white px-3 py-2 rounded-lg transition-colors duration-200 flex items-center"
          >
            <i className="fas fa-download mr-2"></i>
            Télécharger
          </Link>
        </div>

        {/* Address */}
        <div className="mb-4">
          <div className="flex items-start space-x-2">
            <i className="fas fa-map-marker-alt text-gray-400 mt-1"></i>
            <div>
              <p className="text-sm text-gray-800">{facture.Adresse}</p>
              <p className="text-sm text-gray-600">
                {facture.CP} {facture.Ville}
              </p>
            </div>
          </div>
        </div>

        {/* Date */}
        <div className="mb-4">
          <div className="flex items-center space-x-2">
            <i className="fas fa-calendar text-gray-400"></i>
            <span className="text-sm text-gray-600">
              Date d'émission:{" "}
              <strong>{formatDate(facture.DateEdition)}</strong>
            </span>
          </div>
        </div>

        {/* Amounts */}
        <div className="space-y-3">
          <div
            className={`p-3 rounded-lg border ${getAmountBgColor(
              facture.MontantTotalAPayer
            )}`}
          >
            <div className="flex justify-between items-center">
              <span className="text-sm font-medium text-gray-700">
                Montant à payer
              </span>
              <span
                className={`text-lg font-bold ${getAmountColor(
                  facture.MontantTotalAPayer
                )}`}
              >
                {formatCurrency(facture.MontantTotalAPayer)}
              </span>
            </div>
          </div>

          <div className="grid grid-cols-2 gap-3 text-sm">
            <div className="bg-gray-50 p-3 rounded">
              <div className="text-gray-600 mb-1">Montant HT</div>
              <div className="font-semibold text-gray-800">
                {formatCurrency(facture.MontantTotalHT)}
              </div>
            </div>
            <div className="bg-gray-50 p-3 rounded">
              <div className="text-gray-600 mb-1">Montant TTC</div>
              <div className="font-semibold text-gray-800">
                {formatCurrency(facture.MontantTotalTTC)}
              </div>
            </div>
          </div>
        </div>

        {/* Status Indicator */}
        <div className="mt-4 pt-4 border-t border-gray-200">
          <div className="flex items-center justify-between">
            <div className="flex items-center space-x-2">
              <div
                className={`w-2 h-2 rounded-full ${
                  facture.MontantTotalAPayer > 0
                    ? "bg-orange-400"
                    : "bg-green-400"
                }`}
              ></div>
              <span className="text-xs text-gray-600">
                {facture.MontantTotalAPayer > 0
                  ? "En attente de paiement"
                  : "Payée"}
              </span>
            </div>
            <span className="text-xs text-gray-500">
              Facture #{facture.PKFacture}
            </span>
          </div>
        </div>
      </div>
    </div>
  );
};

export default FactureCard;
