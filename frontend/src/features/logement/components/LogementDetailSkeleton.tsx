"use client";

import React from "react";

const LogementDetailSkeleton: React.FC = () => {
  return (
    <div className="space-y-6">
      {/* Breadcrumb skeleton */}
      <div className="flex items-center space-x-2 mb-6">
        <div className="h-4 bg-gray-200 rounded w-16 animate-pulse"></div>
        <div className="h-4 bg-gray-200 rounded w-4 animate-pulse"></div>
        <div className="h-4 bg-gray-200 rounded w-24 animate-pulse"></div>
        <div className="h-4 bg-gray-200 rounded w-4 animate-pulse"></div>
        <div className="h-4 bg-gray-200 rounded w-32 animate-pulse"></div>
        <div className="h-4 bg-gray-200 rounded w-4 animate-pulse"></div>
        <div className="h-4 bg-gray-200 rounded w-40 animate-pulse"></div>
      </div>

      {/* Header skeleton */}
      <div className="h-8 bg-gray-200 rounded w-64 mb-8 animate-pulse"></div>

      {/* Main content skeleton */}
      <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
        {/* Main panel skeleton */}
        <div className="lg:col-span-2">
          <div className="bg-white rounded-lg shadow-md p-6 animate-pulse">
            {/* Logement info skeleton */}
            <div className="flex items-start space-x-4 mb-6">
              <div className="w-16 h-16 bg-gray-200 rounded-lg"></div>
              <div className="flex-1 space-y-3">
                <div className="h-6 bg-gray-200 rounded w-3/4"></div>
                <div className="h-4 bg-gray-200 rounded w-1/2"></div>
                <div className="h-4 bg-gray-200 rounded w-2/3"></div>
                <div className="h-4 bg-gray-200 rounded w-1/3"></div>
              </div>
            </div>

            {/* Occupant info skeleton */}
            <div className="flex items-start space-x-4 mb-6">
              <div className="w-16 h-16 bg-gray-200 rounded-lg"></div>
              <div className="flex-1 space-y-3">
                <div className="h-6 bg-gray-200 rounded w-3/4"></div>
                <div className="h-4 bg-gray-200 rounded w-1/2"></div>
                <div className="h-4 bg-gray-200 rounded w-2/3"></div>
              </div>
            </div>

            {/* Stats skeleton */}
            <div className="grid grid-cols-2 md:grid-cols-3 gap-4 mb-6">
              {Array.from({ length: 6 }, (_, index) => (
                <div key={index} className="text-center">
                  <div className="h-8 bg-gray-200 rounded w-12 mx-auto mb-2"></div>
                  <div className="h-4 bg-gray-200 rounded w-16 mx-auto"></div>
                </div>
              ))}
            </div>

            {/* Status info skeleton */}
            <div className="border-t pt-4">
              <div className="h-4 bg-gray-200 rounded w-1/2 mb-2"></div>
              <div className="h-4 bg-gray-200 rounded w-1/3"></div>
            </div>
          </div>
        </div>

        {/* Side panels skeleton */}
        <div className="space-y-6">
          {/* Tickets panel skeleton */}
          <div className="bg-white rounded-lg shadow-md p-6 animate-pulse">
            <div className="text-center">
              <div className="h-6 bg-gray-200 rounded w-24 mx-auto mb-4"></div>
              <div className="w-32 h-32 bg-gray-200 rounded-full mx-auto mb-4"></div>
              <div className="h-8 bg-gray-200 rounded w-12 mx-auto"></div>
            </div>
          </div>

          {/* Alerts panel skeleton */}
          <div className="bg-white rounded-lg shadow-md p-6 animate-pulse">
            <div className="text-center">
              <div className="h-6 bg-gray-200 rounded w-32 mx-auto mb-4"></div>
              <div className="w-32 h-32 bg-gray-200 rounded-full mx-auto mb-4"></div>
              <div className="h-8 bg-gray-200 rounded w-12 mx-auto"></div>
            </div>
          </div>
        </div>
      </div>

      {/* Tabs skeleton */}
      <div className="bg-white rounded-lg shadow-md">
        {/* Tab navigation skeleton */}
        <div className="border-b border-gray-200">
          <div className="flex space-x-1 p-4">
            {Array.from({ length: 7 }, (_, index) => (
              <div
                key={index}
                className="h-12 bg-gray-200 rounded w-24 animate-pulse"
              ></div>
            ))}
          </div>
        </div>

        {/* Tab content skeleton */}
        <div className="p-6">
          <div className="space-y-4">
            <div className="h-6 bg-gray-200 rounded w-1/3 animate-pulse"></div>
            <div className="h-32 bg-gray-200 rounded animate-pulse"></div>
            <div className="grid grid-cols-2 gap-4">
              <div className="h-20 bg-gray-200 rounded animate-pulse"></div>
              <div className="h-20 bg-gray-200 rounded animate-pulse"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default LogementDetailSkeleton;
