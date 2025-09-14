// useIndicators.ts
"use client";
import { useState, useEffect } from "react";

export const useIndicators = (id: string) => {
  const [data, setData] = useState<any[]>([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch(`http://localhost:8000/api/immeubles/${id}/indicators`)
      .then((res) => res.json())
      .then((json) => setData(json))
      .finally(() => setLoading(false));
  }, [id]);

  return { data, loading };
};
