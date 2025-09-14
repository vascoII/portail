"use client";

import { useParams } from "next/navigation";
import { useImmeuble } from "@/app/hooks/useImmeuble";
import { useIndicators } from "@/app/hooks/useIndicators";
import ImmeubleCard from "@/app/components/ImmeubleCard";
import IndicatorsTable from "@/app/components/IndicatorsTable";
import ButtonsAsync from "@/app/components/ButtonsAsync";

export default function ImmeublePage() {
  const params = useParams();
  const id = params.id as string; // <-- type assertion pour POC

  const { data: immeuble, loading: loadingImmeuble } = useImmeuble(id);
  const { data: indicators, loading: loadingIndicators } = useIndicators(id);

  return (
    <main className="p-8">
      <h1>Vue Immeuble {id}</h1>

      {loadingImmeuble ? (
        <p>Chargement de l'immeuble...</p>
      ) : (
        <ImmeubleCard {...immeuble} />
      )}

      <h2 className="mt-6">Indicateurs</h2>
      <IndicatorsTable indicators={indicators} loading={loadingIndicators} />

      <ButtonsAsync id={id} />
    </main>
  );
}
