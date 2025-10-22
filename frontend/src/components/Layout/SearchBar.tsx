"use client";

import React, { useState, useRef, useEffect } from "react";
import { useRouter } from "next/navigation";

interface SearchBarProps {
  initialQuery?: string;
  initialType?: "immeuble" | "occupant";
  onSearch?: (query: string, type: string) => void;
}

const SearchBar: React.FC<SearchBarProps> = ({
  initialQuery = "",
  initialType = "immeuble",
  onSearch,
}) => {
  const [isAdvancedOpen, setIsAdvancedOpen] = useState(false);
  const [searchQuery, setSearchQuery] = useState(initialQuery);
  const [searchType, setSearchType] = useState<"immeuble" | "occupant">(
    initialType
  );
  const [advancedSearch, setAdvancedSearch] = useState({
    refNumero: "",
    nom: "",
    adresse: "",
  });

  const advancedRef = useRef<HTMLDivElement>(null);
  const router = useRouter();

  // Close advanced search when clicking outside
  useEffect(() => {
    const handleClickOutside = (event: MouseEvent) => {
      if (
        advancedRef.current &&
        !advancedRef.current.contains(event.target as Node)
      ) {
        setIsAdvancedOpen(false);
      }
    };

    document.addEventListener("mousedown", handleClickOutside);
    return () => {
      document.removeEventListener("mousedown", handleClickOutside);
    };
  }, []);

  const handleSimpleSearch = (e: React.FormEvent) => {
    e.preventDefault();
    if (searchQuery.trim()) {
      if (onSearch) {
        onSearch(searchQuery.trim(), searchType);
      } else {
        router.push(`/search?tout=${encodeURIComponent(searchQuery.trim())}`);
      }
    }
  };

  const handleAdvancedSearch = (e: React.FormEvent) => {
    e.preventDefault();
    const params = new URLSearchParams();

    if (searchType) params.set("type", searchType);
    if (advancedSearch.refNumero)
      params.set("ref_numero", advancedSearch.refNumero);
    if (advancedSearch.nom) params.set("nom", advancedSearch.nom);
    if (advancedSearch.adresse) params.set("adresse", advancedSearch.adresse);

    if (onSearch) {
      onSearch(JSON.stringify(advancedSearch), searchType);
    } else {
      router.push(`/search?${params.toString()}`);
    }

    setIsAdvancedOpen(false);
  };

  const handleReset = () => {
    setAdvancedSearch({
      refNumero: "",
      nom: "",
      adresse: "",
    });
    setSearchQuery("");
  };

  return (
    <div className="flex items-center space-x-4">
      {/* Advanced Search Dropdown */}
      <div className="relative" ref={advancedRef}>
        <button
          className="flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors duration-200 text-sm font-medium"
          type="button"
          onClick={() => setIsAdvancedOpen(!isAdvancedOpen)}
        >
          <i className="fas fa-search mr-2"></i>
          Recherche avancée
          <i className="fas fa-chevron-down ml-2 text-xs"></i>
        </button>

        {/* Advanced Search Panel */}
        {isAdvancedOpen && (
          <div className="absolute right-0 mt-2 w-96 bg-white rounded-lg shadow-lg border border-gray-200 z-50 p-6">
            <h3 className="text-lg font-semibold text-gray-800 mb-4">
              Recherche avancée
            </h3>

            <form onSubmit={handleAdvancedSearch} className="space-y-4">
              {/* Search Type */}
              <div>
                <label className="block text-sm font-medium text-gray-700 mb-2">
                  Type de recherche
                </label>
                <div className="flex space-x-4">
                  <label className="flex items-center">
                    <input
                      type="radio"
                      name="type"
                      value="immeuble"
                      checked={searchType === "immeuble"}
                      onChange={(e) =>
                        setSearchType(e.target.value as "immeuble" | "occupant")
                      }
                      className="mr-2"
                    />
                    <span className="text-sm text-gray-700">Immeuble</span>
                  </label>
                  <label className="flex items-center">
                    <input
                      type="radio"
                      name="type"
                      value="occupant"
                      checked={searchType === "occupant"}
                      onChange={(e) =>
                        setSearchType(e.target.value as "immeuble" | "occupant")
                      }
                      className="mr-2"
                    />
                    <span className="text-sm text-gray-700">Occupant</span>
                  </label>
                </div>
              </div>

              {/* Search Fields */}
              <div className="grid grid-cols-1 gap-4">
                <div>
                  <input
                    type="text"
                    placeholder="Référence / Numéro"
                    value={advancedSearch.refNumero}
                    onChange={(e) =>
                      setAdvancedSearch((prev) => ({
                        ...prev,
                        refNumero: e.target.value,
                      }))
                    }
                    className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                  />
                </div>
                <div>
                  <input
                    type="text"
                    placeholder="Nom"
                    value={advancedSearch.nom}
                    onChange={(e) =>
                      setAdvancedSearch((prev) => ({
                        ...prev,
                        nom: e.target.value,
                      }))
                    }
                    className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                  />
                </div>
                <div>
                  <input
                    type="text"
                    placeholder="Adresse / CP / Ville"
                    value={advancedSearch.adresse}
                    onChange={(e) =>
                      setAdvancedSearch((prev) => ({
                        ...prev,
                        adresse: e.target.value,
                      }))
                    }
                    className="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
                  />
                </div>
              </div>

              {/* Action Buttons */}
              <div className="flex space-x-2 pt-4">
                <button
                  type="submit"
                  className="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md text-sm font-medium transition-colors duration-200"
                >
                  <i className="fas fa-search mr-2"></i>
                  Rechercher
                </button>
                <button
                  type="button"
                  onClick={handleReset}
                  className="px-4 py-2 border border-gray-300 text-gray-700 rounded-md text-sm hover:bg-gray-50 transition-colors duration-200"
                >
                  Effacer
                </button>
              </div>
            </form>
          </div>
        )}
      </div>

      {/* Simple Search */}
      <form onSubmit={handleSimpleSearch} className="flex-1 max-w-md">
        <div className="relative">
          <input
            type="text"
            placeholder="Rechercher..."
            value={searchQuery}
            onChange={(e) => setSearchQuery(e.target.value)}
            className="w-full px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
          />
          <button
            type="submit"
            className="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors duration-200"
          >
            <i className="fas fa-search"></i>
          </button>
        </div>
      </form>

      {/* Code Search */}
      <form className="sm:block">
        <div className="relative">
          <input
            type="text"
            placeholder="Code (immeuble/occupant)"
            className="w-48 px-4 py-2 pr-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 text-sm"
          />
          <button
            type="submit"
            className="absolute right-2 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-600 transition-colors duration-200"
          >
            <i className="fas fa-search"></i>
          </button>
        </div>
      </form>
    </div>
  );
};

export default SearchBar;
