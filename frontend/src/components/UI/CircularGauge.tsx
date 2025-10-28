"use client";

import React from "react";
import { RadialBarChart, RadialBar, ResponsiveContainer } from "recharts";
import { motion } from "framer-motion";

interface CircularGaugeProps {
  value: number;
  max?: number;
  size?: number;
  strokeWidth?: number;
  color?: string;
  backgroundColor?: string;
  showValue?: boolean;
  showPercentage?: boolean;
  className?: string;
}

const CircularGauge: React.FC<CircularGaugeProps> = ({
  value,
  max = 100,
  size = 120,
  strokeWidth = 8,
  color = "#3b82f6",
  backgroundColor = "#e5e7eb",
  showValue = true,
  showPercentage = false,
  className = "",
}) => {
  // Calculate percentage
  const percentage = Math.min(Math.max((value / max) * 100, 0), 100);

  // Prepare data for RadialBarChart
  const data = [
    {
      value: percentage,
      fill: color,
    },
  ];

  return (
    <motion.div
      className={`circular-gauge ${className}`}
      style={{ width: size, height: size }}
      initial={{ scale: 0.8, opacity: 0 }}
      animate={{ scale: 1, opacity: 1 }}
      transition={{ duration: 0.5, ease: "easeOut" }}
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
            fill={color}
            startAngle={90}
            endAngle={-270}
            cornerRadius={strokeWidth / 2}
          />
        </RadialBarChart>
      </ResponsiveContainer>

      {/* Value display */}
      {showValue && (
        <motion.div
          className="absolute inset-0 flex items-center justify-center"
          initial={{ scale: 0 }}
          animate={{ scale: 1 }}
          transition={{ delay: 0.3, duration: 0.3 }}
        >
          <div className="text-center">
            <motion.div
              className="text-lg font-bold text-gray-800"
              initial={{ opacity: 0 }}
              animate={{ opacity: 1 }}
              transition={{ delay: 0.5 }}
            >
              {showPercentage ? `${Math.round(percentage)}%` : value}
            </motion.div>
          </div>
        </motion.div>
      )}
    </motion.div>
  );
};

export default CircularGauge;
