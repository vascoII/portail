"use client";
import React, { useState, useEffect } from "react";
import { useRouter } from "next/navigation";
import BaseLayout from "../../../../components/Layout/BaseLayout";
import Breadcrumb from "../../../../components/Layout/Breadcrumb";
import Button from "../../../../components/UI/Button";
import Input from "../../../../components/UI/Input";
import Select from "../../../../components/UI/Select";
import Alert from "../../../../components/UI/Alert";

const OperatorEditPage: React.FC = () => {
  const router = useRouter();
  const { id } = router.query;
  const [formData, setFormData] = useState({
    name: "",
    firstName: "",
    email: "",
    phone: "",
    role: "operateur",
    status: "actif",
  });
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const [success, setSuccess] = useState(false);

  const breadcrumbItems = [
    { label: "Administration", href: "/admin" },
    { label: "Opérateurs", href: "/operators" },
    { label: `Opérateur ${id}`, href: `/operators/${id}/view` },
    { label: "Édition" },
  ];

  // Simulation du chargement des données de l'opérateur
  useEffect(() => {
    if (id) {
      // Données d'exemple
      setFormData({
        name: "Dupont",
        firstName: "Jean",
        email: "jean.dupont@techem.fr",
        phone: "01 23 45 67 89",
        role: "administrateur",
        status: "actif",
      });
    }
  }, [id]);

  const handleChange = (
    e: React.ChangeEvent<HTMLInputElement | HTMLSelectElement>
  ) => {
    setFormData({
      ...formData,
      [e.target.name]: e.target.value,
    });
  };

  const handleSubmit = async (e: React.FormEvent) => {
    e.preventDefault();
    setLoading(true);
    setError(null);

    try {
      // Simulation de la mise à jour de l'opérateur
      await new Promise((resolve) => setTimeout(resolve, 1000));
      setSuccess(true);
      setTimeout(() => {
        router.push(`/operators/${id}/view`);
      }, 2000);
    } catch (err) {
      setError("Erreur lors de la mise à jour de l'opérateur");
    } finally {
      setLoading(false);
    }
  };

  const roleOptions = [
    { value: "administrateur", label: "Administrateur" },
    { value: "operateur", label: "Opérateur" },
    { value: "technicien", label: "Technicien" },
  ];

  const statusOptions = [
    { value: "actif", label: "Actif" },
    { value: "inactif", label: "Inactif" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Éditer l'opérateur</h2>

      {error && <Alert type="danger" message={error} />}
      {success && (
        <Alert type="success" message="Opérateur modifié avec succès !" />
      )}

      <div className="row">
        <div className="col-md-8">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Informations de l'opérateur</h3>
            </div>
            <div className="panel-body">
              <form onSubmit={handleSubmit}>
                <div className="row">
                  <div className="col-md-6">
                    <Input
                      name="name"
                      label="Nom"
                      value={formData.name}
                      onChange={handleChange}
                      required
                    />
                  </div>
                  <div className="col-md-6">
                    <Input
                      name="firstName"
                      label="Prénom"
                      value={formData.firstName}
                      onChange={handleChange}
                      required
                    />
                  </div>
                </div>
                <div className="row">
                  <div className="col-md-6">
                    <Input
                      name="email"
                      label="Email"
                      type="email"
                      value={formData.email}
                      onChange={handleChange}
                      required
                    />
                  </div>
                  <div className="col-md-6">
                    <Input
                      name="phone"
                      label="Téléphone"
                      type="tel"
                      value={formData.phone}
                      onChange={handleChange}
                    />
                  </div>
                </div>
                <div className="row">
                  <div className="col-md-6">
                    <Select
                      name="role"
                      label="Rôle"
                      value={formData.role}
                      onChange={handleChange}
                      options={roleOptions}
                      required
                    />
                  </div>
                  <div className="col-md-6">
                    <Select
                      name="status"
                      label="Statut"
                      value={formData.status}
                      onChange={handleChange}
                      options={statusOptions}
                      required
                    />
                  </div>
                </div>
                <div className="form-group">
                  <Button
                    type="submit"
                    variant="primary"
                    loading={loading}
                    disabled={loading}
                  >
                    {loading ? "Sauvegarde..." : "Sauvegarder"}
                  </Button>
                  <Button
                    type="button"
                    variant="secondary"
                    onClick={() => router.push(`/operators/${id}/view`)}
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

export default OperatorEditPage;
