"use client";

import React from "react";
import Link from "next/link";

interface ParcOverviewProps {
  data: {
    NbImmeubles: number;
    NbCompteurs: number;
    NbCompteursEF: number;
    NbCompteursEC: number;
    NbCompteursRepart: number;
    NbCompteursCET: number;
    NbCompteursElect: number;
    NbCompteursGaz: number;
    PcImmeublesTransfertFichiers: number;
    showChgtOccupant?: boolean;
  };
}

const ParcOverview: React.FC<ParcOverviewProps> = ({ data }) => {
  return (
    <div className="col-span-8 lg:col-span-8 md:col-span-6">
      <div className="grid grid-cols-1 lg:grid-cols-12 gap-4">
        {/* Left Panel - Buildings and Devices */}
        <div className="lg:col-span-7">
          <div className="bg-blue-600 text-white p-6 rounded-lg">
            <Link
              href="/immeubles"
              className="block w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-4 px-6 rounded-lg transition-colors duration-200 flex items-center justify-between"
            >
              <div>
                <div className="text-2xl font-bold">{data.NbImmeubles}</div>
                <div className="text-lg">Immeubles</div>
              </div>
              <i className="fas fa-building text-2xl"></i>
            </Link>

            {data.showChgtOccupant && (
              <Link
                href="/gestion-parc"
                className="block w-full bg-blue-500 hover:bg-blue-600 text-white py-3 px-6 rounded-lg mt-4 transition-colors duration-200 flex items-center"
              >
                <i className="fas fa-clipboard mr-3"></i>
                <span>Gestion parc</span>
              </Link>
            )}

            <div className="mt-6 bg-blue-500 p-4 rounded-lg">
              <div className="text-center">
                <div className="text-2xl font-bold">{data.NbCompteurs}</div>
                <div className="text-lg">Appareils</div>
              </div>
            </div>

            {/* Device Statistics */}
            <div className="grid grid-cols-2 gap-4 mt-4">
              {data.NbCompteursEF !== -1 && (
                <div className="text-center">
                  <div className="text-xl font-bold">{data.NbCompteursEF}</div>
                  <div className="text-sm">Eau froide</div>
                </div>
              )}
              {data.NbCompteursEC !== -1 && (
                <div className="text-center">
                  <div className="text-xl font-bold">{data.NbCompteursEC}</div>
                  <div className="text-sm">Eau chaude</div>
                </div>
              )}
              {data.NbCompteursRepart !== -1 && (
                <div className="text-center">
                  <div className="text-xl font-bold">
                    {data.NbCompteursRepart}
                  </div>
                  <div className="text-sm">Répartiteurs</div>
                </div>
              )}
              {data.NbCompteursCET !== -1 && (
                <div className="text-center">
                  <div className="text-xl font-bold">{data.NbCompteursCET}</div>
                  <div className="text-sm">Compteur d'énergie</div>
                </div>
              )}
              {data.NbCompteursElect !== -1 && (
                <div className="text-center">
                  <div className="text-xl font-bold">
                    {data.NbCompteursElect}
                  </div>
                  <div className="text-sm">Electricité</div>
                </div>
              )}
              {data.NbCompteursGaz !== -1 && (
                <div className="text-center">
                  <div className="text-xl font-bold">{data.NbCompteursGaz}</div>
                  <div className="text-sm">Gaz</div>
                </div>
              )}
            </div>
          </div>
        </div>

        {/* Right Panel - File Transfer Gauge */}
        <div className="lg:col-span-5">
          <div className="bg-blue-600 text-white p-6 rounded-lg h-full">
            <div className="text-lg font-semibold mb-4">
              Transfert électronique de fichiers
            </div>

            <div className="flex justify-center mb-4">
              <div className="relative w-48 h-32">
                {/* Gauge visualization would go here - using a simple progress bar for now */}
                <div className="w-full h-2 bg-blue-800 rounded-full">
                  <div
                    className="h-2 bg-white rounded-full transition-all duration-500"
                    style={{ width: `${data.PcImmeublesTransfertFichiers}%` }}
                  ></div>
                </div>
              </div>
            </div>

            <div className="text-center">
              <div className="text-2xl font-bold">
                {data.PcImmeublesTransfertFichiers}
                <sup>%</sup>
              </div>
              <div className="text-sm">des immeubles</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ParcOverview;
