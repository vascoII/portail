"use client";

import React, { useEffect, useRef } from "react";

interface OperatorStatsProps {
  stats: Array<{
    date: string;
    value: number;
  }>;
}

const OperatorStats: React.FC<OperatorStatsProps> = ({ stats }) => {
  const chartRef = useRef<HTMLDivElement>(null);

  useEffect(() => {
    // Load Google Charts
    const script = document.createElement("script");
    script.src = "https://www.gstatic.com/charts/loader.js";
    script.onload = () => {
      if (window.google) {
        window.google.charts.load("current", { packages: ["corechart"] });
        window.google.charts.setOnLoadCallback(drawChart);
      }
    };
    document.head.appendChild(script);

    return () => {
      // Cleanup
      if (script.parentNode) {
        script.parentNode.removeChild(script);
      }
    };
  }, [stats]);

  const drawChart = () => {
    if (!chartRef.current || !window.google) return;

    const data = new window.google.visualization.DataTable();
    data.addColumn("string", "Mois");
    data.addColumn("number", "Connexions uniques");

    // Sort and format data
    const sortedStats = [...stats].sort(
      (a, b) => new Date(a.date).getTime() - new Date(b.date).getTime()
    );

    const formattedData = sortedStats.map((item) => [
      new Date(item.date).toLocaleDateString("fr-FR", {
        month: "short",
        year: "numeric",
      }),
      parseInt(item.value.toString()),
    ]);

    data.addRows(formattedData);

    const options = {
      curveType: "function",
      legend: { position: "bottom" },
      colors: ["#E30713"],
      annotations: { alwaysOutside: true },
      hAxis: {
        title: "Mois",
        titleTextStyle: { color: "#333" },
      },
      vAxis: {
        title: "Connexions uniques",
        titleTextStyle: { color: "#333" },
        minValue: 0,
      },
      chartArea: {
        width: "80%",
        height: "70%",
      },
    };

    const chart = new window.google.visualization.ColumnChart(chartRef.current);
    chart.draw(data, options);
  };

  return (
    <div className="max-w-6xl mx-auto">
      <div className="bg-white rounded-lg shadow-md p-6">
        <h2 className="text-2xl font-bold text-gray-800 mb-6">
          Connexions uniques mensuelles
        </h2>

        {/* Explanation */}
        <div className="bg-blue-50 border border-blue-200 rounded-lg p-6 mb-8">
          <h3 className="text-lg font-semibold text-blue-800 mb-3">
            Un peu d'explication
          </h3>
          <p className="text-blue-700 text-sm leading-relaxed">
            La statistique de connexion unique des utilisateurs ci-dessous
            mesure combien de visiteurs distincts accèdent à leur page logement
            par mois. Contrairement aux simples "vues de page", qui comptent
            chaque visite même si un utilisateur revient plusieurs fois, cette
            statistique essaie de ne compter chaque individu qu'une seule fois
            par période (1 mois).
          </p>
        </div>

        {/* Chart */}
        <div className="mb-8">
          <h3 className="text-lg font-semibold text-gray-800 mb-4">
            Statistiques de connexions mensuelles
          </h3>
          <div
            ref={chartRef}
            style={{ width: "100%", height: "400px" }}
            className="border border-gray-200 rounded-lg"
          ></div>
        </div>

        {/* Summary Stats */}
        <div className="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div className="bg-gray-50 rounded-lg p-6 text-center">
            <div className="text-3xl font-bold text-blue-600 mb-2">
              {stats.length}
            </div>
            <div className="text-sm text-gray-600">Mois enregistrés</div>
          </div>
          <div className="bg-gray-50 rounded-lg p-6 text-center">
            <div className="text-3xl font-bold text-green-600 mb-2">
              {stats.length > 0
                ? Math.max(...stats.map((s) => parseInt(s.value.toString())))
                : 0}
            </div>
            <div className="text-sm text-gray-600">Pic de connexions</div>
          </div>
          <div className="bg-gray-50 rounded-lg p-6 text-center">
            <div className="text-3xl font-bold text-purple-600 mb-2">
              {stats.length > 0
                ? Math.round(
                    stats.reduce(
                      (sum, s) => sum + parseInt(s.value.toString()),
                      0
                    ) / stats.length
                  )
                : 0}
            </div>
            <div className="text-sm text-gray-600">Moyenne mensuelle</div>
          </div>
        </div>

        {/* Data Table */}
        {stats.length > 0 && (
          <div className="mt-8">
            <h3 className="text-lg font-semibold text-gray-800 mb-4">
              Données détaillées
            </h3>
            <div className="overflow-x-auto">
              <table className="min-w-full divide-y divide-gray-200">
                <thead className="bg-gray-50">
                  <tr>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Mois
                    </th>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Connexions uniques
                    </th>
                    <th className="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                      Évolution
                    </th>
                  </tr>
                </thead>
                <tbody className="bg-white divide-y divide-gray-200">
                  {sortedStats.map((stat, index) => {
                    const currentValue = parseInt(stat.value.toString());
                    const previousValue =
                      index > 0
                        ? parseInt(sortedStats[index - 1].value.toString())
                        : null;
                    const evolution =
                      previousValue !== null
                        ? ((currentValue - previousValue) / previousValue) * 100
                        : null;

                    return (
                      <tr key={stat.date} className="hover:bg-gray-50">
                        <td className="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                          {new Date(stat.date).toLocaleDateString("fr-FR", {
                            month: "long",
                            year: "numeric",
                          })}
                        </td>
                        <td className="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                          {currentValue}
                        </td>
                        <td className="px-6 py-4 whitespace-nowrap text-sm">
                          {evolution !== null ? (
                            <span
                              className={`inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium ${
                                evolution > 0
                                  ? "bg-green-100 text-green-800"
                                  : evolution < 0
                                  ? "bg-red-100 text-red-800"
                                  : "bg-gray-100 text-gray-800"
                              }`}
                            >
                              {evolution > 0 ? "+" : ""}
                              {evolution.toFixed(1)}%
                            </span>
                          ) : (
                            <span className="text-gray-400">-</span>
                          )}
                        </td>
                      </tr>
                    );
                  })}
                </tbody>
              </table>
            </div>
          </div>
        )}
      </div>
    </div>
  );
};

export default OperatorStats;
