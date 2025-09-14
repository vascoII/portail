// useImmeuble.ts
"use client";
import { useState, useEffect } from "react";

export const useImmeuble = (id: string) => {
  const [data, setData] = useState<any>(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    fetch(`http://localhost:8000/api/immeubles/${id}`)
      .then((res) => res.json())
      .then((json) => setData(json))
      .finally(() => setLoading(false));
  }, [id]);

  return { data, loading };
};
