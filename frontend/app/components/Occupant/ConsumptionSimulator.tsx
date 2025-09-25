"use client";

import React, { useState, useRef, useEffect } from "react";

interface ConsumptionData {
  [key: string]: number;
}

const ConsumptionSimulator: React.FC = () => {
  const [formData, setFormData] = useState({
    occupants: 1,
    dishwasher: "none",
    dishwasherPerf: "standard",
    dishwasherCycles: 0,
    washingMachine: "none",
    washingPerf: "standard",
    washingCycles: 0,
    showers: 0,
    baths: 0,
    toilet: "standard",
    flushes: 0,
    garden: "none",
    gardenSize: 0,
  });

  const [isMonthly, setIsMonthly] = useState(false);
  const [result, setResult] = useState<ConsumptionData | null>(null);
  const [total, setTotal] = useState(0);
  const chartRef = useRef<HTMLCanvasElement>(null);

  const handleInputChange = (field: string, value: string | number) => {
    setFormData((prev) => ({
      ...prev,
      [field]: value,
    }));
  };

  const calculateConsumption = () => {
    const {
      occupants,
      dishwasher,
      dishwasherPerf,
      dishwasherCycles,
      washingMachine,
      washingPerf,
      washingCycles,
      showers,
      baths,
      toilet,
      flushes,
      garden,
      gardenSize,
    } = formData;

    const showerUse = occupants * (showers as number) * 50;
    const bathUse = occupants * (baths as number) * 150;
    const toiletUse =
      occupants * (flushes as number) * (toilet === "eco" ? 5 : 10);
    const dishwasherUse =
      dishwasher === "yes"
        ? (dishwasherCycles as number) * (dishwasherPerf === "low" ? 10 : 15)
        : 0;
    const washingUse =
      washingMachine === "yes"
        ? (washingCycles as number) * (washingPerf === "low" ? 50 : 70)
        : 0;
    const gardenUse = garden === "yes" ? (gardenSize as number) * 6 : 0;

    let data: ConsumptionData = {
      Douches: showerUse,
      Bains: bathUse,
      "Chasses d'eau": toiletUse,
      "Lave-vaisselle": dishwasherUse,
      "Lave-linge": washingUse,
      Jardin: gardenUse,
    };

    if (isMonthly) {
      for (let key in data) {
        data[key] *= 4;
      }
    }

    const calculatedTotal = Object.values(data).reduce((a, b) => a + b, 0);
    setResult(data);
    setTotal(calculatedTotal);

    // Draw chart
    drawChart(data);
  };

  const drawChart = (data: ConsumptionData) => {
    if (!chartRef.current) return;

    const ctx = chartRef.current.getContext("2d");
    if (!ctx) return;

    // Clear previous chart
    ctx.clearRect(0, 0, chartRef.current.width, chartRef.current.height);

    // Simple bar chart implementation
    const maxValue = Math.max(...Object.values(data));
    const barWidth = chartRef.current.width / Object.keys(data).length;
    const maxHeight = chartRef.current.height - 40;

    Object.entries(data).forEach(([label, value], index) => {
      const barHeight = (value / maxValue) * maxHeight;
      const x = index * barWidth;
      const y = chartRef.current!.height - barHeight - 20;

      // Draw bar
      ctx.fillStyle = "rgba(54, 162, 235, 0.5)";
      ctx.fillRect(x + 10, y, barWidth - 20, barHeight);

      // Draw value
      ctx.fillStyle = "#333";
      ctx.font = "12px Arial";
      ctx.textAlign = "center";
      ctx.fillText(value.toString(), x + barWidth / 2, y - 5);

      // Draw label
      ctx.fillText(label, x + barWidth / 2, chartRef.current!.height - 5);
    });
  };

  const toggleSection = (sectionId: string, show: boolean) => {
    const element = document.getElementById(sectionId);
    if (element) {
      element.style.display = show ? "block" : "none";
    }
  };

  return (
    <div className="max-w-4xl mx-auto">
      <div className="bg-white rounded-lg shadow-md p-6">
        <h2 className="text-2xl font-bold text-gray-800 mb-6">
          Simulateur de consommation
        </h2>

        <div className="space-y-6">
          {/* Occupants */}
          <div className="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
            <h3 className="text-lg font-semibold text-gray-700 min-w-[200px]">
              Nombre d'occupants:
            </h3>
            <input
              type="number"
              value={formData.occupants}
              onChange={(e) =>
                handleInputChange("occupants", parseInt(e.target.value) || 1)
              }
              className="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              min="1"
            />
          </div>

          {/* Dishwasher */}
          <div className="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
            <h3 className="text-lg font-semibold text-gray-700 min-w-[200px]">
              Lave-vaisselle
            </h3>
            <div className="flex space-x-4">
              <label className="flex items-center">
                <input
                  type="radio"
                  name="dishwasher"
                  value="none"
                  checked={formData.dishwasher === "none"}
                  onChange={(e) => {
                    handleInputChange("dishwasher", e.target.value);
                    toggleSection("dishwasherSection", false);
                  }}
                  className="mr-2"
                />
                Non
              </label>
              <label className="flex items-center">
                <input
                  type="radio"
                  name="dishwasher"
                  value="yes"
                  checked={formData.dishwasher === "yes"}
                  onChange={(e) => {
                    handleInputChange("dishwasher", e.target.value);
                    toggleSection("dishwasherSection", true);
                  }}
                  className="mr-2"
                />
                Oui
              </label>
            </div>
          </div>

          <div
            id="dishwasherSection"
            className="ml-6 p-4 border border-gray-200 rounded-lg bg-white"
            style={{
              display: formData.dishwasher === "yes" ? "block" : "none",
            }}
          >
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">
                  Performance:
                </label>
                <select
                  value={formData.dishwasherPerf}
                  onChange={(e) =>
                    handleInputChange("dishwasherPerf", e.target.value)
                  }
                  className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  <option value="low">Faible consommation</option>
                  <option value="standard">Standard</option>
                </select>
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">
                  Nombre de cycles par semaine:
                </label>
                <input
                  type="number"
                  value={formData.dishwasherCycles}
                  onChange={(e) =>
                    handleInputChange(
                      "dishwasherCycles",
                      parseInt(e.target.value) || 0
                    )
                  }
                  className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
              </div>
            </div>
          </div>

          {/* Washing Machine */}
          <div className="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
            <h3 className="text-lg font-semibold text-gray-700 min-w-[200px]">
              Lave-linge
            </h3>
            <div className="flex space-x-4">
              <label className="flex items-center">
                <input
                  type="radio"
                  name="washingMachine"
                  value="none"
                  checked={formData.washingMachine === "none"}
                  onChange={(e) => {
                    handleInputChange("washingMachine", e.target.value);
                    toggleSection("washingSection", false);
                  }}
                  className="mr-2"
                />
                Non
              </label>
              <label className="flex items-center">
                <input
                  type="radio"
                  name="washingMachine"
                  value="yes"
                  checked={formData.washingMachine === "yes"}
                  onChange={(e) => {
                    handleInputChange("washingMachine", e.target.value);
                    toggleSection("washingSection", true);
                  }}
                  className="mr-2"
                />
                Oui
              </label>
            </div>
          </div>

          <div
            id="washingSection"
            className="ml-6 p-4 border border-gray-200 rounded-lg bg-white"
            style={{
              display: formData.washingMachine === "yes" ? "block" : "none",
            }}
          >
            <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">
                  Performance:
                </label>
                <select
                  value={formData.washingPerf}
                  onChange={(e) =>
                    handleInputChange("washingPerf", e.target.value)
                  }
                  className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                >
                  <option value="low">Faible consommation</option>
                  <option value="standard">Standard</option>
                </select>
              </div>
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">
                  Nombre de cycles par semaine:
                </label>
                <input
                  type="number"
                  value={formData.washingCycles}
                  onChange={(e) =>
                    handleInputChange(
                      "washingCycles",
                      parseInt(e.target.value) || 0
                    )
                  }
                  className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                />
              </div>
            </div>
          </div>

          {/* Showers and Baths */}
          <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div className="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
              <h3 className="text-lg font-semibold text-gray-700 min-w-[200px]">
                Douches hebdomadaires par occupant:
              </h3>
              <input
                type="number"
                value={formData.showers}
                onChange={(e) =>
                  handleInputChange("showers", parseInt(e.target.value) || 0)
                }
                className="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
            <div className="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
              <h3 className="text-lg font-semibold text-gray-700 min-w-[200px]">
                Bains hebdomadaires par occupant:
              </h3>
              <input
                type="number"
                value={formData.baths}
                onChange={(e) =>
                  handleInputChange("baths", parseInt(e.target.value) || 0)
                }
                className="w-20 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
          </div>

          {/* Toilet */}
          <div className="p-4 border border-gray-200 rounded-lg bg-gray-50">
            <h3 className="text-lg font-semibold text-gray-700 mb-4">WC:</h3>
            <div className="flex space-x-4 mb-4">
              <label className="flex items-center">
                <input
                  type="radio"
                  name="toilet"
                  value="standard"
                  checked={formData.toilet === "standard"}
                  onChange={(e) => handleInputChange("toilet", e.target.value)}
                  className="mr-2"
                />
                Standard
              </label>
              <label className="flex items-center">
                <input
                  type="radio"
                  name="toilet"
                  value="eco"
                  checked={formData.toilet === "eco"}
                  onChange={(e) => handleInputChange("toilet", e.target.value)}
                  className="mr-2"
                />
                Économique
              </label>
            </div>
            <div>
              <label className="block text-sm font-medium text-gray-700 mb-2">
                Utilisation par occupant et par semaine:
              </label>
              <input
                type="number"
                value={formData.flushes}
                onChange={(e) =>
                  handleInputChange("flushes", parseInt(e.target.value) || 0)
                }
                className="w-32 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
              />
            </div>
          </div>

          {/* Garden */}
          <div className="flex items-center space-x-4 p-4 border border-gray-200 rounded-lg bg-gray-50">
            <h3 className="text-lg font-semibold text-gray-700 min-w-[200px]">
              Jardin
            </h3>
            <div className="flex space-x-4">
              <label className="flex items-center">
                <input
                  type="radio"
                  name="garden"
                  value="none"
                  checked={formData.garden === "none"}
                  onChange={(e) => {
                    handleInputChange("garden", e.target.value);
                    toggleSection("gardenSection", false);
                  }}
                  className="mr-2"
                />
                Non
              </label>
              <label className="flex items-center">
                <input
                  type="radio"
                  name="garden"
                  value="yes"
                  checked={formData.garden === "yes"}
                  onChange={(e) => {
                    handleInputChange("garden", e.target.value);
                    toggleSection("gardenSection", true);
                  }}
                  className="mr-2"
                />
                Oui
              </label>
            </div>
          </div>

          <div
            id="gardenSection"
            className="ml-6 p-4 border border-gray-200 rounded-lg bg-white"
            style={{
              display: formData.garden === "yes" ? "block" : "none",
            }}
          >
            <label className="block text-sm font-medium text-gray-700 mb-2">
              Surface du jardin (m²):
            </label>
            <input
              type="number"
              value={formData.gardenSize}
              onChange={(e) =>
                handleInputChange("gardenSize", parseInt(e.target.value) || 0)
              }
              className="w-32 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
            />
          </div>

          {/* Calculate Button */}
          <div className="text-center">
            <button
              onClick={calculateConsumption}
              className="bg-blue-600 hover:bg-blue-700 text-white px-8 py-3 rounded-lg text-lg font-semibold transition-colors duration-200"
            >
              Calculer
            </button>
          </div>

          {/* Results */}
          {result && (
            <div className="mt-8 p-6 bg-gray-50 rounded-lg">
              <div className="flex items-center justify-between mb-4">
                <h3 className="text-lg font-semibold text-gray-800">
                  Résultats
                </h3>
                <label className="flex items-center">
                  <input
                    type="checkbox"
                    checked={isMonthly}
                    onChange={(e) => {
                      setIsMonthly(e.target.checked);
                      calculateConsumption();
                    }}
                    className="mr-2"
                  />
                  Afficher les résultats en valeurs mensuelles
                </label>
              </div>

              <div className="text-center mb-6">
                <h2 className="text-2xl font-bold text-blue-600">
                  Consommation {isMonthly ? "mensuelle" : "hebdomadaire"}:{" "}
                  {total} litres
                </h2>
              </div>

              <div className="mb-6">
                <canvas
                  ref={chartRef}
                  width={600}
                  height={300}
                  className="w-full max-w-2xl mx-auto"
                ></canvas>
              </div>

              <div className="grid grid-cols-2 md:grid-cols-3 gap-4">
                {Object.entries(result).map(([label, value]) => (
                  <div
                    key={label}
                    className="bg-white p-4 rounded-lg text-center"
                  >
                    <div className="text-2xl font-bold text-blue-600">
                      {value}L
                    </div>
                    <div className="text-sm text-gray-600">{label}</div>
                  </div>
                ))}
              </div>
            </div>
          )}
        </div>
      </div>
    </div>
  );
};

export default ConsumptionSimulator;
