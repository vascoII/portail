"use client";
import React, { useState } from "react";
import { useRouter } from "next/navigation";

interface SearchFormProps {
  isCodeForm?: boolean;
  className?: string;
}

const SearchForm: React.FC<SearchFormProps> = ({
  isCodeForm = false,
  className = "",
}) => {
  const [searchTerm, setSearchTerm] = useState("");
  const [advancedSearch, setAdvancedSearch] = useState(false);
  const [searchType, setSearchType] = useState("immeuble");
  const [searchParams, setSearchParams] = useState({
    ref_numero: "",
    nom: "",
    adresse: "",
  });
  const router = useRouter();

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    if (isCodeForm) {
      router.push(`/search?ref=${searchTerm}`);
    } else {
      router.push(`/search?tout=${searchTerm}`);
    }
  };

  const handleAdvancedSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    const params = new URLSearchParams({
      type: searchType,
      ...searchParams,
    });
    router.push(`/search?${params.toString()}`);
  };

  const resetForm = () => {
    setSearchParams({ ref_numero: "", nom: "", adresse: "" });
    setSearchTerm("");
  };

  if (isCodeForm) {
    return (
      <form onSubmit={handleSubmit} className="code">
        <div className="input-group code_form hidden-xs">
          <input
            type="text"
            name="ref"
            className="form-control"
            placeholder="Saisir un code (immeuble/occupant)"
            value={searchTerm}
            onChange={(e) => setSearchTerm(e.target.value)}
          />
          <span className="input-group-btn">
            <button className="btn btn-white" type="submit"></button>
          </span>
        </div>
      </form>
    );
  }

  return (
    <div className={`input-group search_form hidden-xs ${className}`}>
      <span className="input-group-btn">
        <div className="dropdown">
          <button
            className="btn btn-primary btn-lg dropdown-toggle"
            type="button"
            onClick={() => setAdvancedSearch(!advancedSearch)}
          >
            Recherche avancée
            <span className="carett"></span>
          </button>
          {advancedSearch && (
            <div className="dropdown-menu advanced_search col-md-8 col-sm-8 hidden-xs">
              <form
                onSubmit={handleAdvancedSubmit}
                className="form-horizontal form-groups-bordered"
              >
                <div className="form-group">
                  <div className="col-lg-12">
                    <div
                      className="checkbox checkbox-replace"
                      style={{ display: "inline-block" }}
                    >
                      <input
                        type="radio"
                        name="type"
                        value="immeuble"
                        checked={searchType === "immeuble"}
                        onChange={(e) => setSearchType(e.target.value)}
                      />
                      <label>Immeuble</label>
                    </div>
                    <div
                      className="checkbox checkbox-replace"
                      style={{ display: "inline-block" }}
                    >
                      <input
                        type="radio"
                        name="type"
                        value="occupant"
                        checked={searchType === "occupant"}
                        onChange={(e) => setSearchType(e.target.value)}
                      />
                      <label>Occupant</label>
                    </div>
                  </div>
                  <div className="col-lg-6 col-md-6 col-sm-6">
                    <input
                      type="text"
                      className="form-control"
                      name="ref_numero"
                      placeholder="Référence / Numéro"
                      value={searchParams.ref_numero}
                      onChange={(e) =>
                        setSearchParams({
                          ...searchParams,
                          ref_numero: e.target.value,
                        })
                      }
                    />
                  </div>
                  <div className="col-lg-6 col-md-6 col-sm-6">
                    <input
                      type="text"
                      className="form-control"
                      name="nom"
                      placeholder="Nom"
                      value={searchParams.nom}
                      onChange={(e) =>
                        setSearchParams({
                          ...searchParams,
                          nom: e.target.value,
                        })
                      }
                    />
                  </div>
                  <div className="col-lg-6 col-md-6 col-sm-6">
                    <input
                      type="text"
                      className="form-control"
                      name="adresse"
                      placeholder="Adresse / CP / Ville"
                      value={searchParams.adresse}
                      onChange={(e) =>
                        setSearchParams({
                          ...searchParams,
                          adresse: e.target.value,
                        })
                      }
                    />
                  </div>
                  <div className="col-lg-6 col-md-6 col-sm-6">
                    <button type="submit" className="btn btn-default submit">
                      <i className="fa fa-search"></i>
                    </button>
                    <button type="button" className="reset" onClick={resetForm}>
                      Effacer
                    </button>
                  </div>
                </div>
              </form>
            </div>
          )}
        </div>
      </span>

      <form
        onSubmit={handleSubmit}
        className="form-horizontal form-groups-bordered"
      >
        <input
          type="text"
          name="tout"
          className="form-control"
          value={searchTerm}
          onChange={(e) => setSearchTerm(e.target.value)}
        />
        <span className="input-group-btn input-group-btn-b">
          <button className="btn btn-primary" type="submit"></button>
        </span>
      </form>
    </div>
  );
};

export default SearchForm;
