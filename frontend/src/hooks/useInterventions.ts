import { useState, useEffect } from "react";

interface Intervention {
  id: string;
  numero: string;
  dateCreation: string;
  statut: "ouvert" | "en_cours" | "ferme";
  type: string;
  description: string;
  priorite: "basse" | "normale" | "haute" | "critique";
  technicien?: string;
  dateIntervention?: string;
  immeubleId?: string;
  logementId?: string;
}

interface UseInterventionsReturn {
  interventions: Intervention[];
  loading: boolean;
  error: string | null;
  refetch: () => void;
  createIntervention: (data: Partial<Intervention>) => Promise<void>;
  updateIntervention: (
    id: string,
    data: Partial<Intervention>
  ) => Promise<void>;
  deleteIntervention: (id: string) => Promise<void>;
  filterInterventions: (filters: {
    statut?: string;
    priorite?: string;
    type?: string;
  }) => void;
}

export const useInterventions = (
  immeubleId?: string,
  logementId?: string
): UseInterventionsReturn => {
  const [interventions, setInterventions] = useState<Intervention[]>([]);
  const [filteredInterventions, setFilteredInterventions] = useState<
    Intervention[]
  >([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  const fetchInterventions = async () => {
    setLoading(true);
    setError(null);

    try {
      let url = "/api/interventions";
      if (immeubleId) {
        url = `/api/immeubles/${immeubleId}/interventions`;
      } else if (logementId) {
        url = `/api/logements/${logementId}/interventions`;
      }

      const response = await fetch(url);

      if (response.ok) {
        const data = await response.json();
        setInterventions(data);
        setFilteredInterventions(data);
      } else {
        throw new Error("Failed to fetch interventions");
      }
    } catch (err) {
      setError(err instanceof Error ? err.message : "An error occurred");
    } finally {
      setLoading(false);
    }
  };

  const createIntervention = async (data: Partial<Intervention>) => {
    try {
      const response = await fetch("/api/interventions", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      });

      if (response.ok) {
        const newIntervention = await response.json();
        setInterventions((prev) => [...prev, newIntervention]);
        setFilteredInterventions((prev) => [...prev, newIntervention]);
      } else {
        throw new Error("Failed to create intervention");
      }
    } catch (err) {
      setError(err instanceof Error ? err.message : "An error occurred");
      throw err;
    }
  };

  const updateIntervention = async (
    id: string,
    data: Partial<Intervention>
  ) => {
    try {
      const response = await fetch(`/api/interventions/${id}`, {
        method: "PUT",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(data),
      });

      if (response.ok) {
        const updatedIntervention = await response.json();
        setInterventions((prev) =>
          prev.map((intervention) =>
            intervention.id === id ? updatedIntervention : intervention
          )
        );
        setFilteredInterventions((prev) =>
          prev.map((intervention) =>
            intervention.id === id ? updatedIntervention : intervention
          )
        );
      } else {
        throw new Error("Failed to update intervention");
      }
    } catch (err) {
      setError(err instanceof Error ? err.message : "An error occurred");
      throw err;
    }
  };

  const deleteIntervention = async (id: string) => {
    try {
      const response = await fetch(`/api/interventions/${id}`, {
        method: "DELETE",
      });

      if (response.ok) {
        setInterventions((prev) =>
          prev.filter((intervention) => intervention.id !== id)
        );
        setFilteredInterventions((prev) =>
          prev.filter((intervention) => intervention.id !== id)
        );
      } else {
        throw new Error("Failed to delete intervention");
      }
    } catch (err) {
      setError(err instanceof Error ? err.message : "An error occurred");
      throw err;
    }
  };

  const filterInterventions = (filters: {
    statut?: string;
    priorite?: string;
    type?: string;
  }) => {
    let filtered = interventions;

    if (filters.statut) {
      filtered = filtered.filter(
        (intervention) => intervention.statut === filters.statut
      );
    }

    if (filters.priorite) {
      filtered = filtered.filter(
        (intervention) => intervention.priorite === filters.priorite
      );
    }

    if (filters.type) {
      filtered = filtered.filter((intervention) =>
        intervention.type.toLowerCase().includes(filters.type!.toLowerCase())
      );
    }

    setFilteredInterventions(filtered);
  };

  useEffect(() => {
    fetchInterventions();
  }, [immeubleId, logementId]);

  return {
    interventions: filteredInterventions,
    loading,
    error,
    refetch: fetchInterventions,
    createIntervention,
    updateIntervention,
    deleteIntervention,
    filterInterventions,
  };
};
