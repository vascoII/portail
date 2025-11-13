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
    <div className="panel">
      <div className="block-title text-lg font-semibold text-gray-800 mb-6">
        Alertes client
      </div>

      <div className="row">
        {/* Leaks Alert - Bootstrap col-lg-6 */}
        <div className="col-span-6 lg:col-span-6 md:col-span-12">
          <Link
            href="/immeubles?fuites=1"
            className="fui block hover:bg-gray-50 p-4 rounded-lg transition-colors duration-200"
          >
            <div className="panel-default">
              <div className="icons blue">
                <span className="icon-water33 text-2xl"></span>
              </div>

              <div className="title text-sm font-medium text-gray-600 mb-1">
                Nombre de fuites
              </div>

              <div
                className={`value text-2xl font-bold ${
                  data.NbFuites === 0 ? "empty text-gray-400" : "text-gray-800"
                }`}
              >
                {data.NbFuites}
              </div>
            </div>
          </Link>

          {data.isDemo && (
            <a href="">
              <div className="btn-alarme-tech bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg text-sm transition-colors duration-200 text-center mt-2 demo-feature">
                <span className="demo-badge mr-2">DEMO</span>
                Synthèse patrimoine
              </div>
            </a>
          )}
        </div>

        {/* Consumption Anomalies Alert - Bootstrap col-lg-6 */}
        <div className="col-span-6 lg:col-span-6 md:col-span-12">
          <Link
            href="/immeubles?anomalies=1"
            className="ano block hover:bg-gray-50 p-4 rounded-lg transition-colors duration-200"
          >
            <div className="panel-default">
              <div className="icons red">
                <span className="icon-caution text-2xl"></span>
              </div>

              <div className="title text-sm font-medium text-gray-600 mb-1">
                Nombre d'anomalies de consommation
              </div>

              <div
                className={`value text-2xl font-bold ${
                  data.NbAnomalies === 0
                    ? "empty text-gray-400"
                    : "text-gray-800"
                }`}
              >
                {data.NbAnomalies}
              </div>
            </div>
          </Link>

          {data.isDemo && (
            <a href="/xlsx/export-anomalies-global.xlsx">
              <div className="btn-alarme-tech bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg text-sm transition-colors duration-200 text-center mt-2 demo-feature">
                <span className="demo-badge mr-2">DEMO</span>
                Synthèse patrimoine
              </div>
            </a>
          )}
        </div>
      </div>
    </div>
  );
};

export default ClientAlerts;
