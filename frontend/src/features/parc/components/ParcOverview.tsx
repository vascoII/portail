"use client";

import React from "react";
import Link from "next/link";
import PerformanceGauge from "@/src/shared/components/UI/PerformanceGauge";

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
    <div className="row">
      {/* Left Panel - Buildings and Devices - Bootstrap col-md-7 */}
      <div className="col-span-7 lg:col-span-7 md:col-span-12 panel panel-primary panel-left panel-info">
        <Link
          href="/immeubles"
          className="button button-parc col-span-12 block w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-4 px-6 rounded-lg transition-colors duration-200 flex items-center justify-between"
        >
          <div>
            <strong>{data.NbImmeubles}</strong> Immeubles
          </div>
          <i className="icon icon-immeuble text-2xl"></i>
        </Link>

        {data.showChgtOccupant && (
          <Link
            href="/gestion-parc"
            className="button gestion-parc col-span-12 block w-full bg-blue-500 hover:bg-blue-600 text-white py-3 px-6 rounded-lg mt-4 transition-colors duration-200 flex items-center"
          >
            <i className="icon icon-clipboard mr-3"></i>
            <span className="title">Gestion parc</span>
          </Link>
        )}

        <div className="app mt-6">
          <div className="inner text-center">
            <strong>{data.NbCompteurs}</strong> Appareils
          </div>
        </div>

        {/* Device Statistics */}
        <div className="stats clearfix grid grid-cols-2 gap-4 mt-4">
          {data.NbCompteursEF !== -1 && (
            <div className="item text-center">
              <div className="value text-xl font-bold">
                {data.NbCompteursEF}
              </div>
              <div className="title text-sm">Eau froide</div>
            </div>
          )}
          {data.NbCompteursEC !== -1 && (
            <div className="item text-center">
              <div className="value text-xl font-bold">
                {data.NbCompteursEC}
              </div>
              <div className="title text-sm">Eau chaude</div>
            </div>
          )}
          {data.NbCompteursRepart !== -1 && (
            <div className="item text-center">
              <div className="value text-xl font-bold">
                {data.NbCompteursRepart}
              </div>
              <div className="title text-sm">Répartiteurs</div>
            </div>
          )}
          {data.NbCompteursCET !== -1 && (
            <div className="item text-center">
              <div className="value text-xl font-bold">
                {data.NbCompteursCET}
              </div>
              <div className="title text-sm">Compteur d'énergie</div>
            </div>
          )}
          {data.NbCompteursElect !== -1 && (
            <div className="item text-center">
              <div className="value text-xl font-bold">
                {data.NbCompteursElect}
              </div>
              <div className="title text-sm">Electricité</div>
            </div>
          )}
          {data.NbCompteursGaz !== -1 && (
            <div className="item text-center">
              <div className="value text-xl font-bold">
                {data.NbCompteursGaz}
              </div>
              <div className="title text-sm">Gaz</div>
            </div>
          )}
        </div>
      </div>

      {/* Right Panel - File Transfer Gauge - Bootstrap col-md-5 */}
      <div className="col-span-5 lg:col-span-5 md:col-span-12 panel panel-primary panel-right performance-gauge">
        <div className="block-title text-lg font-semibold mb-4">
          Transfert électronique de fichiers
        </div>

        <div className="canvas flex justify-center mb-4">
          <PerformanceGauge
            value={data.PcImmeublesTransfertFichiers}
            max={100}
            size={120}
            strokeWidth={8}
            needleColor="#383d43"
            gaugeColor="#383d43"
            backgroundColor="rgba(56, 61, 67, 0.3)"
            showValue={true}
            showPercentage={true}
          />
        </div>

        <div className="text text-center">
          <strong>{data.PcImmeublesTransfertFichiers}</strong>
          <sup>%</sup> des immeubles
        </div>
      </div>
    </div>
  );
};

export default ParcOverview;
