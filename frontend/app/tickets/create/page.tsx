import React, { useState } from "react";
import BaseLayout from "@/src/shared/components/Layout/BaseLayout";
import Breadcrumb from "@/src/shared/components/Layout/Breadcrumb";
import Button from "@/src/shared/components/UI/Button";
import Input from "@/src/shared/components/UI/Input";
import Select from "@/src/shared/components/UI/Select";
import Alert from "@/src/shared/components/UI/Alert";

const TicketCreatePage: React.FC = () => {
  const [formData, setFormData] = useState({
    title: "",
    description: "",
    priority: "normale",
    category: "technique",
    assignee: "",
  });
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState<string | null>(null);
  const [success, setSuccess] = useState(false);

  const breadcrumbItems = [
    { label: "Support", href: "/support" },
    { label: "Tickets", href: "/tickets" },
    { label: "Nouveau ticket" },
  ];

  const handleChange = (
    e: React.ChangeEvent<
      HTMLInputElement | HTMLSelectElement | HTMLTextAreaElement
    >
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
      // Simulation de la création d'un ticket
      await new Promise((resolve) => setTimeout(resolve, 1000));
      setSuccess(true);
      setTimeout(() => {
        window.location.href = "/tickets";
      }, 2000);
    } catch (err) {
      setError("Erreur lors de la création du ticket");
    } finally {
      setLoading(false);
    }
  };

  const priorityOptions = [
    { value: "basse", label: "Basse" },
    { value: "normale", label: "Normale" },
    { value: "haute", label: "Haute" },
    { value: "critique", label: "Critique" },
  ];

  const categoryOptions = [
    { value: "technique", label: "Technique" },
    { value: "facturation", label: "Facturation" },
    { value: "donnees", label: "Données" },
    { value: "autre", label: "Autre" },
  ];

  const assigneeOptions = [
    { value: "", label: "Non assigné" },
    { value: "jean.dupont", label: "Jean Dupont" },
    { value: "marie.martin", label: "Marie Martin" },
    { value: "pierre.durand", label: "Pierre Durand" },
  ];

  return (
    <BaseLayout>
      <Breadcrumb items={breadcrumbItems} />
      <span className="clearfix"></span>

      <h2>Créer un nouveau ticket</h2>

      {error && <Alert type="danger" message={error} />}
      {success && <Alert type="success" message="Ticket créé avec succès !" />}

      <div className="row">
        <div className="col-md-8">
          <div className="panel panel-default">
            <div className="panel-heading">
              <h3 className="panel-title">Informations du ticket</h3>
            </div>
            <div className="panel-body">
              <form onSubmit={handleSubmit}>
                <Input
                  name="title"
                  label="Titre du ticket"
                  value={formData.title}
                  onChange={handleChange}
                  placeholder="Résumé du problème"
                  required
                />

                <div className="form-group">
                  <label htmlFor="description">Description</label>
                  <textarea
                    id="description"
                    name="description"
                    className="form-control"
                    rows={5}
                    value={formData.description}
                    onChange={handleChange}
                    placeholder="Décrivez le problème en détail..."
                    required
                  />
                </div>

                <div className="row">
                  <div className="col-md-6">
                    <Select
                      name="priority"
                      label="Priorité"
                      value={formData.priority}
                      onChange={handleChange}
                      options={priorityOptions}
                      required
                    />
                  </div>
                  <div className="col-md-6">
                    <Select
                      name="category"
                      label="Catégorie"
                      value={formData.category}
                      onChange={handleChange}
                      options={categoryOptions}
                      required
                    />
                  </div>
                </div>

                <Select
                  name="assignee"
                  label="Assigné à"
                  value={formData.assignee}
                  onChange={handleChange}
                  options={assigneeOptions}
                />

                <div className="form-group">
                  <Button
                    type="submit"
                    variant="primary"
                    loading={loading}
                    disabled={loading}
                  >
                    {loading ? "Création..." : "Créer le ticket"}
                  </Button>
                  <Button
                    type="button"
                    variant="secondary"
                    onClick={() => window.history.back()}
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

export default TicketCreatePage;
