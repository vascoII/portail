"use client";
import React, { useState } from "react";
import { useRouter } from "next/navigation";
import BaseLayout from "../../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../../components/Layout/Breadcrumb";
import { useLogements } from "../../../../hooks/useLogements";
import Alert from "../../../../components/UI/Alert";
import Button from "../../../../components/UI/Button";
import Input from "../../../../components/UI/Input";

const LogementEditPage: React.FC = () => {
  const router = useRouter();
  const { id } = router.query;
  const { logements, loading, error, updateLogement } = useLogements();
  const [formData, setFormData] = useState({
    adresse: "",
    cp: "",
    ville: "",
    surface: "",
    nbPieces: "",
  });
  const [saving, setSaving] = useState(false);
  const [saveError, setSaveError] = useState<string | null>(null);
  const [saveSuccess, setSaveSuccess] = useState(false);

  const logement = logements.find((l) => l.id === id);

  React.useEffect(() => {
    if (logement) {
      setFormData({
        adresse: logement.adresse || "",
        cp: logement.cp || "",
        ville: logement.ville || "",
        surface: logement.surface?.toString() || "",
        nbPieces: logement.nbPieces?.toString() || "",
      });
    }
  }, [logement]);

  const handleChange = (e: React.ChangeEvent<HTMLInputElement>) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setSaving(true);
    setSaveError(null);

    try {
      await updateLogement(id as string, {
        adresse: formData.adresse,
        cp: formData.cp,
        ville: formData.ville,
        surface: formData.surface ? parseFloat(formData.surface) : undefined,
        nbPieces: formData.nbPieces ? parseInt(formData.nbPieces) : undefined,
      });
      setSaveSuccess(true);
      setTimeout(() => {
        router.push(`/logements/${id}`);
      }, 2000);
    } catch (err) {
      setSaveError(
        err instanceof Error ? err.message : "Erreur lors de la sauvegarde"
      );
    } finally {
      setSaving(false);
    }
  };

  const breadcrumbItems = [
    { label: "Le parc", href: "/dashboard" },
    {
      label: `Logement ${logement?.occupant.ref || id}`,
      href: `/logements/${id}`,
    },
    { label: "Édition" },
  ];

  if (loading) {
    return (
      <BaseLayout>
        <div className="text-center">
          <div className="spinner-border" role="status">
            <span className="sr-only">Chargement...</span>
          </div>
        </div>
      </BaseLayout>
    );
  }

  if (error || !logement) {
    return (
      <BaseLayout>
        <div className="alert alert-danger">
          Erreur : {error || "Logement non trouvé"}
        </div>
      </BaseLayout>
    );
  }

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Édition du logement</h2>

      {saveError && <Alert type="danger" message={saveError} />}
      {saveSuccess && (
        <Alert type="success" message="Logement modifié avec succès !" />
      )}

      <div className="row">
        <div className="col-md-8">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Informations du logement</h3>
            </div>
            <div className="panel-body">
              <form onSubmit={handleSubmit}>
                <div className="row">
                  <div className="col-md-12">
                    <Input
                      name="adresse"
                      label="Adresse"
                      value={formData.adresse}
                      onChange={handleChange}
                      required
                    />
                  </div>
                </div>
                <div className="row">
                  <div className="col-md-4">
                    <Input
                      name="cp"
                      label="Code postal"
                      value={formData.cp}
                      onChange={handleChange}
                      required
                    />
                  </div>
                  <div className="col-md-8">
                    <Input
                      name="ville"
                      label="Ville"
                      value={formData.ville}
                      onChange={handleChange}
                      required
                    />
                  </div>
                </div>
                <div className="row">
                  <div className="col-md-6">
                    <Input
                      name="surface"
                      label="Surface (m²)"
                      type="number"
                      value={formData.surface}
                      onChange={handleChange}
                    />
                  </div>
                  <div className="col-md-6">
                    <Input
                      name="nbPieces"
                      label="Nombre de pièces"
                      type="number"
                      value={formData.nbPieces}
                      onChange={handleChange}
                    />
                  </div>
                </div>
                <div className="form-group">
                  <Button
                    type="submit"
                    variant="primary"
                    loading={saving}
                    disabled={saving}
                  >
                    {saving ? "Sauvegarde..." : "Sauvegarder"}
                  </Button>
                  <Button
                    type="button"
                    variant="secondary"
                    onClick={() => router.push(`/logements/${id}`)}
                    className="ml-2"
                  >
                    Annuler
                  </Button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </BaseLayout>
  );
};

export default LogementEditPage;
