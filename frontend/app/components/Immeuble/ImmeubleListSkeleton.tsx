"use client";

import React from "react";

interface ImmeubleListSkeletonProps {
  viewMode?: "list" | "grid-big" | "grid-small";
  count?: number;
}

const ImmeubleListSkeleton: React.FC<ImmeubleListSkeletonProps> = ({
  viewMode = "list",
  count = 6,
}) => {
  const skeletonItems = Array.from({ length: count }, (_, index) => (
    <div
      key={index}
      className={`bg-white rounded-lg shadow-md p-6 animate-pulse ${
        viewMode === "list"
          ? "w-full"
          : viewMode === "grid-big"
          ? "w-full"
          : "w-full"
      }`}
    >
      {/* Header skeleton */}
      <div className="flex items-center justify-between mb-4">
        <div className="h-6 bg-gray-200 rounded w-1/3"></div>
        <div className="h-4 bg-gray-200 rounded w-16"></div>
      </div>

      {/* Address skeleton */}
      <div className="space-y-2 mb-4">
        <div className="h-4 bg-gray-200 rounded w-2/3"></div>
        <div className="h-4 bg-gray-200 rounded w-1/2"></div>
      </div>

      {/* Stats skeleton */}
      <div className="grid grid-cols-2 gap-4 mb-4">
        <div className="space-y-2">
          <div className="h-3 bg-gray-200 rounded w-16"></div>
          <div className="h-5 bg-gray-200 rounded w-8"></div>
        </div>
        <div className="space-y-2">
          <div className="h-3 bg-gray-200 rounded w-16"></div>
          <div className="h-5 bg-gray-200 rounded w-8"></div>
        </div>
        <div className="space-y-2">
          <div className="h-3 bg-gray-200 rounded w-16"></div>
          <div className="h-5 bg-gray-200 rounded w-8"></div>
        </div>
        <div className="space-y-2">
          <div className="h-3 bg-gray-200 rounded w-16"></div>
          <div className="h-5 bg-gray-200 rounded w-8"></div>
        </div>
      </div>

      {/* Energy types skeleton */}
      <div className="flex flex-wrap gap-2 mb-4">
        <div className="h-6 bg-gray-200 rounded-full w-16"></div>
        <div className="h-6 bg-gray-200 rounded-full w-16"></div>
        <div className="h-6 bg-gray-200 rounded-full w-16"></div>
      </div>

      {/* Alerts skeleton */}
      <div className="flex flex-wrap gap-2">
        <div className="h-6 bg-gray-200 rounded-full w-20"></div>
        <div className="h-6 bg-gray-200 rounded-full w-20"></div>
        <div className="h-6 bg-gray-200 rounded-full w-20"></div>
      </div>
    </div>
  ));

  return (
    <div className="space-y-6">
      {/* Header skeleton */}
      <div className="flex flex-col sm:flex-row sm:items-center sm:justify-between">
        <div className="h-8 bg-gray-200 rounded w-48 mb-4 sm:mb-0"></div>

        {/* View mode toggle skeleton */}
        <div className="flex items-center space-x-2">
          <div className="h-4 bg-gray-200 rounded w-20"></div>
          <div className="flex bg-gray-100 rounded-lg p-1">
            <div className="h-8 w-8 bg-gray-200 rounded"></div>
            <div className="h-8 w-8 bg-gray-200 rounded ml-1"></div>
            <div className="h-8 w-8 bg-gray-200 rounded ml-1"></div>
          </div>
        </div>
      </div>

      {/* Grid/List skeleton */}
      <div
        className={`${
          viewMode === "list"
            ? "space-y-4"
            : viewMode === "grid-big"
            ? "grid grid-cols-1 lg:grid-cols-2 gap-6"
            : "grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4"
        }`}
      >
        {skeletonItems}
      </div>
    </div>
  );
};

export default ImmeubleListSkeleton;
