"use client";

import { useParams } from "next/navigation";
import { useImmeuble } from "@/app/hooks/useImmeuble";
import { useIndicators } from "@/app/hooks/useIndicators";
import ImmeubleCard from "@/app/components/ImmeubleCard";
import IndicatorsTable from "@/app/components/IndicatorsTable";
import ButtonsAsync from "@/app/components/ButtonsAsync";

export default function ImmeublePage() {
  const params = useParams();
  const id = params.id as string;

  const { data: immeuble, loading: loadingImmeuble } = useImmeuble(id);
  const { data: indicators, loading: loadingIndicators } = useIndicators(id);

  return (
    <main className="p-8 max-w-4xl mx-auto">
      <h1 className="text-2xl font-bold text-gray-800 mb-6">Vue Immeuble #{id}</h1>

      <ImmeubleCard {...immeuble} />

      <h2 className="text-xl font-semibold text-gray-700 mt-8 mb-2">Indicateurs</h2>
      <IndicatorsTable indicators={indicators} loading={loadingIndicators} />

      <div className="mt-6">
        <ButtonsAsync id={id} />
      </div>
    </main>
  );
}
