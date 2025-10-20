"use client";

import React from "react";
import Link from "next/link";

interface FactureDetailProps {
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
    TVA?: number;
    Details?: Array<{
      Description: string;
      Quantite: number;
      PrixUnitaire: number;
      MontantHT: number;
      TVA: number;
      MontantTTC: number;
    }>;
  };
}

const FactureDetail: React.FC<FactureDetailProps> = ({ facture }) => {
  const formatCurrency = (amount: number) => {
    return new Intl.NumberFormat("fr-FR", {
      style: "currency",
      currency: "EUR",
    }).format(amount);
  };

  const formatDate = (dateString: string) => {
    return new Date(dateString).toLocaleDateString("fr-FR", {
      year: "numeric",
      month: "long",
      day: "numeric",
    });
  };

  const getStatusColor = (amount: number) => {
    if (amount > 0) return "text-orange-600 bg-orange-50 border-orange-200";
    return "text-green-600 bg-green-50 border-green-200";
  };

  const getStatusText = (amount: number) => {
    if (amount > 0) return "En attente de paiement";
    return "Payée";
  };

  const tvaAmount = facture.MontantTotalTTC - facture.MontantTotalHT;
  const tvaRate =
    facture.MontantTotalHT > 0 ? (tvaAmount / facture.MontantTotalHT) * 100 : 0;

  return (
    <div className="space-y-6">
      {/* Header */}
      <div className="bg-white rounded-lg shadow-md p-6">
        <div className="flex items-start justify-between mb-6">
          <div className="flex items-center space-x-4">
            <div className="w-16 h-16 bg-blue-100 rounded-lg flex items-center justify-center">
              <i className="fas fa-file-invoice text-blue-600 text-2xl"></i>
            </div>
            <div>
              <h1 className="text-2xl font-bold text-gray-800">
                {facture.NumFacture}
              </h1>
              <p className="text-gray-600">
                Code gestionnaire: {facture.CodeGestio}
              </p>
              <p className="text-sm text-gray-500">
                Facture #{facture.PKFacture}
              </p>
            </div>
          </div>

          <div className="flex space-x-3">
            <Link
              href={`/factures/download/${facture.PKFacture}`}
              target="_blank"
              className="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center"
            >
              <i className="fas fa-download mr-2"></i>
              Télécharger PDF
            </Link>
            <button className="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center">
              <i className="fas fa-print mr-2"></i>
              Imprimer
            </button>
          </div>
        </div>

        {/* Status */}
        <div
          className={`inline-flex items-center px-4 py-2 rounded-full border ${getStatusColor(
            facture.MontantTotalAPayer
          )}`}
        >
          <div
            className={`w-2 h-2 rounded-full mr-2 ${
              facture.MontantTotalAPayer > 0 ? "bg-orange-400" : "bg-green-400"
            }`}
          ></div>
          <span className="font-medium">
            {getStatusText(facture.MontantTotalAPayer)}
          </span>
        </div>
      </div>

      {/* Invoice Information */}
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Billing Address */}
        <div className="bg-white rounded-lg shadow-md p-6">
          <h3 className="text-lg font-semibold text-gray-800 mb-4">
            <i className="fas fa-map-marker-alt mr-2 text-blue-600"></i>
            Adresse de facturation
          </h3>
          <div className="space-y-2">
            <p className="text-gray-800">{facture.Adresse}</p>
            <p className="text-gray-600">
              {facture.CP} {facture.Ville}
            </p>
          </div>
        </div>

        {/* Invoice Details */}
        <div className="bg-white rounded-lg shadow-md p-6">
          <h3 className="text-lg font-semibold text-gray-800 mb-4">
            <i className="fas fa-info-circle mr-2 text-blue-600"></i>
            Détails de la facture
          </h3>
          <div className="space-y-3">
            <div className="flex justify-between">
              <span className="text-gray-600">Date d'émission:</span>
              <span className="font-medium">
                {formatDate(facture.DateEdition)}
              </span>
            </div>
            <div className="flex justify-between">
              <span className="text-gray-600">Code gestionnaire:</span>
              <span className="font-medium">{facture.CodeGestio}</span>
            </div>
            <div className="flex justify-between">
              <span className="text-gray-600">Numéro de facture:</span>
              <span className="font-medium">{facture.NumFacture}</span>
            </div>
          </div>
        </div>
      </div>

      {/* Amount Summary */}
      <div className="bg-white rounded-lg shadow-md p-6">
        <h3 className="text-lg font-semibold text-gray-800 mb-6">
          <i className="fas fa-calculator mr-2 text-blue-600"></i>
          Récapitulatif des montants
        </h3>

        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          {/* Montant HT */}
          <div className="bg-gray-50 p-4 rounded-lg">
            <div className="text-sm text-gray-600 mb-2">Montant HT</div>
            <div className="text-2xl font-bold text-gray-800">
              {formatCurrency(facture.MontantTotalHT)}
            </div>
          </div>

          {/* TVA */}
          <div className="bg-gray-50 p-4 rounded-lg">
            <div className="text-sm text-gray-600 mb-2">
              TVA ({tvaRate.toFixed(1)}%)
            </div>
            <div className="text-2xl font-bold text-gray-800">
              {formatCurrency(tvaAmount)}
            </div>
          </div>

          {/* Montant TTC */}
          <div className="bg-gray-50 p-4 rounded-lg">
            <div className="text-sm text-gray-600 mb-2">Montant TTC</div>
            <div className="text-2xl font-bold text-gray-800">
              {formatCurrency(facture.MontantTotalTTC)}
            </div>
          </div>
        </div>

        {/* Montant à payer */}
        <div className="mt-6 pt-6 border-t border-gray-200">
          <div
            className={`p-6 rounded-lg border-2 ${getStatusColor(
              facture.MontantTotalAPayer
            )}`}
          >
            <div className="flex justify-between items-center">
              <div>
                <div className="text-lg font-semibold">Montant à payer</div>
                <div className="text-sm opacity-75">
                  {facture.MontantTotalAPayer > 0
                    ? "En attente de paiement"
                    : "Facture payée"}
                </div>
              </div>
              <div className="text-3xl font-bold">
                {formatCurrency(facture.MontantTotalAPayer)}
              </div>
            </div>
          </div>
        </div>
      </div>

      {/* Invoice Details Table */}
      {facture.Details && facture.Details.length > 0 && (
        <div className="bg-white rounded-lg shadow-md overflow-hidden">
          <div className="px-6 py-4 border-b border-gray-200">
            <h3 className="text-lg font-semibold text-gray-800">
              <i className="fas fa-list mr-2 text-blue-600"></i>
              Détail des prestations
            </h3>
          </div>
          <div className="overflow-x-auto">
            <table className="min-w-full divide-y divide-gray-200">
              <thead className="bg-gray-50">
                <tr>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Description
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Quantité
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Prix unitaire
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Montant HT
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    TVA
                  </th>
                  <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                    Montant TTC
                  </th>
                </tr>
              </thead>
              <tbody className="bg-white divide-y divide-gray-200">
                {facture.Details.map((detail, index) => (
                  <tr key={index}>
                    <td className="px-6 py-4 text-sm text-gray-900">
                      {detail.Description}
                    </td>
                    <td className="px-6 py-4 text-sm text-gray-900">
                      {detail.Quantite}
                    </td>
                    <td className="px-6 py-4 text-sm text-gray-900">
                      {formatCurrency(detail.PrixUnitaire)}
                    </td>
                    <td className="px-6 py-4 text-sm text-gray-900">
                      {formatCurrency(detail.MontantHT)}
                    </td>
                    <td className="px-6 py-4 text-sm text-gray-900">
                      {formatCurrency(detail.TVA)}
                    </td>
                    <td className="px-6 py-4 text-sm font-medium text-gray-900">
                      {formatCurrency(detail.MontantTTC)}
                    </td>
                  </tr>
                ))}
              </tbody>
            </table>
          </div>
        </div>
      )}

      {/* Payment Information */}
      {facture.MontantTotalAPayer > 0 && (
        <div className="bg-orange-50 border border-orange-200 rounded-lg p-6">
          <div className="flex items-start space-x-3">
            <i className="fas fa-exclamation-triangle text-orange-500 text-xl mt-1"></i>
            <div>
              <h4 className="text-lg font-semibold text-orange-800 mb-2">
                Paiement en attente
              </h4>
              <p className="text-orange-700 mb-4">
                Cette facture d'un montant de{" "}
                <strong>{formatCurrency(facture.MontantTotalAPayer)}</strong>{" "}
                est en attente de paiement.
              </p>
              <div className="flex space-x-3">
                <button className="bg-orange-600 hover:bg-orange-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                  <i className="fas fa-credit-card mr-2"></i>
                  Payer en ligne
                </button>
                <button className="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                  <i className="fas fa-envelope mr-2"></i>
                  Contacter le service
                </button>
              </div>
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default FactureDetail;
