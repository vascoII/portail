"use client";

import React from "react";
import Link from "next/link";
import CircularGauge from "./CircularGauge";

interface StatusGaugeProps {
  title: string;
  count: number;
  icon: string;
  color: string;
  href: string;
  className?: string;
  gaugeType?: "circular" | "simple";
  maxValue?: number;
}

const StatusGauge: React.FC<StatusGaugeProps> = ({
  title,
  count,
  icon,
  color,
  href,
  className = "",
  gaugeType = "circular",
  maxValue = 100,
}) => {
  const displayCount = count === -1 ? 0 : count;
  const isActive = count > 0;

  // Determine gauge color based on status
  const gaugeColor = isActive ? "#ff6633" : "#8e98a2";
  const backgroundColor = "#e5e7eb";

  return (
    <div className={`status-gauge ${className}`}>
      <div className="panel-default">
        <Link
          href={href}
          className="block p-6 hover:bg-gray-50 transition-colors duration-200"
        >
          <div className="panel-body">
            {/* Title */}
            <div className="intitule">
              <span className="text-sm font-medium text-dashboard-textSecondary">
                {title}
              </span>
            </div>

            {/* Canvas area for gauge */}
            <div className="canvas">
              {gaugeType === "circular" ? (
                <div className="flex justify-center">
                  <CircularGauge
                    value={displayCount}
                    max={maxValue}
                    size={100}
                    strokeWidth={8}
                    color={gaugeColor}
                    backgroundColor={backgroundColor}
                    showValue={true}
                    showPercentage={false}
                  />
                </div>
              ) : (
                /* Simple progress bar fallback */
                <div className="relative w-32 h-24 mx-auto mb-4">
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
                        isActive ? "text-gauge-active" : "text-gauge-inactive"
                      }`}
                    ></i>
                  </div>
                </div>
              )}
            </div>

            {/* Count display */}
            <div className="taux">
              <div className="text-2xl font-bold text-dashboard-textPrimary">
                {displayCount}
              </div>
            </div>
          </div>
        </Link>
      </div>
    </div>
  );
};

export default StatusGauge;
