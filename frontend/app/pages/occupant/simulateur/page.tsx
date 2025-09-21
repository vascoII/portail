import React, { useState } from "react";
import BaseLayout from "../../components/Layout/BaseLayout";
import Breadcrumb from "../../components/Layout/Breadcrumb";
import Button from "../../components/UI/Button";
import Input from "../../components/UI/Input";
import Select from "../../components/UI/Select";

const OccupantSimulateurPage: React.FC = () => {
  const [formData, setFormData] = useState({
    typeEnergie: "eau",
    consommationActuelle: "",
    objectifReduction: "",
    periode: "mois",
  });
  const [resultats, setResultats] = useState<any>(null);

  const breadcrumbItems = [
    { label: "Mon espace", href: "/occupant/dashboard" },
    { label: "Simulateur de consommation" },
  ];

  const handleChange = (
    e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>
  ) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault();

    // Simulation simple des résultats
    const consommation = parseFloat(formData.consommationActuelle);
    const reduction = parseFloat(formData.objectifReduction);

    if (consommation && reduction) {
      const nouvelleConsommation = consommation * (1 - reduction / 100);
      const economie = consommation - nouvelleConsommation;

      setResultats({
        consommationActuelle: consommation,
        nouvelleConsommation: nouvelleConsommation,
        economie: economie,
        pourcentageReduction: reduction,
      });
    }
  };

  const optionsEnergie = [
    { value: "eau", label: "Eau" },
    { value: "chauffage", label: "Chauffage" },
    { value: "electricite", label: "Électricité" },
    { value: "gaz", label: "Gaz" },
  ];

  const optionsPeriode = [
    { value: "mois", label: "Mensuel" },
    { value: "annee", label: "Annuel" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Simulateur de consommation</h2>
      <p className="text-muted">
        Calculez les économies potentielles en réduisant votre consommation
      </p>

      <div className="row">
        <div className="col-md-6">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Paramètres de simulation</h3>
            </div>
            <div className="panel-body">
              <form onSubmit={handleSubmit}>
                <Select
                  name="typeEnergie"
                  label="Type d'énergie"
                  value={formData.typeEnergie}
                  onChange={handleChange}
                  options={optionsEnergie}
                  required
                />

                <Input
                  name="consommationActuelle"
                  label="Consommation actuelle"
                  type="number"
                  value={formData.consommationActuelle}
                  onChange={handleChange}
                  placeholder="Ex: 50"
                  required
                />

                <Input
                  name="objectifReduction"
                  label="Objectif de réduction (%)"
                  type="number"
                  value={formData.objectifReduction}
                  onChange={handleChange}
                  placeholder="Ex: 15"
                  min="1"
                  max="50"
                  required
                />

                <Select
                  name="periode"
                  label="Période"
                  value={formData.periode}
                  onChange={handleChange}
                  options={optionsPeriode}
                  required
                />

                <Button type="submit" variant="primary">
                  Calculer les économies
                </Button>
              </form>
            </div>
          </div>
        </div>

        <div className="col-md-6">
          {resultats ? (
            <div className="panel panel-success">
              <div className="panel-heading">
                <h3 className="panel-title">Résultats de la simulation</h3>
              </div>
              <div className="panel-body">
                <div className="row">
                  <div className="col-md-6">
                    <div className="stat-box">
                      <h4>Consommation actuelle</h4>
                      <p className="stat-value">
                        {resultats.consommationActuelle} m³
                      </p>
                    </div>
                  </div>
                  <div className="col-md-6">
                    <div className="stat-box">
                      <h4>Nouvelle consommation</h4>
                      <p className="stat-value text-success">
                        {resultats.nouvelleConsommation.toFixed(2)} m³
                      </p>
                    </div>
                  </div>
                </div>
                <div className="row">
                  <div className="col-md-6">
                    <div className="stat-box">
                      <h4>Économie</h4>
                      <p className="stat-value text-primary">
                        {resultats.economie.toFixed(2)} m³
                      </p>
                    </div>
                  </div>
                  <div className="col-md-6">
                    <div className="stat-box">
                      <h4>Réduction</h4>
                      <p className="stat-value text-warning">
                        {resultats.pourcentageReduction}%
                      </p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          ) : (
            <div className="panel panel-default">
              <div className="panel-heading">
                <h3 className="panel-title">Résultats</h3>
              </div>
              <div className="panel-body">
                <div className="text-center text-muted">
                  <i className="fa fa-calculator fa-3x"></i>
                  <p>Remplissez le formulaire pour voir les résultats</p>
                </div>
              </div>
            </div>
          )}
        </div>
      </div>
    </BaseLayout>
  );
};

export default OccupantSimulateurPage;
