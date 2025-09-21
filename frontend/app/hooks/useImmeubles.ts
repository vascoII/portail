import { useState, useEffect } from "react";

interface Immeuble {
  id: string;
  numero: string;
  adresse: string;
  ville: string;
  cp: string;
  nbLogements: number;
  nbAnomalies: number;
  nbDysfonctionnements: number;
  nbInterventions: number;
  nbFuite: number;
}

interface UseImmeublesReturn {
  immeubles: Immeuble[];
  loading: boolean;
  error: string | null;
  refetch: () => void;
  createImmeuble: (data: Partial<Immeuble>) => Promise<void>;
  updateImmeuble: (id: string, data: Partial<Immeuble>) => Promise<void>;
  deleteImmeuble: (id: string) => Promise<void>;
}

export const useImmeubles = (): UseImmeublesReturn => {
  const [immeubles, setImmeubles] = useState<Immeuble[]>([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  const fetchImmeubles = async () => {
    setLoading(true);
    setError(null);

    try {
      const response = await fetch("/api/immeubles");
      if (response.ok) {
        const data = await response.json();
        setImmeubles(data);
      } else {
        throw new Error("Failed to fetch immeubles");
      }
    } catch (err) {
      setError(err instanceof Error ? err.message : "An error occurred");
    } finally {
      setLoading(false);
    }
  };

  const createImmeuble = async (data: Partial<Immeuble>) => {
    try {
      const response = await fetch("/api/immeubles", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      });

      if (response.ok) {
        const newImmeuble = await response.json();
        setImmeubles((prev) => [...prev, newImmeuble]);
      } else {
        throw new Error("Failed to create immeuble");
      }
    } catch (err) {
      setError(err instanceof Error ? err.message : "An error occurred");
      throw err;
    }
  };

  const updateImmeuble = async (id: string, data: Partial<Immeuble>) => {
    try {
      const response = await fetch(`/api/immeubles/${id}`, {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      });

      if (response.ok) {
        const updatedImmeuble = await response.json();
        setImmeubles((prev) =>
          prev.map((immeuble) =>
            immeuble.id === id ? updatedImmeuble : immeuble
          )
        );
      } else {
        throw new Error("Failed to update immeuble");
      }
    } catch (err) {
      setError(err instanceof Error ? err.message : "An error occurred");
      throw err;
    }
  };

  const deleteImmeuble = async (id: string) => {
    try {
      const response = await fetch(`/api/immeubles/${id}`, {
        method: "DELETE",
      });

      if (response.ok) {
        setImmeubles((prev) => prev.filter((immeuble) => immeuble.id !== id));
      } else {
        throw new Error("Failed to delete immeuble");
      }
    } catch (err) {
      setError(err instanceof Error ? err.message : "An error occurred");
      throw err;
    }
  };

  useEffect(() => {
    fetchImmeubles();
  }, []);

  return {
    immeubles,
    loading,
    error,
    refetch: fetchImmeubles,
    createImmeuble,
    updateImmeuble,
    deleteImmeuble,
  };
};
