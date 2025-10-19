"use client";

import React from "react";
import { useDataStore } from "@/store/dataStore";

const CacheTest: React.FC = () => {
  const {
    loginData,
    immeublesCache,
    isImmeublesCacheValid,
    clearImmeublesCache,
  } = useDataStore();

  if (!loginData) {
    return (
      <div className="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
        <h3 className="text-lg font-medium text-yellow-800 mb-2">Cache Test</h3>
        <p className="text-yellow-600">
          Please log in to see cache information
        </p>
      </div>
    );
  }

  const now = new Date();
  const endOfDay = new Date(
    now.getFullYear(),
    now.getMonth(),
    now.getDate(),
    23,
    59,
    59,
    999
  );
  const timeUntilMidnight = endOfDay.getTime() - now.getTime();
  const hoursUntilMidnight = Math.floor(timeUntilMidnight / (1000 * 60 * 60));
  const minutesUntilMidnight = Math.floor(
    (timeUntilMidnight % (1000 * 60 * 60)) / (1000 * 60)
  );

  return (
    <div className="bg-blue-50 border border-blue-200 rounded-lg p-4">
      <h3 className="text-lg font-medium text-blue-800 mb-4">
        Cache Information
      </h3>

      <div className="space-y-3">
        <div>
          <strong>Login ID:</strong> {loginData.loginId}
        </div>

        <div>
          <strong>Cache Valid:</strong>
          <span
            className={`ml-2 px-2 py-1 rounded text-sm ${
              isImmeublesCacheValid()
                ? "bg-green-100 text-green-800"
                : "bg-red-100 text-red-800"
            }`}
          >
            {isImmeublesCacheValid() ? "Yes" : "No"}
          </span>
        </div>

        <div>
          <strong>Buildings Cached:</strong>
          <span
            className={`ml-2 px-2 py-1 rounded text-sm ${
              immeublesCache.buildings
                ? "bg-green-100 text-green-800"
                : "bg-gray-100 text-gray-800"
            }`}
          >
            {immeublesCache.buildings ? "Yes" : "No"}
          </span>
        </div>

        <div>
          <strong>Indicators Cached:</strong>
          <span
            className={`ml-2 px-2 py-1 rounded text-sm ${
              immeublesCache.indicators
                ? "bg-green-100 text-green-800"
                : "bg-gray-100 text-gray-800"
            }`}
          >
            {immeublesCache.indicators ? "Yes" : "No"}
          </span>
        </div>

        {immeublesCache.buildings && (
          <div>
            <strong>Buildings Cached At:</strong>
            <span className="ml-2 text-sm text-gray-600">
              {new Date(immeublesCache.buildings.cachedAt).toLocaleString()}
            </span>
          </div>
        )}

        {immeublesCache.indicators && (
          <div>
            <strong>Indicators Cached At:</strong>
            <span className="ml-2 text-sm text-gray-600">
              {new Date(immeublesCache.indicators.cachedAt).toLocaleString()}
            </span>
          </div>
        )}

        <div>
          <strong>Cache Expires At:</strong>
          <span className="ml-2 text-sm text-gray-600">
            {endOfDay.toLocaleString()}
            <span className="text-orange-600 ml-1">
              ({hoursUntilMidnight}h {minutesUntilMidnight}m remaining)
            </span>
          </span>
        </div>

        <div className="pt-2">
          <button
            onClick={clearImmeublesCache}
            className="px-3 py-1 bg-red-100 text-red-700 rounded hover:bg-red-200 transition-colors text-sm"
          >
            Clear Cache
          </button>
        </div>
      </div>
    </div>
  );
};

export default CacheTest;
