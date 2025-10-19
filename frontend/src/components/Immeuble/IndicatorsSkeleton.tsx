"use client";

import React from "react";

interface IndicatorsSkeletonProps {
  count?: number;
}

const IndicatorsSkeleton: React.FC<IndicatorsSkeletonProps> = ({
  count = 3,
}) => {
  const skeletonItems = Array.from({ length: count }, (_, index) => (
    <div
      key={index}
      className="bg-white rounded-lg shadow-md p-6 animate-pulse"
    >
      {/* Header skeleton */}
      <div className="flex items-center justify-between mb-4">
        <div className="h-5 bg-gray-200 rounded w-32"></div>
        <div className="h-4 bg-gray-200 rounded w-12"></div>
      </div>

      {/* Chart/Graph skeleton */}
      <div className="h-32 bg-gray-200 rounded mb-4"></div>

      {/* Stats grid skeleton */}
      <div className="grid grid-cols-2 gap-4">
        <div className="space-y-2">
          <div className="h-3 bg-gray-200 rounded w-20"></div>
          <div className="h-6 bg-gray-200 rounded w-16"></div>
        </div>
        <div className="space-y-2">
          <div className="h-3 bg-gray-200 rounded w-20"></div>
          <div className="h-6 bg-gray-200 rounded w-16"></div>
        </div>
        <div className="space-y-2">
          <div className="h-3 bg-gray-200 rounded w-20"></div>
          <div className="h-6 bg-gray-200 rounded w-16"></div>
        </div>
        <div className="space-y-2">
          <div className="h-3 bg-gray-200 rounded w-20"></div>
          <div className="h-6 bg-gray-200 rounded w-16"></div>
        </div>
      </div>
    </div>
  ));

  return (
    <div className="space-y-6">
      {/* Section header skeleton */}
      <div className="flex items-center justify-between">
        <div className="h-6 bg-gray-200 rounded w-48"></div>
        <div className="h-4 bg-gray-200 rounded w-24"></div>
      </div>

      {/* Indicators grid skeleton */}
      <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        {skeletonItems}
      </div>
    </div>
  );
};

export default IndicatorsSkeleton;
