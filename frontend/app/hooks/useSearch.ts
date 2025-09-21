import { useState, useCallback } from "react";

interface SearchFilters {
  type: "immeuble" | "occupant" | "all";
  ref_numero?: string;
  nom?: string;
  adresse?: string;
  tout?: string;
  ref?: string;
}

interface SearchResult {
  id: string;
  type: "immeuble" | "occupant";
  title: string;
  subtitle: string;
  description?: string;
  url: string;
}

interface UseSearchReturn {
  results: SearchResult[];
  loading: boolean;
  error: string | null;
  search: (query: string, filters?: Partial<SearchFilters>) => Promise<void>;
  clearResults: () => void;
}

export const useSearch = (): UseSearchReturn => {
  const [results, setResults] = useState<SearchResult[]>([]);
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);

  const search = useCallback(
    async (query: string, filters: Partial<SearchFilters> = {}) => {
      if (!query.trim()) {
        setResults([]);
        return;
      }

      setLoading(true);
      setError(null);

      try {
        const searchParams = new URLSearchParams();

        if (filters.tout) {
          searchParams.append("tout", filters.tout);
        } else if (filters.ref) {
          searchParams.append("ref", filters.ref);
        } else {
          searchParams.append("type", filters.type || "all");
          if (filters.ref_numero)
            searchParams.append("ref_numero", filters.ref_numero);
          if (filters.nom) searchParams.append("nom", filters.nom);
          if (filters.adresse) searchParams.append("adresse", filters.adresse);
        }

        const response = await fetch(`/api/search?${searchParams.toString()}`);

        if (response.ok) {
          const data = await response.json();
          setResults(data);
        } else {
          throw new Error("Search failed");
        }
      } catch (err) {
        setError(err instanceof Error ? err.message : "An error occurred");
        setResults([]);
      } finally {
        setLoading(false);
      }
    },
    []
  );

  const clearResults = useCallback(() => {
    setResults([]);
    setError(null);
  }, []);

  return {
    results,
    loading,
    error,
    search,
    clearResults,
  };
};
