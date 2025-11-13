"use client";

import React from "react";
import Link from "next/link";
import PerformanceGauge from "@/src/shared/components/UI/PerformanceGauge";

interface ConstructionPanelProps {
  data: {
    NbChantiers: number;
    NbCompteursCommandes: number;
    NbCompteursPoses: number;
    DateEntreeChantier?: string;
  };
  constructionStats?: {
    installed: number;
    installed_percent: number;
    remaining: number;
    remaining_percent: number;
    total: number;
  };
}

const ConstructionPanel: React.FC<ConstructionPanelProps> = ({
  data,
  constructionStats,
}) => {
  // Use constructionStats if available, otherwise calculate from data
  const stats = constructionStats || {
    installed: data.NbCompteursPoses,
    installed_percent:
      data.NbCompteursCommandes > 0
        ? Math.round((100 * data.NbCompteursPoses) / data.NbCompteursCommandes)
        : 0,
    remaining: data.NbCompteursCommandes - data.NbCompteursPoses,
    remaining_percent:
      data.NbCompteursCommandes > 0
        ? Math.round(
            (100 * (data.NbCompteursCommandes - data.NbCompteursPoses)) /
              data.NbCompteursCommandes
          )
        : 0,
    total: data.NbCompteursCommandes,
  };

  const remainingCount = stats.remaining;
  const installedPercent = (stats.installed_percent * 200) / 100;
  const remainingPercent = (stats.remaining_percent * 200) / 100;

  if (data.NbChantiers <= 0) {
    return (
      <div className="row">
        <div className="col-span-6 panel panel-primary panel-left">
          <div className="block-title text-lg font-bold uppercase text-center">
            Aucun chantier en cours
          </div>
          <br />
          <br />
          <br />
          <br />
          <br />
          <br />
          <br />
          <br />
          <br />
          <br />
          <br />
          <br />
        </div>

        <div className="col-span-6 panel panel-primary panel-right performance-gauge">
          <div className="block-title text-lg font-semibold mb-4">
            Vos relevés
          </div>
          <div className="text-center">
            <div className="text-2xl font-bold">
              0<sup>%</sup>
            </div>
            <div className="text-sm">des appareils relevés</div>
          </div>
        </div>
      </div>
    );
  }

  return (
    <div className="row">
      {/* Construction Status - Bootstrap col-sm-6 */}
      <div className="col-span-6 panel panel-primary panel-left">
        <Link
          href="/immeubles?chantiers=1"
          className="button block text-white hover:text-blue-200 transition-colors duration-200"
        >
          <div className="text-lg font-bold uppercase mb-6">
            Chantiers en cours <i className="fa fa-chevron-right ml-2"></i>
          </div>
        </Link>

        <div className="row">
          <div className="col-span-6 block-left">
            <div className="number text-2xl font-bold">
              <i className="icon-compteur mr-2"></i> {stats.total}
            </div>
            <div className="text text-sm">Appareils commandés</div>
            <br />
            <br />
            <br />
            {/* Date would go here if available */}
          </div>

          <div className="col-span-6 block-right">
            <div className="chart clearfix">
              <div
                className="number dark"
                style={{ height: `${remainingPercent}px` }}
              >
                {remainingCount}
              </div>
              <div className="text text-sm">Appareils à poser</div>
            </div>

            <div className="chart clearfix">
              <div
                className="number blue"
                style={{ height: `${installedPercent}px` }}
              >
                {stats.installed}
              </div>
              <div className="text text-sm">Appareils posés</div>
            </div>
          </div>
        </div>
      </div>

      {/* Readings Gauge - Bootstrap col-sm-6 */}
      <div className="col-span-6 panel panel-primary panel-right performance-gauge">
        <div className="block-title text-lg font-semibold mb-4">
          Vos relevés
        </div>

        <div className="canvas flex justify-center mb-4">
          <PerformanceGauge
            value={75} // This would come from real data
            max={100}
            size={120}
            strokeWidth={8}
            needleColor="#46b5fc"
            gaugeColor="#46b5fc"
            backgroundColor="rgba(70, 181, 252, 0.3)"
            showValue={true}
            showPercentage={true}
          />
        </div>

        <div className="text text-center">
          <strong>75</strong>
          <sup>%</sup> des appareils relevés
        </div>
      </div>
    </div>
  );
};

export default ConstructionPanel;
