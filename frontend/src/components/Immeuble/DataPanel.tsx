"use client";

import React from "react";
import DataPanelSkeleton from "./DataPanelSkeleton";

interface DataPanelProps {
  title: string;
  icon?: string;
  data: any;
  loading: boolean;
  error: string | null;
  onRefresh?: () => void;
  children?: React.ReactNode;
  showChart?: boolean;
  showStats?: boolean;
  showList?: boolean;
  listCount?: number;
}

const DataPanel: React.FC<DataPanelProps> = ({
  title,
  icon,
  data,
  loading,
  error,
  onRefresh,
  children,
  showChart = false,
  showStats = false,
  showList = false,
  listCount = 3,
}) => {
  if (loading) {
    return (
      <DataPanelSkeleton
        title={title}
        icon={icon}
        showChart={showChart}
        showStats={showStats}
        showList={showList}
        listCount={listCount}
      />
    );
  }

  if (error) {
    return (
      <div className="bg-red-50 border border-red-200 rounded-lg p-6">
        <div className="flex items-center justify-between">
          <div>
            <h3 className="text-lg font-medium text-red-800 mb-2">
              Erreur lors du chargement de {title}
            </h3>
            <p className="text-red-600 text-sm">{error}</p>
          </div>
          {onRefresh && (
            <button
              onClick={onRefresh}
              className="px-4 py-2 bg-red-100 text-red-700 rounded-md hover:bg-red-200 transition-colors"
            >
              Réessayer
            </button>
          )}
        </div>
      </div>
    );
  }

  if (!data) {
    return (
      <div className="bg-gray-50 border border-gray-200 rounded-lg p-6 text-center">
        <div className="text-gray-400 mb-2">
          {icon && <i className={`${icon} text-3xl`}></i>}
        </div>
        <h3 className="text-lg font-medium text-gray-600 mb-2">
          Aucune donnée disponible
        </h3>
        <p className="text-gray-500 text-sm">
          Les données de {title} seront chargées une fois disponibles
        </p>
      </div>
    );
  }

  return (
    <div className="bg-white rounded-lg shadow-md p-6">
      {/* Header */}
      <div className="flex items-center justify-between mb-4">
        <div className="flex items-center space-x-2">
          {icon && <i className={`${icon} text-blue-600`}></i>}
          <h3 className="text-lg font-semibold text-gray-800">{title}</h3>
        </div>
        {onRefresh && (
          <button
            onClick={onRefresh}
            className="p-2 text-gray-400 hover:text-gray-600 transition-colors"
            title={`Actualiser ${title}`}
          >
            <i className="fas fa-sync-alt"></i>
          </button>
        )}
      </div>

      {/* Content */}
      <div className="space-y-4">
        {children || (
          <div className="space-y-3">
            {Object.entries(data)
              .slice(0, 6) // Show first 6 properties
              .map(([key, value]) => (
                <div key={key} className="flex justify-between items-center">
                  <span className="text-sm text-gray-600 capitalize">
                    {key.replace(/([A-Z])/g, " $1").trim()}:
                  </span>
                  <span className="text-sm font-medium text-gray-800">
                    {typeof value === "object"
                      ? JSON.stringify(value).substring(0, 30) + "..."
                      : String(value)}
                  </span>
                </div>
              ))}
          </div>
        )}
      </div>

      {/* Footer */}
      <div className="mt-4 pt-4 border-t border-gray-100">
        <button className="text-sm text-blue-600 hover:text-blue-800 transition-colors">
          Voir les détails
        </button>
      </div>
    </div>
  );
};

export default DataPanel;
