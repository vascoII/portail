"use client";

import React from "react";
import { RadialBarChart, RadialBar, ResponsiveContainer } from "recharts";
import { motion } from "framer-motion";

interface PerformanceGaugeProps {
  value: number;
  max?: number;
  size?: number;
  strokeWidth?: number;
  needleColor?: string;
  gaugeColor?: string;
  backgroundColor?: string;
  showValue?: boolean;
  showPercentage?: boolean;
  className?: string;
}

const PerformanceGauge: React.FC<PerformanceGaugeProps> = ({
  value,
  max = 100,
  size = 120,
  strokeWidth = 8,
  needleColor = "#ff6633",
  gaugeColor = "#3b82f6",
  backgroundColor = "#e5e7eb",
  showValue = true,
  showPercentage = false,
  className = "",
}) => {
  // Calculate percentage and needle angle
  const percentage = Math.min(Math.max((value / max) * 100, 0), 100);
  const needleAngle = (percentage / 100) * 180 - 90; // -90 to 90 degrees

  // Prepare data for RadialBarChart
  const data = [
    {
      value: percentage,
      fill: gaugeColor,
    },
  ];

  return (
    <div
      className={`performance-gauge ${className}`}
      style={{ width: size, height: size }}
    >
      <ResponsiveContainer width="100%" height="100%">
        <RadialBarChart
          cx="50%"
          cy="50%"
          innerRadius={size / 2 - strokeWidth}
          outerRadius={size / 2}
          barSize={strokeWidth}
          data={data}
          startAngle={90}
          endAngle={-270}
        >
          {/* Background circle */}
          <RadialBar
            dataKey={100}
            fill={backgroundColor}
            startAngle={90}
            endAngle={-270}
            style={{ opacity: 0.3 }}
          />
          {/* Value circle */}
          <RadialBar
            dataKey="value"
            fill={gaugeColor}
            startAngle={90}
            endAngle={-270}
            cornerRadius={strokeWidth / 2}
          />
        </RadialBarChart>
      </ResponsiveContainer>

      {/* Needle */}
      <div className="absolute inset-0 flex items-center justify-center">
        <div
          className="needle"
          style={{
            width: "2px",
            height: `${size / 2 - strokeWidth - 10}px`,
            backgroundColor: needleColor,
            transformOrigin: "bottom center",
            transform: `rotate(${needleAngle}deg)`,
            position: "absolute",
            bottom: "50%",
            borderRadius: "1px",
            transition: "transform 0.5s ease-in-out",
          }}
        />
        {/* Needle center dot */}
        <div
          className="needle-center"
          style={{
            width: "8px",
            height: "8px",
            backgroundColor: needleColor,
            borderRadius: "50%",
            position: "absolute",
            bottom: "50%",
            transform: "translateY(50%)",
          }}
        />
      </div>

      {/* Value display */}
      {showValue && (
        <div className="absolute inset-0 flex items-center justify-center">
          <div className="text-center">
            <div className="text-lg font-bold text-gray-800">
              {showPercentage ? `${Math.round(percentage)}%` : value}
            </div>
          </div>
        </div>
      )}
    </div>
  );
};

export default PerformanceGauge;
