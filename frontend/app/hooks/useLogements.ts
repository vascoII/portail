import { useState, useEffect } from "react";

interface Logement {
  id: string;
  numero: string;
  adresse: string;
  ville: string;
  cp: string;
  occupant: {
    ref: string;
    nom: string;
    dateArrivee: string;
  };
  nbAppareils: number;
  nbCompteurs: {
    eauFroide: number;
    eauChaude: number;
    repartiteurs: number;
    cet: number;
    electricite: number;
    gaz: number;
  };
}

interface UseLogementsReturn {
  logements: Logement[];
  loading: boolean;
  error: string | null;
  refetch: () => void;
  createLogement: (data: Partial<Logement>) => Promise<void>;
  updateLogement: (id: string, data: Partial<Logement>) => Promise<void>;
  deleteLogement: (id: string) => Promise<void>;
}

export const useLogements = (immeubleId?: string): UseLogementsReturn => {
  const [logements, setLogements] = useState<Logement[]>([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  const fetchLogements = async () => {
    setLoading(true);
    setError(null);

    try {
      const url = immeubleId
        ? `/api/immeubles/${immeubleId}/logements`
        : "/api/logements";
      const response = await fetch(url);

      if (response.ok) {
        const data = await response.json();
        setLogements(data);
      } else {
        throw new Error("Failed to fetch logements");
      }
    } catch (err) {
      setError(err instanceof Error ? err.message : "An error occurred");
    } finally {
      setLoading(false);
    }
  };

  const createLogement = async (data: Partial<Logement>) => {
    try {
      const response = await fetch("/api/logements", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      });

      if (response.ok) {
        const newLogement = await response.json();
        setLogements((prev) => [...prev, newLogement]);
      } else {
        throw new Error("Failed to create logement");
      }
    } catch (err) {
      setError(err instanceof Error ? err.message : "An error occurred");
      throw err;
    }
  };

  const updateLogement = async (id: string, data: Partial<Logement>) => {
    try {
      const response = await fetch(`/api/logements/${id}`, {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      });

      if (response.ok) {
        const updatedLogement = await response.json();
        setLogements((prev) =>
          prev.map((logement) =>
            logement.id === id ? updatedLogement : logement
          )
        );
      } else {
        throw new Error("Failed to update logement");
      }
    } catch (err) {
      setError(err instanceof Error ? err.message : "An error occurred");
      throw err;
    }
  };

  const deleteLogement = async (id: string) => {
    try {
      const response = await fetch(`/api/logements/${id}`, {
        method: "DELETE",
      });

      if (response.ok) {
        setLogements((prev) => prev.filter((logement) => logement.id !== id));
      } else {
        throw new Error("Failed to delete logement");
      }
    } catch (err) {
      setError(err instanceof Error ? err.message : "An error occurred");
      throw err;
    }
  };

  useEffect(() => {
    fetchLogements();
  }, [immeubleId]);

  return {
    logements,
    loading,
    error,
    refetch: fetchLogements,
    createLogement,
    updateLogement,
    deleteLogement,
  };
};
