"use client";

import React from "react";

interface DataPanelSkeletonProps {
  title: string;
  icon?: string;
  showChart?: boolean;
  showStats?: boolean;
  showList?: boolean;
  listCount?: number;
}

const DataPanelSkeleton: React.FC<DataPanelSkeletonProps> = ({
  title,
  icon,
  showChart = false,
  showStats = false,
  showList = false,
  listCount = 3,
}) => {
  return (
    <div className="bg-white rounded-lg shadow-md p-6 animate-pulse">
      {/* Header */}
      <div className="flex items-center justify-between mb-4">
        <div className="flex items-center space-x-2">
          {icon && <div className="w-5 h-5 bg-gray-200 rounded"></div>}
          <div className="h-6 bg-gray-200 rounded w-32"></div>
        </div>
        <div className="h-4 bg-gray-200 rounded w-16"></div>
      </div>

      {/* Chart skeleton */}
      {showChart && <div className="h-48 bg-gray-200 rounded mb-4"></div>}

      {/* Stats skeleton */}
      {showStats && (
        <div className="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
          {Array.from({ length: 4 }, (_, index) => (
            <div key={index} className="text-center">
              <div className="h-6 bg-gray-200 rounded w-12 mx-auto mb-2"></div>
              <div className="h-3 bg-gray-200 rounded w-16 mx-auto"></div>
            </div>
          ))}
        </div>
      )}

      {/* List skeleton */}
      {showList && (
        <div className="space-y-3">
          {Array.from({ length: listCount }, (_, index) => (
            <div
              key={index}
              className="flex items-center justify-between p-3 bg-gray-50 rounded"
            >
              <div className="flex items-center space-x-3">
                <div className="w-8 h-8 bg-gray-200 rounded-full"></div>
                <div className="space-y-1">
                  <div className="h-4 bg-gray-200 rounded w-24"></div>
                  <div className="h-3 bg-gray-200 rounded w-16"></div>
                </div>
              </div>
              <div className="h-4 bg-gray-200 rounded w-12"></div>
            </div>
          ))}
        </div>
      )}

      {/* Generic content skeleton */}
      {!showChart && !showStats && !showList && (
        <div className="space-y-3">
          <div className="h-4 bg-gray-200 rounded w-full"></div>
          <div className="h-4 bg-gray-200 rounded w-3/4"></div>
          <div className="h-4 bg-gray-200 rounded w-1/2"></div>
        </div>
      )}

      {/* Footer skeleton */}
      <div className="mt-4 pt-4 border-t border-gray-100">
        <div className="h-4 bg-gray-200 rounded w-24"></div>
      </div>
    </div>
  );
};

export default DataPanelSkeleton;
