"use client";

import Skeleton from 'react-loading-skeleton';
import 'react-loading-skeleton/dist/skeleton.css';

interface Indicator {
  kpi_name: string;
  kpi_value: number;
  updated_at: string;
}

interface Props {
  indicators: Indicator[];
  loading: boolean;
}

export default function IndicatorsTable({ indicators, loading }: Props) {
  return (
    <div className="mt-4 overflow-x-auto">
      <table className="min-w-full border border-gray-300 bg-white rounded-md shadow-sm">
        <thead className="bg-gray-100">
          <tr>
            <th className="text-left px-4 py-2 border-b">KPI</th>
            <th className="text-left px-4 py-2 border-b">Valeur</th>
            <th className="text-left px-4 py-2 border-b">Dernière MAJ</th>
          </tr>
        </thead>
        <tbody>
          {loading ? (
            Array.from({ length: 3 }).map((_, i) => (
              <tr key={i}>
                <td className="px-4 py-2 border-b"><Skeleton /></td>
                <td className="px-4 py-2 border-b"><Skeleton /></td>
                <td className="px-4 py-2 border-b"><Skeleton /></td>
              </tr>
            ))
          ) : (
            indicators.map((ind, idx) => (
              <tr key={idx} className="hover:bg-gray-50">
                <td className="px-4 py-2 border-b">{ind.kpi_name}</td>
                <td className="px-4 py-2 border-b">{ind.kpi_value}</td>
                <td className="px-4 py-2 border-b">{ind.updated_at}</td>
              </tr>
            ))
          )}
        </tbody>
      </table>
      {loading && <p className="text-sm text-gray-500 mt-2">Chargement des indicateurs...</p>}
    </div>
  );
}
