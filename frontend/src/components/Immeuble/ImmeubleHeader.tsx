"use client";

import React from "react";
import Link from "next/link";
import { Immeuble, ImmeubleIndicators } from "@/hooks/useImmeuble";
import ImmeubleCard from "./ImmeubleCard";
import IndicatorsCard from "./IndicatorsCard";

interface ImmeubleHeaderProps {
  immeuble: Immeuble | null;
  immeubleLoading: boolean;
  immeubleError: string | null;
  indicators: ImmeubleIndicators | null;
  indicatorsLoading: boolean;
  indicatorsError: string | null;
}

const ImmeubleHeader: React.FC<ImmeubleHeaderProps> = ({
  immeuble,
  immeubleLoading,
  immeubleError,
  indicators,
  indicatorsLoading,
  indicatorsError,
}) => {
  return (
    <div className="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
      {/* Left Column - Building Info */}
      <div className="bg-white rounded-lg shadow-md">
        {immeubleLoading ? (
          <div className="p-6">
            <div className="animate-pulse">
              <div className="flex items-start space-x-4">
                <div className="w-12 h-12 bg-gray-200 rounded-lg"></div>
                <div className="flex-1 space-y-2">
                  <div className="h-4 bg-gray-200 rounded w-3/4"></div>
                  <div className="h-4 bg-gray-200 rounded w-1/2"></div>
                  <div className="h-3 bg-gray-200 rounded w-2/3"></div>
                </div>
              </div>
            </div>
          </div>
        ) : immeubleError ? (
          <div className="p-6">
            <div className="text-center">
              <i className="fas fa-exclamation-triangle text-red-500 text-2xl mb-2"></i>
              <p className="text-red-600 font-medium">
                Erreur lors du chargement
              </p>
              <p className="text-red-500 text-sm">{immeubleError}</p>
            </div>
          </div>
        ) : immeuble ? (
          <div className="p-6">
            <div className="flex items-start justify-between mb-4">
              <div className="flex items-start space-x-4 flex-1">
                <div className="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                  <i className="fas fa-building text-blue-600 text-xl"></i>
                </div>

                <div className="flex-1">
                  <Link
                    href={`/immeubles/${immeuble.pkImmeuble}/logements`}
                    className="text-2xl font-bold text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200"
                  >
                    {immeuble.nom}
                  </Link>
                  <div className="grid grid-cols-2 gap-2 text-sm">
                    <div>
                      <span className="font-medium text-gray-600">
                        Référence :
                      </span>
                      <div className="font-semibold text-gray-800">
                        {immeuble.ref}
                      </div>
                    </div>
                    <div>
                      <span className="font-medium text-gray-600">
                        N° d&apos;immeuble :
                      </span>
                      <div className="font-semibold text-gray-800">
                        {immeuble.numero}
                      </div>
                    </div>
                  </div>

                  <div className="mt-2 text-sm text-gray-600">
                    <div>
                      {immeuble.adresse1} {immeuble.adresse2}{" "}
                      {immeuble.adresse3}
                    </div>
                    <div>
                      {immeuble.cp} {immeuble.ville}
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        ) : null}
      </div>

      {/* Right Column - Indicators */}
      <IndicatorsCard
        buildingId={immeuble?.pkImmeuble || 0}
        indicators={indicators}
        loading={indicatorsLoading}
        error={indicatorsError}
      />
    </div>
  );
};

export default ImmeubleHeader;
