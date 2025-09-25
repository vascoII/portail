"use client";

import React from "react";
import Link from "next/link";

interface ClientAlertsProps {
  data: {
    NbFuites: number;
    NbAnomalies: number;
    isDemo?: boolean;
  };
}

const ClientAlerts: React.FC<ClientAlertsProps> = ({ data }) => {
  return (
    <div className="col-span-8 lg:col-span-8 md:col-span-6">
      <div className="bg-white rounded-lg shadow-md p-6">
        <div className="text-lg font-semibold text-gray-800 mb-6">
          Alertes client
        </div>

        <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
          {/* Leaks Alert */}
          <Link
            href="/immeubles?fuites=1"
            className="block hover:bg-gray-50 p-4 rounded-lg transition-colors duration-200"
          >
            <div className="flex items-center">
              <div className="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mr-4">
                <i className="fas fa-tint text-blue-600 text-xl"></i>
              </div>
              <div className="flex-1">
                <div className="text-sm font-medium text-gray-600 mb-1">
                  Nombre de fuites
                </div>
                <div
                  className={`text-2xl font-bold ${
                    data.NbFuites === 0 ? "text-gray-400" : "text-gray-800"
                  }`}
                >
                  {data.NbFuites}
                </div>
              </div>
            </div>
          </Link>

          {/* Consumption Anomalies Alert */}
          <Link
            href="/immeubles?anomalies=1"
            className="block hover:bg-gray-50 p-4 rounded-lg transition-colors duration-200"
          >
            <div className="flex items-center">
              <div className="w-12 h-12 bg-red-100 rounded-full flex items-center justify-center mr-4">
                <i className="fas fa-exclamation-triangle text-red-600 text-xl"></i>
              </div>
              <div className="flex-1">
                <div className="text-sm font-medium text-gray-600 mb-1">
                  Nombre d'anomalies de consommation
                </div>
                <div
                  className={`text-2xl font-bold ${
                    data.NbAnomalies === 0 ? "text-gray-400" : "text-gray-800"
                  }`}
                >
                  {data.NbAnomalies}
                </div>
              </div>
            </div>
          </Link>
        </div>

        {/* Demo buttons */}
        {data.isDemo && (
          <div className="mt-6 grid grid-cols-1 lg:grid-cols-2 gap-4">
            <button className="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg text-sm transition-colors duration-200">
              Synthèse patrimoine
            </button>
            <a
              href="/xlsx/export-anomalies-global.xlsx"
              className="bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg text-sm transition-colors duration-200 text-center block"
            >
              Synthèse patrimoine
            </a>
          </div>
        )}
      </div>
    </div>
  );
};

export default ClientAlerts;
