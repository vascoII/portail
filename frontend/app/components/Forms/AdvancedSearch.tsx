"use client";
import React, { useState } from "react";
import { useRouter } from "next/navigation";

interface AdvancedSearchProps {
  className?: string;
}

const AdvancedSearch: React.FC<AdvancedSearchProps> = ({ className = "" }) => {
  const [searchType, setSearchType] = useState("immeuble");
  const [searchParams, setSearchParams] = useState({
    ref_numero: "",
    nom: "",
    adresse: "",
  });
  const router = useRouter();

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();
    const params = new URLSearchParams({
      type: searchType,
      ...searchParams,
    });
    router.push(`/search?${params.toString()}`);
  };

  const resetForm = () => {
    setSearchParams({ ref_numero: "", nom: "", adresse: "" });
  };

  return (
    <div className={`advanced-search ${className}`}>
      <form
        onSubmit={handleSubmit}
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
                setSearchParams({ ...searchParams, ref_numero: e.target.value })
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
                setSearchParams({ ...searchParams, nom: e.target.value })
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
                setSearchParams({ ...searchParams, adresse: e.target.value })
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
  );
};

export default AdvancedSearch;
