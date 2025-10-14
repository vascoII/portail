"use client";

import React from "react";
import Link from "next/link";

interface ConstructionPanelProps {
  data: {
    NbChantiers: number;
    NbCompteursCommandes: number;
    NbCompteursPoses: number;
    DateEntreeChantier?: string;
  };
}

const ConstructionPanel: React.FC<ConstructionPanelProps> = ({ data }) => {
  const remainingCount = data.NbCompteursCommandes - data.NbCompteursPoses;
  const installedPercent =
    data.NbCompteursCommandes > 0
      ? (data.NbCompteursPoses * 200) / data.NbCompteursCommandes
      : 0;
  const remainingPercent =
    data.NbCompteursCommandes > 0
      ? (remainingCount * 200) / data.NbCompteursCommandes
      : 0;

  if (data.NbChantiers <= 0) {
    return (
      <div className="col-span-12">
        <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
          <div className="bg-blue-600 text-white p-6 rounded-lg">
            <div className="text-lg font-bold uppercase text-center">
              Aucun chantier en cours
            </div>
            <div className="mt-8 text-center">
              <i className="fas fa-tachometer-alt text-4xl mb-4"></i>
              <div className="text-lg">Aucune commande en cours</div>
            </div>
          </div>

          <div className="bg-blue-600 text-white p-6 rounded-lg">
            <div className="text-lg font-semibold mb-4">Vos relevés</div>
            {/* This would be replaced with actual gauge component */}
            <div className="text-center">
              <div className="text-2xl font-bold">
                0<sup>%</sup>
              </div>
              <div className="text-sm">des appareils relevés</div>
            </div>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="col-span-12">
      <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {/* Construction Status */}
        <div className="bg-blue-600 text-white p-6 rounded-lg">
          <Link
            href="/pages/immeubles?chantiers=1"
            className="block text-white hover:text-blue-200 transition-colors duration-200"
          >
            <div className="text-lg font-bold uppercase mb-6">
              Chantiers en cours <i className="fas fa-chevron-right ml-2"></i>
            </div>
          </Link>

          <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div className="text-center">
              <div className="flex items-center justify-center mb-2">
                <i className="fas fa-calculator mr-2"></i>
                <span className="text-2xl font-bold">
                  {data.NbCompteursCommandes}
                </span>
              </div>
              <div className="text-sm">Appareils commandés</div>
            </div>

            <div className="space-y-4">
              {/* Remaining devices chart */}
              <div className="bg-blue-500 p-4 rounded-lg">
                <div
                  className="bg-blue-800 text-white text-center py-2 rounded"
                  style={{ height: `${remainingPercent}px`, minHeight: "20px" }}
                >
                  {remainingCount}
                </div>
                <div className="text-xs text-center mt-2">
                  Appareils à poser
                </div>
              </div>

              {/* Installed devices chart */}
              <div className="bg-blue-500 p-4 rounded-lg">
                <div
                  className="bg-white text-blue-600 text-center py-2 rounded"
                  style={{ height: `${installedPercent}px`, minHeight: "20px" }}
                >
                  {data.NbCompteursPoses}
                </div>
                <div className="text-xs text-center mt-2">Appareils posés</div>
              </div>
            </div>
          </div>
        </div>

        {/* Readings Gauge */}
        <div className="bg-blue-600 text-white p-6 rounded-lg">
          <div className="text-lg font-semibold mb-4">Vos relevés</div>

          <div className="flex justify-center mb-4">
            <div className="relative w-48 h-32">
              {/* Gauge visualization would go here */}
              <div className="w-full h-2 bg-blue-800 rounded-full">
                <div
                  className="h-2 bg-white rounded-full transition-all duration-500"
                  style={{ width: "75%" }}
                ></div>
              </div>
            </div>
          </div>

          <div className="text-center">
            <div className="text-2xl font-bold">
              75<sup>%</sup>
            </div>
            <div className="text-sm">des appareils relevés</div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default ConstructionPanel;
