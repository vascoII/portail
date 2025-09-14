"use client";

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
  if (loading) {
    return <p>Chargement des indicateurs...</p>;
  }

  return (
    <table className="border-collapse border w-full">
      <thead>
        <tr>
          <th className="border px-2">KPI</th>
          <th className="border px-2">Valeur</th>
          <th className="border px-2">Dernière MAJ</th>
        </tr>
      </thead>
      <tbody>
        {indicators.map((ind, idx) => (
          <tr key={idx}>
            <td className="border px-2">{ind.kpi_name}</td>
            <td className="border px-2">{ind.kpi_value}</td>
            <td className="border px-2">{ind.updated_at}</td>
          </tr>
        ))}
      </tbody>
    </table>
  );
}
