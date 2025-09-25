"use client";

import React from "react";
import Link from "next/link";

interface StatusGaugeProps {
  title: string;
  count: number;
  icon: string;
  color: string;
  href: string;
  className?: string;
}

const StatusGauge: React.FC<StatusGaugeProps> = ({
  title,
  count,
  icon,
  color,
  href,
  className = "",
}) => {
  const displayCount = count === -1 ? 0 : count;
  const isActive = count > 0;

  return (
    <div className={`bg-white rounded-lg shadow-md ${className}`}>
      <Link
        href={href}
        className="block p-6 hover:bg-gray-50 transition-colors duration-200"
      >
        <div className="text-center">
          <div className="text-sm font-medium text-gray-600 mb-4">{title}</div>

          <div className="relative w-32 h-24 mx-auto mb-4">
            {/* Gauge visualization */}
            <div
              className={`w-full h-2 rounded-full ${
                isActive ? color : "bg-gray-300"
              }`}
            >
              <div
                className={`h-2 rounded-full transition-all duration-500 ${
                  isActive ? color : "bg-gray-300"
                }`}
                style={{ width: isActive ? "100%" : "0%" }}
              ></div>
            </div>

            {/* Icon */}
            <div className="absolute inset-0 flex items-center justify-center">
              <i
                className={`${icon} text-2xl ${
                  isActive ? "text-orange-500" : "text-gray-400"
                }`}
              ></i>
            </div>
          </div>

          <div className="text-2xl font-bold text-gray-800">{displayCount}</div>
        </div>
      </Link>
    </div>
  );
};

export default StatusGauge;
