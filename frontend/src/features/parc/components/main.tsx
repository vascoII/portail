"use client";

import React from "react";
import Link from "next/link";
import PerformanceGauge from "@/src/shared/components/UI/PerformanceGauge";
import type { GetParcResponseDto } from "@/src/features/parc/types/response/GetParcResponseDto";

interface MainProps {
  data: GetParcResponseDto;
  showChgtOccupant?: boolean;
}

const Main: React.FC<MainProps> = ({ data, showChgtOccupant = false }) => {
  return (
    <div
      className="row border-2 border-black rounded-lg p-4"
      style={{
        borderColor: "#606060",
        borderStyle: "solid",
        borderWidth: "1px",
        borderRadius: "10px",
        padding: "0%",
        margin: "0%",
      }}
    >
      {/* Left Panel - Buildings and Devices */}
      <div className="col-span-7 lg:col-span-7 md:col-span-12 panel panel-primary panel-left panel-info">
        {/* Immeubles Button */}
        <Link
          href="/immeubles"
          className="button button-parc col-span-12 block w-full bg-gray-200 hover:bg-gray-300 text-gray-900 font-bold py-4 px-6 rounded-lg transition-colors duration-200 flex items-center justify-between mb-4"
          style={{
            borderColor: "#606060",
            borderStyle: "solid",
            borderWidth: "1px",
            borderRadius: "10px",
            textAlign: "center",
            justifyContent: "center",
            alignItems: "center",
            display: "flex",
            flexDirection: "column",
            flexWrap: "wrap",
            flexGrow: 1,
            flexShrink: 1,
            flexBasis: "100%",
            backgroundColor: "#606060",
            color: "#fff",
            fontSize: "1.5rem",
            fontWeight: "bold",
            textDecoration: "none",
            textTransform: "uppercase",
            letterSpacing: "0.1em",
          }}
        >
          <div>
            <strong className="text-2xl">{data.nbImmeubles}</strong>{" "}
            <span className="text-lg">Immeubles</span>
          </div>
          <i className="fas fa-building text-2xl"></i>
        </Link>

        {/* Gestion parc Button */}
        {showChgtOccupant && false && (
          <Link
            href="/gestion-parc"
            className="button gestion-parc col-span-12 block w-full bg-gray-200 hover:bg-gray-300 text-gray-900 py-3 px-6 rounded-lg mb-6 transition-colors duration-200 flex items-center"
          >
            <i className="fas fa-clipboard-list mr-3"></i>
            <span className="title">Gestion parc</span>
          </Link>
        )}

        {/* Appareils Section */}
        <div className="app mt-6 mb-4">
          <div className="inner text-center">
            <strong className="text-2xl font-bold">{data.nbCompteurs}</strong>{" "}
            <span className="text-lg">Appareils</span>
          </div>
        </div>

        {/* Device Statistics */}
        <div className="stats clearfix grid grid-cols-2 gap-4 mt-4">
          {/* Eau froide */}
          {data.nbCompteursEf !== -1 && (
            <div className="item text-center">
              <div className="value text-xl font-bold">
                {data.nbCompteursEf}
              </div>
              <div className="title text-sm text-gray-600">Eau froide</div>
            </div>
          )}

          {/* Eau chaude */}
          {data.nbCompteursEc !== -1 && (
            <div className="item text-center">
              <div className="value text-xl font-bold">
                {data.nbCompteursEc}
              </div>
              <div className="title text-sm text-gray-600">Eau chaude</div>
            </div>
          )}

          {/* Répartiteurs */}
          {data.nbCompteursRepart !== -1 && (
            <div className="item text-center">
              <div className="value text-xl font-bold">
                {data.nbCompteursRepart}
              </div>
              <div className="title text-sm text-gray-600">Répartiteurs</div>
            </div>
          )}

          {/* Compteur d'énergie */}
          {data.nbCompteursCet !== -1 && (
            <div className="item text-center">
              <div className="value text-xl font-bold">
                {data.nbCompteursCet}
              </div>
              <div className="title text-sm text-gray-600">
                Compteur d&apos;énergie
              </div>
            </div>
          )}
        </div>
      </div>

      {/* Right Panel - File Transfer Gauge */}
      <div className="col-span-5 lg:col-span-5 md:col-span-12 panel panel-primary panel-right performance-gauge"></div>
    </div>
  );
};

export default Main;
